<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Models\FollowedAnime;
use App\Models\Comment;
class AllController extends Controller
{


    public function toggleFollow(Request $request)
{
    try {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first'
            ], 401);
        }

        $animeId = $request->anime_id;
        $user = Auth::user();
        
        $existingFollow = FollowedAnime::where('user_id', $user->id)
                                      ->where('anime_id', $animeId)
                                      ->first();

        if ($existingFollow) {
            $existingFollow->delete();
            return response()->json([
                'success' => true,
                'followed' => false,
                'message' => 'Anime unfollowed successfully'
            ]);
        }

        $response = Http::get("http://localhost:4000/api/v2/hianime/anime/{$animeId}");
        $data = $response->json();

        if (!$response->successful()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch anime details'
            ], 500);
        }

        $animeInfo = $data['data']['anime']['info'];
        
        FollowedAnime::create([
            'user_id' => $user->id,
            'anime_id' => $animeId,
            'name' => $animeInfo['name'],
            'poster' => $animeInfo['poster'],
            'episodes' => $animeInfo['stats']['episodes']['sub'] ?? 0 // Get just the sub episode count
        ]);

        return response()->json([
            'success' => true,
            'followed' => true,
            'message' => 'Anime followed successfully'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'An error occurred: ' . $e->getMessage()
        ], 500);
    }
}

public function profile()
{
    $user = Auth::user();
    $followedAnime = $user->followedAnime()
        ->orderBy('created_at', 'desc')
        ->paginate(12);
    $comments = $user->comments()
        ->orderBy('created_at', 'desc')
        ->get();
    
    return view('profile', compact('user', 'followedAnime', 'comments'));
}

    public function loginProcess(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
}

public function signupProcess(Request $request)
{
    $request->validate([
        'email' => 'required|email|unique:users',
        'name' => 'required|min:3',
        'password' => 'required|min:6'
    ]);

    $user = User::create([
        'email' => $request->email,
        'name' => $request->name,
        'password' => Hash::make($request->password)
    ]);

    Auth::login($user);
    return redirect('/');
}

