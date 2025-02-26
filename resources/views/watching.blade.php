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
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}"type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">

    <style>
        .anime__details__episodes a.active {
    color: #000000;
    background: #ffffff;
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
                    <a href="/"><i class="fa fa-home"></i> Home</a>
                    <span id="current-episode-title">{{ $currentEpisode['title'] ?? 'Episode 1' }}</span>
                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    @auth
    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <div class="anime__video__player">
    @if(isset($currentEpisode))
        <video id="player" playsinline controls crossorigin="anonymous">
            <source src="{{ $videoSource }}" type="application/x-mpegURL" />
            @if(isset($tracks))
                @foreach($tracks as $track)
                    <track 
                        kind="{{ $track['kind'] ?? 'captions' }}" 
                        label="{{ $track['label'] ?? 'English' }}" 
                        src="{{ $track['file'] }}" 
                        srclang="en" 
                        @if(isset($track['default']) && $track['default'] === true) default @endif
                    />
                @endforeach
            @endif
        </video>
    @endif
</div>
<div class="anime__details__episodes">
    <div class="section-title">
        <h5>Episode</h5>
    </div>
    @if(empty($episodes))
        <p>No episodes available.</p>
    @else
        @foreach($episodes as $episode)
            <a href="javascript:void(0)" 
               class="episode-link {{ isset($currentEpisode) && $currentEpisode['episodeId'] === $episode['episodeId'] ? 'active' : '' }}" 
               data-episode-id="{{ $episode['episodeId'] }}"
               data-episode-title="{{ $episode['title'] }}"
               >Ep {{ str_pad($episode['number'], 2, '0', STR_PAD_LEFT) }}</a>
        @endforeach
    @endif
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                <div class="anime__details__review">
    <div class="section-title">
        <h5>Comments</h5>
    </div>
    @forelse($comments as $comment)
        <div class="anime__review__item">
            <div class="anime__review__item__text">
                <h6>{{ $comment->user->name }} - <span>{{ $comment->created_at->diffForHumans() }}</span></h6>
                <p>{{ $comment->content }}</p>
            </div>
        </div>
    @empty
        <p class="text-center text-white-50">No comments yet. Be the first to comment!</p>
    @endforelse
</div>

                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        <form action="{{ route('anime.comment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="anime_id" value="{{ $animeId }}">
                            <input type="hidden" name="anime_name" value="{{ $animeName }}">
                            <textarea name="content" placeholder="Your Comment" required></textarea>
                            <button type="submit"><i class="fa fa-location-arrow"></i> Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @else
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h4 class="text-white mt-5">Please <a href="{{ route('login') }}" class="text-danger">login</a> to watch this anime.</h4>
            </div>
        </div>
    </div>
@endauth
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
    <!-- Add this before closing body tag -->
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentHls = null;
    let currentPlayer = null;
    const videoContainer = document.querySelector('.anime__video__player');
    const loader = document.createElement('div');
    loader.className = 'loader';
    loader.style.display = 'none';
    videoContainer.appendChild(loader);

    function showLoader() {
        loader.style.display = 'block';
    }

    function hideLoader() {
        loader.style.display = 'none';
    }

    function destroyPlayer() {
        if (currentPlayer) {
            currentPlayer.destroy();
        }
        if (currentHls) {
            currentHls.destroy();
            currentHls = null;
        }
    }

    function initPlayer(videoElement, source) {
    showLoader();
    destroyPlayer();

    // Create consistent Plyr instance with specific control styles
    currentPlayer = new Plyr(videoElement, {
        controls: [
            'play-large',
            'play',
            'progress',
            'current-time',
            'mute',
            'volume',
            'captions',
            'settings',
            'fullscreen'
        ],
        seekTime: 10,
        keyboard: { focused: true, global: true },
        tooltips: { controls: true, seek: true },
        captions: { active: true, update: true },
        // Add specific volume control settings
        volume: 1,
        muted: false,
        clickToPlay: true,
        settings: ['captions', 'quality', 'speed'],
        // Add custom control class for consistent styling
        classNames: {
            control: 'plyr__control',
            volume: 'plyr__volume',
            mute: 'plyr__control--mute'
        }
    });

        // Setup HLS
        if (Hls.isSupported()) {
            currentHls = new Hls({
                debug: false,
                enableWorker: true,
                xhrSetup: xhr => {
                    xhr.withCredentials = false;
                }
            });

            currentHls.attachMedia(videoElement);
            currentHls.on(Hls.Events.MEDIA_ATTACHED, () => {
                currentHls.loadSource(source);
            });

            currentHls.on(Hls.Events.MANIFEST_PARSED, () => {
                hideLoader();
                videoElement.play().catch(() => {
                    console.log("Autoplay prevented");
                });
            });

            // Setup error handling
            currentHls.on(Hls.Events.ERROR, (event, data) => {
                if (data.fatal) {
                    switch (data.type) {
                        case Hls.ErrorTypes.NETWORK_ERROR:
                            currentHls.startLoad();
                            break;
                        case Hls.ErrorTypes.MEDIA_ERROR:
                            currentHls.recoverMediaError();
                            break;
                        default:
                            destroyPlayer();
                            break;
                    }
                }
            });
        } else if (videoElement.canPlayType('application/vnd.apple.mpegurl')) {
            videoElement.src = source;
            videoElement.addEventListener('loadedmetadata', () => {
                hideLoader();
                videoElement.play().catch(() => {
                    console.log("Autoplay prevented");
                });
            });
        }

        // Setup Plyr events
        currentPlayer.on('ready', () => {
            hideLoader();
        });

        currentPlayer.on('playing', () => {
            hideLoader();
        });

        currentPlayer.on('error', () => {
            hideLoader();
        });

        return currentPlayer;
    }

    // Initialize first video
    const initialVideo = document.getElementById('player');
    if (initialVideo) {
        initPlayer(initialVideo, initialVideo.querySelector('source').src);
    }

    // Handle episode clicks
    document.querySelectorAll('.episode-link').forEach(link => {
        link.addEventListener('click', async function(e) {
            e.preventDefault();
            const episodeId = this.dataset.episodeId;
            
            try {
                showLoader();
                const response = await fetch(`/api/episode-source?episodeId=${episodeId}`);
                const data = await response.json();
                
                if (data.data?.sources?.[0]) {
                    const videoContainer = document.querySelector('.anime__video__player');
                    const oldVideo = document.getElementById('player');
                    
                    // Create new video element
                    const newVideo = document.createElement('video');
                    newVideo.id = 'player';
                    newVideo.setAttribute('playsinline', '');
                    newVideo.setAttribute('controls', '');
                    newVideo.setAttribute('crossorigin', 'anonymous');
                    
                    // Add source
                    const source = document.createElement('source');
                    source.src = data.data.sources[0].url;
                    source.type = 'application/x-mpegURL';
                    newVideo.appendChild(source);

                    // Add tracks if available
                    if (data.data.tracks) {
                        data.data.tracks.forEach(track => {
                            const trackElement = document.createElement('track');
                            trackElement.kind = track.kind || 'captions';
                            trackElement.label = track.label || 'English';
                            trackElement.srclang = 'en';
                            trackElement.src = track.file;
                            if (track.default) {
                                trackElement.default = true;
                            }
                            newVideo.appendChild(trackElement);
                        });
                    }

                    // Replace old video
                    videoContainer.innerHTML = '';
                    videoContainer.appendChild(newVideo);

                    // Initialize new player
                    initPlayer(newVideo, data.data.sources[0].url);
                }
            } catch (error) {
                console.error('Error fetching episode source:', error);
                hideLoader();
            }
        });
    });
});
</script>

</body>

</html>