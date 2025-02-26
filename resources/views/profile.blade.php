<!DOCTYPE html>
<html lang="zxx">
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile - {{ Auth::user()->name }}</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}"type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
</head>
<body>

<style>
.product__item__pic {
    height: 325px;
    position: relative;
    border-radius: 5px;
    background-position: center;
    background-size: cover;
}

.product__item {
    margin-bottom: 30px;
}

.product__item__text {
    padding: 10px 0;
    background: transparent !important;
}

.product__item__text h5 {
    margin: 0;
    background: transparent !important;
}

.anime-title {
    display: block;
    font-size: 15px;
    font-weight: 700;
    line-height: 1.4;
    word-wrap: break-word;
    overflow-wrap: break-word;
    color: #ffffff;
    background: transparent !important;
    padding: 0 !important;
}

.anime-title:hover {
    color: #e53637;
    background: transparent !important;
}

.unfollow-btn {
    position: absolute;
    right: -10px;
    top: -10px;
}

.unfollow-btn a {
    color: #e53637 !important;
    text-decoration: none;
    opacity: 0.8;
    transition: all 0.3s;
    font-size: 70px;
    font-weight: 300;
    line-height: 0.5;
    display: block;
}

.unfollow-btn a:hover {
    opacity: 1;
}

/* Override any other potential background styles */
.product__item a, 
.product__item a:hover,
.product__item__text a, 
.product__item__text a:hover {
    background: transparent !important;
}
</style>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('page.header')
    <!-- Header End -->

    <!-- Profile Section Begin -->
    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="blog__details__title">
                        <h2>My Profile</h2>
                        <div class="blog__details__social">
                            <h6>{{ Auth::user()->name }}</h6>
                            <span>{{ Auth::user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>

                    <div class="anime__details__episodes">
    <div class="section-title">
        <h5>Followed Anime</h5>
    </div>
    <div class="row">
        @forelse($followedAnime as $anime)
        <div class="col-lg-3 col-md-4 col-sm-6" id="anime-container-{{ $anime->anime_id }}">
    <div class="product__item">
    <a href="{{ route('anime.detail', ['id' => $anime->anime_id]) }}" >
        <div class="product__item__pic set-bg" data-setbg="{{ $anime->poster }}" style="background-image: url('{{ $anime->poster }}');">
            </a>
            <div class="ep">{{ is_array($anime->episodes) ? $anime->episodes['sub'] ?? 0 : $anime->episodes }} Eps</div>
            <div class="view"><i class="fa fa-eye"></i> {{ $anime->type }}</div>
            <div class="unfollow-btn">
                <a href="javascript:void(0)" 
                   onclick="toggleFollowProfile('{{ $anime->anime_id }}')"
                   class="text-white">
                   ×
                </a>
            </div>
        </div>
        <div class="product__item__text">
            <h5>
                <a href="{{ route('anime.detail', ['id' => $anime->anime_id]) }}" class="anime-title">
                    {{ $anime->name }}
                </a>
            </h5>
        </div>
    </div>
</div>
        @empty
            <div class="col-12">
                <div class="text-center text-white-50 py-5">
                    <i class="fa fa-heart-o fa-3x mb-3"></i>
                    <h5>No followed anime yet</h5>
                    <p>Start following your favorite anime to see them here</p>
                </div>
            </div>
        @endforelse
    </div>
    
    @if($followedAnime->count() > 0)
        <div class="product__pagination text-center mt-4">
            {{ $followedAnime->links() }}
        </div>
    @endif
</div>
                    
<div class="anime__details__review">
    <div class="section-title">
        <h5>My Comments</h5>
    </div>
    @forelse($comments as $comment)
        <div class="anime__review__item">
            <div class="anime__review__item__text">
                <h6>{{ $comment->anime_name }} - <span>{{ $comment->created_at->diffForHumans() }}</span></h6>
                <p>{{ $comment->content }}</p>
            </div>
        </div>
    @empty
        <div class="text-center text-white-50">
            <p>No comments yet</p>
        </div>
    @endforelse
</div>
                </div>
            </div>
        </div>
    </section>
    <!-- Profile Section End -->

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
function toggleFollowProfile(animeId) {
    fetch('{{ route('anime.follow') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ anime_id: animeId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Hapus elemen anime dari tampilan dengan animasi fade out
            const animeContainer = document.getElementById(`anime-container-${animeId}`);
            animeContainer.style.transition = 'opacity 0.3s ease';
            animeContainer.style.opacity = '0';
            
            setTimeout(() => {
                animeContainer.remove();
                
                // Cek jika tidak ada anime yang tersisa
                const remainingAnime = document.querySelectorAll('[id^="anime-container-"]');
                if (remainingAnime.length === 0) {
                    location.reload(); // Reload untuk menampilkan pesan "No followed anime yet"
                }
            }, 300);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Failed to process request');
    });
}
</script>
</body>
</html>