public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}

    public function animeList()
    {
        // Ambil data dari Aniwatch API
        $response = Http::get('http://localhost:4000/api/v2/hianime/home');
        $data = $response->json();
        
        if ($response->successful() && isset($data['data'])) {
            // Ambil data dari berbagai kategori
            $animeData = $data['data']; // Ambil 'data' dari response

        $trendingNow = $animeData['spotlightAnimes'] ?? [];
        $trendingAnimes = $animeData['trendingAnimes'] ?? [];
        $latestEpisodeAnimes = $animeData['latestEpisodeAnimes'] ?? [];
        $topUpcomingAnimes = $animeData['topUpcomingAnimes'] ?? [];
        $top10Animes = $animeData['top10Animes'] ?? [];
        $topAiringAnimes = $animeData['topAiringAnimes'] ?? [];
        $mostPopularAnimes = $animeData['mostPopularAnimes'] ?? [];
        $mostFavoriteAnimes = $animeData['mostFavoriteAnimes'] ?? [];
        $latestCompletedAnimes = $animeData['latestCompletedAnimes'] ?? [];
        $genres = $animeData['genres'] ?? [];
        } else {
            abort(500, "API request failed or data structure changed");
        }

        // Kirim data ke tampilan
        return view('index', compact(
        'trendingNow',
        'trendingAnimes',
        'latestEpisodeAnimes',
        'topUpcomingAnimes',
        'top10Animes',
        'topAiringAnimes',
        'mostPopularAnimes',
        'mostFavoriteAnimes',
        'latestCompletedAnimes',
        'genres'
    ));
    }

    public function genreAnime($genre, Request $request)
{
    $page = $request->query('page', 1);
    $perPage = 20;
    
    // Keep the hyphenated format for API request
    $response = Http::get("http://localhost:4000/api/v2/hianime/genre/{$genre}", [
        'page' => $page,
        'perPage' => $perPage
    ]);
    
    if ($response->successful()) {
        $data = $response->json();
        $animes = $data['data']['animes'] ?? [];
        $totalPages = $data['data']['totalPages'] ?? 1;
        $currentPage = $data['data']['currentPage'] ?? 1;
        
        // Convert hyphens to spaces only for display
        $displayGenre = str_replace('-', ' ', $genre);
        
        return view('genre', compact('animes', 'genre', 'currentPage', 'totalPages', 'displayGenre'));
    }
    
    abort(404, 'Genre not found');
}

    // PAGE
    public function index() {
        return view('index');
    }

    public function login() {
        return view('login');
    }

    public function signup() {
        return view('signup');
    }

    public function animeDetail($id)
{
    $response = Http::get("http://localhost:4000/api/v2/hianime/anime/{$id}");
    $data = $response->json();

    if ($response->successful() && isset($data['data']['anime']['info'])) {
        $anime = $data['data']['anime']['info'];
        $animeInfo = $data['data']['anime']['moreInfo'] ?? [];
        $characters = $anime['charactersVoiceActors'] ?? [];
        $seasons = $data['data']['seasons'] ?? [];
        
        // Get all upcoming anime IDs
        $upcomingResponse = Http::get('http://localhost:4000/api/v2/hianime/home');
        $upcomingData = $upcomingResponse->json();
        
        if ($upcomingResponse->successful()) {
            $upcomingAnimes = $upcomingData['data']['topUpcomingAnimes'] ?? [];
            $upcomingIds = array_column($upcomingAnimes, 'id');
            
            // Check if current anime is in upcoming list
            $moreInfo['upcoming'] = in_array($id, $upcomingIds);
        }
        
        return view('anime-detail', compact('anime', 'animeInfo', 'characters', 'seasons'));
    }
    
    abort(404, 'Anime not found');
}

    public function blogDetail() {
        return view('blog-detail');
    }

    public function blog() {
        return view('blog');
    }

    public function categories() {
        return view('categories');
    }

    public function main() {
        return view('main');
    }

    public function watching($id)
{
    // First check if anime is upcoming
    $animeResponse = Http::get("http://localhost:4000/api/v2/hianime/anime/{$id}");
    $animeData = $animeResponse->json();

    if ($animeResponse->successful() && isset($animeData['data']['anime']['info']['status'])) {
        $status = strtolower($animeData['data']['anime']['info']['status']);
        $isUpcoming = str_contains($status, 'not yet aired') || 
                     str_contains($status, 'upcoming') ||
                     str_contains($status, 'coming soon');
        
        if ($isUpcoming) {
            abort(404, 'This anime is not yet available for watching.');
        }
    }

    $response = Http::get("http://localhost:4000/api/v2/hianime/anime/{$id}/episodes");
    $data = $response->json();

    $episodes = [];
    $videoSource = null;
    $tracks = null;
    $currentEpisode = null;
    $animeId = $id; // Add this line to define $animeId

    if ($response->successful() && isset($data['data']['episodes'])) {
        $episodes = $data['data']['episodes'];
        
        if (!empty($episodes)) {
            $currentEpisode = $episodes[0]; // Default to first episode
            $firstEpisodeId = $episodes[0]['episodeId'];
            $sourceResponse = Http::get("http://localhost:4000/api/v2/hianime/episode/sources", [
                'animeEpisodeId' => $firstEpisodeId,
                'server' => 'hd-1',
                'category' => 'sub'
            ]);
            
            if ($sourceResponse->successful()) {
                $sourceData = $sourceResponse->json();
                $videoSource = $sourceData['data']['sources'][0]['url'] ?? null;
                $tracks = $sourceData['data']['tracks'] ?? null;
            }
        }
    }

    // Get anime details for the name
    $animeResponse = Http::get("http://localhost:4000/api/v2/hianime/anime/{$id}");
    $animeData = $animeResponse->json();
    $animeName = $animeData['data']['anime']['info']['name'] ?? '';
    
    // Get comments for this anime
    $comments = Comment::with('user')
                    ->where('anime_id', $id)
                    ->orderBy('created_at', 'desc')
                    ->get();

    return view('watching', compact(
        'episodes',
        'videoSource',
        'tracks',
        'currentEpisode',
        'animeId',
        'animeName',
        'comments'
    ));
}

public function storeComment(Request $request)
{
    $validated = $request->validate([
        'anime_id' => 'required',
        'anime_name' => 'required',
        'content' => 'required|max:1000'
    ]);

    $comment = Comment::create([
        'user_id' => Auth::id(),
        'anime_id' => $validated['anime_id'],
        'anime_name' => $validated['anime_name'],
        'content' => $validated['content']
    ]);

    return back()->with('success', 'Comment posted successfully!');
}

public function getEpisodeSource(Request $request)
{
    $episodeId = $request->episodeId;
    $response = Http::get("http://localhost:4000/api/v2/hianime/episode/sources", [
        'animeEpisodeId' => $episodeId,
        'server' => 'hd-1',
        'category' => 'sub'
    ]);

    return $response->json();
}


    // PROCESS
    public function search(Request $request)
{
    $query = $request->input('q');
    $page = $request->query('page', 1);
    $perPage = 20;
    
    if (empty($query)) {
        return redirect()->route('anime.list');
    }

    $response = Http::get("http://localhost:4000/api/v2/hianime/search", [
        'q' => $query,
        'page' => $page,
        'perPage' => $perPage
    ]);
    
    if ($response->successful()) {
        $data = $response->json();
        $animes = $data['data']['animes'] ?? [];
        $totalPages = $data['data']['totalPages'] ?? 1;
        $currentPage = $data['data']['currentPage'] ?? 1;
        
        return view('search', [
            'animes' => $animes,
            'query' => $query,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages
        ]);
    }
    
    return redirect()->route('anime.list')->with('error', 'Search failed. Please try again.');
}


}
