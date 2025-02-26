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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/plyr.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>

<style>
    .product__sidebar__genres {
        height: 100%;
        min-height: 600px;
    }
    
    .genres-grid a:hover {
        background: #e53637 !important;
        color: #ffffff !important;
    }
    
    @media (max-width: 991px) {
        .product__sidebar__genres {
            min-height: auto;
            margin-top: 30px;
        }
    }
</style>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('page.header')
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero">
    <div class="container">
        <div class="hero__slider owl-carousel">
            @foreach($trendingNow as $trending)
                <div class="hero__items set-bg" data-setbg="{{ $trending['poster'] ?? '' }}" style="height: 600px; background-size: cover; background-position: center;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">{{ $trending['type'] ?? 'Anime' }}</div>
                                <h2 class="text-dark" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; max-height: 2.8em;">
                                    {{ $trending['name'] ?? '' }}
                                </h2>
                                <p style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; max-height: 4.5em;">
                                    {{ $trending['description'] ?? '' }}
                                </p>
                                <a href="{{ route('anime.detail', ['id' => $trending['id']]) }}">
                                    <span>Watch Now</span> <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="trending__product">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <div class="section-title">
                                <h4>Episode baru</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <!-- View All as plain text, no button, just link -->
                            <div class="btn__all">
                                <a href="javascript:void(0)" id="viewAllBtn" class="primary-btn">View All <span class="arrow_right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="animeList">
                        <!-- Anime terbatas pertama (6 anime) -->
                        @foreach ($latestEpisodeAnimes as $index => $anime)
                            @if ($index < 6)
                            
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                    <a href="{{ route('anime.detail', ['id' => $anime['id']]) }}">
                                        <div class="product__item__pic set-bg" data-setbg="{{ $anime['poster'] ?? '' }}">                                       
                                            <div class="ep">Sub: {{ $anime['episodes']['sub'] ?? 'N/A' }} | Dub: {{ $anime['episodes']['dub'] ?? 'N/A' }}</div>
                                            <div class="comment"><i class="fa fa-comments"></i> {{ $anime['duration'] }}</div>    
                                            <div class="view"><i class="fa fa-eye"></i> {{ $anime['type']  }}</div>
                                        </div>
                                        <div class="product__item__text">
                                           
                                            <h5 class="text-white">{{ $anime['name'] }}</h5>
                                            </a>
                                        </div>
                                    </div>
                                    
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <!-- Extra Anime yang akan disembunyikan -->
                    <div id="extraAnime" style="display:none;">
                        <div class="row">
                            @foreach ($latestEpisodeAnimes as $index => $anime)
                                @if ($index >= 6)
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                        <a href="{{ route('anime.detail', ['id' => $anime['id']]) }}">
                                            <div class="product__item__pic set-bg" data-setbg="{{ $anime['poster'] ?? '' }}">
                                                <div class="ep">Sub: {{ $anime['episodes']['sub'] ?? 'N/A' }} | Dub: {{ $anime['episodes']['dub'] ?? 'N/A' }}</div>
                                                <div class="comment"><i class="fa fa-comments"></i>{{ $anime['duration'] }}</div>    
                                                <div class="view"><i class="fa fa-eye"></i> {{ $anime['type']  }}</div>
                                            </div>
                                            <div class="product__item__text">
                                                
                                                <h5 class="text-white">{{ $anime['name'] }}</h5>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
    <div class="product__sidebar">
        <div class="product__sidebar__view">
            <div class="section-title">
                <h5>Top 10 Anime</h5>
            </div>
            <ul class="filter__controls">
                <li class="active" data-filter=".day">Harian</li>
                <li data-filter=".week">Mingguan</li>
                <li data-filter=".month">Bulanan</li>
            </ul>
            <div class="filter__gallery">
    @foreach (['today' => 'day', 'week' => 'week', 'month' => 'month'] as $key => $filterClass)
        @foreach ($top10Animes[$key] ?? [] as $anime)
            <div class="product__sidebar__view__item mix {{ $filterClass }}" style="display: flex; align-items: center; margin-bottom: 15px; height: 100px; overflow: hidden;">
                <a href="{{ route('anime.detail', ['id' => $anime['id']]) }}" style="display: flex; align-items: center; text-decoration: none; width: 100%;">
                    <div class="set-bg" data-setbg="{{ $anime['poster'] ?? '' }}" style="width: 60px; height: 80px; background-size: cover; background-position: center; flex-shrink: 0; margin-right: 10px;"></div>
                    <div style="display: flex; flex-direction: column; justify-content: space-between; flex-grow: 1; max-width: calc(100% - 70px); height: 100%;">
                        <div style="flex: 1;">
                            <h5 style="left: 50px; font-size: 14px; color: #fff; margin: 0; word-wrap: break-word; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; line-height: 1.3;">{{ $anime['name'] ?? '' }}</h5>
                        </div>
                        <div style="margin-top: 5px;">
                            <div class="ep" style="left: 70px; font-size: 12px; color: #b7b7b7; margin-bottom: 3px;">Sub: {{ $anime['episodes']['sub'] ?? 'N/A' }} | Dub: {{ $anime['episodes']['dub'] ?? 'N/A' }}</div>
                            <div class="view" style="font-size: 12px; color: #b7b7b7;">Rank: {{ $anime['rank'] ?? '' }}</div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @endforeach
