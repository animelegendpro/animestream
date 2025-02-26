<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Skynime</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <style>
    .anime__cast__item {
        margin-bottom: 30px;
    }
    .cast__info {
        display: flex;
        align-items: center;
    }
    .cast__pic {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 15px;
    }
    .cast__pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .cast__details h6 {
        color: #ffffff;
        font-weight: 600;
        margin-bottom: 5px;
    }
    .cast__details span {
        color: #b7b7b7;
        font-size: 14px;
    }
    .season__item.current {
        position: relative;
    }
    .season__item.current::before {
        content: '▶';
        position: absolute;
        left: -20px;
        color: #e53637;
    }
</style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('page.header')
    <!-- Header End -->

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">Categories</a>
                        <span>Romance</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="{{ $anime['poster'] ?? '' }}">
                            <div class="comment"><i class="fa fa-comments"></i> {{ $anime['stats']['type'] ?? '' }}</div>
                            <div class="view"><i class="fa fa-eye"></i> {{ $anime['stats']['duration'] ?? '' }}</div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{ $anime['name'] ?? '' }}</h3>
                                <span>{{ $animeInfo['japanese'] ?? '' }}</span>
                                <span>{{ $animeInfo['synonyms'] ?? '' }}</span>
                            </div>
                            
                            <p>{{ $anime['description'] ?? '' }}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> {{ $anime['stats']['type'] ?? '' }} Series</li>
                                            <li><span>Studios:</span> {{ $animeInfo['studios'] ?? '' }}</li>
                                            <li><span>Date aired:</span> {{ $animeInfo['aired'] ?? '' }}</li>
                                            <li><span>Status:</span> {{ $animeInfo['status'] ?? '' }}</li>
                                            <li><span>Genre:</span> {{ implode(', ', $animeInfo['genres'] ?? []) }}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Scores:</span> {{ $animeInfo['malscore'] ?? '' }}</li>
                                            <li><span>Rating:</span> {{ $anime['stats']['rating'] ?? '' }}</li>
                                            <li><span>Duration:</span> {{ $animeInfo['duration'] ?? '' }} / ep</li>
                                            <li><span>Quality:</span> {{ $anime['stats']['quality'] ?? '' }}</li>
                                            <li><span>Producers:</span> {{implode(',', $animeInfo['producers'] ?? []) }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                            @auth
                                <a href="javascript:void(0)" 
                                class="follow-btn" 
                                data-anime-id="{{ $anime['id'] }}" 
                                onclick="toggleFollow(this)">
                                    <i class="fa {{ Auth::user()->followedAnime()->where('anime_id', $anime['id'])->exists() ? 'fa-heart' : 'fa-heart-o' }}"></i> 
                                    {{ Auth::user()->followedAnime()->where('anime_id', $anime['id'])->exists() ? 'Followed' : 'Follow' }}
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="follow-btn">
                                    <i class="fa fa-heart-o"></i> Follow
                                </a>
                            @endauth
                                    @if(!isset($animeInfo['upcoming']) || !$animeInfo['upcoming'])
                                        <a href="{{ route('anime.watching', ['id' => $anime['id']]) }}" class="watch-btn">
                                            <span>Watch Now</span> <i class="fa fa-angle-right"></i>
                                        </a>
                                    @else
                                        <button class="watch-btn" disabled style="opacity: 0.6; cursor: not-allowed; background: #4d4d4d;">
                                            <span>Coming Soon</span> <i class="fa fa-clock-o"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-8 col-md-8">
    <div class="anime__details__cast">
        <div class="section-title">
            <h5>Characters & Voice Actors</h5>
        </div>
        @foreach($characters as $cast)
            <div class="anime__cast__item">
                <div class="row align-items-center mb-4">
                    <div class="col-4">
                        <div class="cast__info">
                            <div class="cast__pic">
                                <img src="{{ $cast['character']['poster'] }}" alt="{{ $cast['character']['name'] }}">
                            </div>
                            <div class="cast__details">
                                <h6>{{ $cast['character']['name'] }}</h6>
                                <span>{{ $cast['character']['cast'] }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 text-center">
                        <i class="fa fa-arrow-right text-white"></i>
                    </div>
                    <div class="col-4">
                        <div class="cast__info">
                            <div class="cast__pic">
                                <img src="{{ $cast['voiceActor']['poster'] }}" alt="{{ $cast['voiceActor']['name'] }}">
                            </div>
                            <div class="cast__details">
                                <h6>{{ $cast['voiceActor']['name'] }}</h6>
                                <span>{{ $cast['voiceActor']['cast'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="col-lg-4 col-md-4">
    <div class="anime__details__sidebar">
        <div class="section-title">
            <h5>Seasons</h5>
        </div>
        @foreach($seasons as $season)
            <div class="season__item {{ $season['isCurrent'] ? 'current' : '' }}">
                <a href="{{ route('anime.detail', ['id' => $season['id']]) }}" 
                   class="d-flex align-items-center mb-4 text-decoration-none">
                    <div class="season__pic mr-3">
                        <img src="{{ $season['poster'] }}" alt="{{ $season['name'] }}" 
                             style="width: 100px; height: 150px; object-fit: cover;">
                    </div>
                    <div class="season__text">
                        <h6 class="text-white">{{ $season['name'] }}</h6>
                        <span class="text-secondary">{{ $season['title'] }}</span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Anime Section End -->

        <!-- Footer Section Begin -->
        @include('page.footer')
        <!-- Footer Section End -->

<!-- Search model Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch"><i class="icon_close"></i></div>
        <form class="search-model-form" action="{{ route('anime.search') }}" method="GET">
            <input type="text" name="q" id="search-input" placeholder="Search anime.....">
        </form>
    </div>
</div>
<script>
document.querySelector('.search-model-form').addEventListener('submit', function(e) {
    const searchInput = document.querySelector('#search-input');
    if (!searchInput.value.trim()) {
        e.preventDefault();
    }
});
</script>
<!-- Search model end -->

        <!-- Js Plugins -->
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/player.js') }}"></script>
        <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('js/mixitup.min.js') }}"></script>
        <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/main.js') }}"></script>

        <script>
function toggleFollow(button) {
    const animeId = button.dataset.animeId;
    
    fetch('{{ route('anime.follow') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ anime_id: animeId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const icon = button.querySelector('i');
            if (data.followed) {
                icon.classList.remove('fa-heart-o');
                icon.classList.add('fa-heart');
                button.innerHTML = `<i class="fa fa-heart"></i> Followed`;
            } else {
                icon.classList.remove('fa-heart');
                icon.classList.add('fa-heart-o');
                button.innerHTML = `<i class="fa fa-heart-o"></i> Follow`;
            }
        }
    })
    .catch(error => console.error('Error:', error));
}
</script>

    </body>

    </html>