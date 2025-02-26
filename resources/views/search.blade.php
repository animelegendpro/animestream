<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Search Results - {{ $query }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/plyr.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
</head>

<body>

<style>
    .product__sidebar__genres {
        margin-bottom: 30px;
    }

    .genres-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .genre-item {
        background: rgba(255, 255, 255, 0.1);
        padding: 5px 15px;
        border-radius: 20px;
        color: #ffffff;
        transition: all 0.3s;
    }

    .genre-item:hover {
        background: #e53637;
        color: #ffffff;
        text-decoration: none;
    }

    /* Add new pagination styles */
    .pagination {
        margin: 50px 0 100px 0;  /* Increased margin-bottom to avoid footer overlap */
    }

    .pagination .page-item .page-link {
        background-color: #0b0c2a;
        border: 1px solid #e53637;
        color: #ffffff;
        padding: 8px 15px;
        margin: 0 5px;
        border-radius: 5px;
        transition: all 0.3s;
    }

    .pagination .page-item.active .page-link {
        background-color: #e53637;
        border-color: #e53637;
        color: #ffffff;
    }

    .pagination .page-item .page-link:hover {
        background-color: #e53637;
        border-color: #e53637;
        color: #ffffff;
    }

    .pagination .page-item.disabled .page-link {
        background-color: #1d1e39;
        border-color: #1d1e39;
        color: #666;
    }
</style>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    @include('page.header')
    <!-- Header End -->

    <!-- Search Results Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-white mb-4">Search Results for "{{ $query }}"</h2>
                </div>
            </div>
            
            <div class="row">
                @foreach($animes as $anime)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__item">
                            <a href="{{ route('anime.detail', ['id' => $anime['id']]) }}">
                                <div class="product__item__pic set-bg" data-setbg="{{ $anime['poster'] ?? '' }}">
                                    <div class="ep">{{ $anime['type'] }}</div>
                                    <div class="comment"><i class="fa fa-comments"></i> {{ $anime['duration'] }}</div>
                                </div>
                                <div class="product__item__text">
                                    <h5 class="text-white">{{ $anime['name'] }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            @if($totalPages > 1)
                                @if($currentPage > 1)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ route('anime.search', ['q' => $query, 'page' => $currentPage - 1]) }}">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                @endif

                                @for($i = max(1, $currentPage - 2); $i <= min($totalPages, $currentPage + 2); $i++)
                                    <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                                        <a class="page-link" href="{{ route('anime.search', ['q' => $query, 'page' => $i]) }}">
                                            {{ $i }}
                                        </a>
                                    </li>
                                @endfor

                                @if($currentPage < $totalPages)
                                    <li class="page-item">
                                        <a class="page-link" href="{{ route('anime.search', ['q' => $query, 'page' => $currentPage + 1]) }}">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Results Section End -->

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
</body>

</html>