</div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.3.1/mixitup.min.js"></script>
<script>
    $(document).ready(function () {
        var mixer = mixitup('.filter__gallery', {
            load: {
                filter: '.day' // Filter awal hanya menampilkan elemen dengan kelas .day
            }
        });

        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>

        </div>
    </div>
        </div>
    </div>
</section>

<!-- JavaScript untuk menyembunyikan dan menampilkan lebih banyak anime -->
<script>
    document.getElementById('viewAllBtn').addEventListener('click', function() {
        var extraAnime = document.getElementById('extraAnime');
        if (extraAnime.style.display === "none") {
            extraAnime.style.display = "block";
            this.innerHTML = "View Less <span class='arrow_left'></span>";  // Ubah tombol menjadi "View Less"
        } else {
            extraAnime.style.display = "none";
            this.innerHTML = "View All <span class='arrow_right'></span>";  // Kembalikan tombol menjadi "View All"
        }
    });
   



</script>


<div class="container">
    <div class="trending__product">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8">
                <div class="section-title">
                    <h4>Trending sekarang</h4>
                    <p class="text-white-50">Anime trending di Skynime!</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="trending-slider owl-carousel">
                @foreach ($trendingAnimes as $key => $anime)
                <div class="item">
                    <div class="product__item">
                        <a href="{{ route('anime.detail', ['id' => $anime['id']]) }}">
                            <div class="product__item__pic set-bg" data-setbg="{{ $anime['poster'] ?? '' }}" 
                                style="height: 400px; border-radius: 8px; background-size: cover; position: relative;">
                                <div class="ep">#{{ $key + 1 }}</div>
                            </div>
                        </a>
                        <div class="product__item__text" style="padding: 15px 0;">
                            <h5 style="font-size: 16px; margin-bottom: 5px;">
                                <a href="{{ route('anime.detail', ['id' => $anime['id']]) }}" 
                                   class="text-white" 
                                   style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $anime['name'] }}
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    var owl = $('.trending-slider');
    owl.owlCarousel({
        loop: false,
        margin: 20,
        nav: true,
        dots: true,
        navText: [
            "<div class='nav-button owl-prev'><i class='fa fa-angle-left'></i></div>",
            "<div class='nav-button owl-next'><i class='fa fa-angle-right'></i></div>"
        ],
        responsive:{
            0:{
                items: 1
            },
            576:{
                items: 2
            },
            768:{
                items: 3
            },
            992:{
                items: 4
            }
        }
    });

    // Add custom navigation styling
    $('.owl-nav').css({
        'position': 'absolute',
        'top': '40%',
        'width': '100%',
        'transform': 'translateY(-50%)'
    });

    $('.nav-button').css({
        'background': 'rgba(255, 255, 255, 0.2)',
        'width': '40px',
        'height': '40px',
        'border-radius': '50%',
        'display': 'flex',
        'align-items': 'center',
        'justify-content': 'center',
        'position': 'absolute'
    });

    $('.owl-prev').css('left', '-60px');
    $('.owl-next').css('right', '-60px');

    $('.nav-button i').css({
        'color': 'white',
        'font-size': '24px'
    });
});
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="trending__product">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <div class="section-title">
                            <h4>Akan datang</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
    @foreach ($topUpcomingAnimes as $index => $anime)
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="{{ $anime['poster'] ?? '' }}">                                       
                        <div class="ep">Coming Soon</div>
                        <div class="comment"><i class="fa fa-comments"></i> {{ $anime['duration'] }}</div>    
                        <div class="view"><i class="fa fa-eye"></i> {{ $anime['type'] }}</div>
                    </div>
                    <div class="product__item__text">
                        <h5 class="text-white">{{ $anime['name'] }}</h5>
                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product__sidebar">
                <div class="product__sidebar__genres" style="background: #0b0c2a; padding: 20px; border-radius: 5px;">
                    <div class="section-title">
                        <h4>Genres</h4>
                    </div>
                    <div class="genres-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 10px; margin-top: 20px;">
                        @foreach($genres as $genre)
                            <a href="{{ route('anime.genre', ['genre' => str_replace(' ', '-', strtolower($genre))]) }}" 
                            style="background: rgba(255, 255, 255, 0.1);
                                    padding: 8px 12px;
                                    border-radius: 5px;
                                    color: #ffffff;
                                    text-align: center;
                                    font-size: 14px;
                                    transition: all 0.3s;
                                    text-decoration: none;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;">
                                {{ $genre }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/player.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>


</body>

</html>