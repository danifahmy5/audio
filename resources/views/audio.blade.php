<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/4074b6dd70.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="vanilla-js-audio-player-main/styles/style.css" />
    <title>Audio Player</title>
</head>

<body>
    <input type="hidden" value="{{ json_encode($dirAudio) }}" id="my-audio-list">
    <div class="app">
        <nav>
            <span id="connect-link">
                <a href="{{ route('login') }}"
                    style="color: color(srgb 0.6805 0.7916 0.9474);
                text-decoration-line: none;">Login</a>

            </span>
            <span id="library-link">Library</span>
        </nav>
        <div class="song-info">
            <img class="play-pause" src="{{ $dirAudio[0]['cover'] }}" alt="" />
            <div>
                <h2>{{ $dirAudio[0]['name'] }}</h2>
                <h3>Dani Fahmy Rosyid</h3>
            </div>
        </div>
        <div class="player">
            <div>
                <input type="range" />
                <div></div>
            </div>
            <span>start</span>
            <span>end</span>
        </div>
        <div class="player-control">
            <i class="fas fa-backward" id="backward"></i>
            <i class="fas fa-play" id="play-pause"></i>
            <i class="fas fa-forward" id="forward"></i>
        </div>
        <div class="sound-control">
            <i class="fas fa-volume-down"></i>
            <input type="range" max="100" step="1" />
            <i class="fas fa-volume-up"></i>
        </div>
        <audio src="{{ $dirAudio[0]['audio'] }}"></audio>
    </div>
    <div class="library">
        <h2>Library</h2>
        @foreach ($dirAudio as $audio)
            <div class="library-song {{ $loop->index == 0 ? 'selected' : '' }}" id="{{ $audio['id'] }}">
                <img src="{{ $audio['cover'] }}" alt="" />
                <div class="library-song-info">
                    <h3>{{ $audio['name'] }}</h3>
                    <h4>Dani Fahmy Rosyid</h4>
                </div>
            </div>
        @endforeach

        {{-- <div class="library-song" id="2">
            <img src=""
                alt="" />
            <div class="library-song-info">
                <h3>Song 3</h3>
                <h4>Artist 3</h4>
            </div>
        </div>
        <div class="library-song" id="3">
            <img src="https://chillhop.com/wp-content/uploads/2020/07/ef95e219a44869318b7806e9f0f794a1f9c451e4-1024x1024.jpg"
                alt="" />
            <div class="library-song-info">
                <h3>Song 4</h3>
                <h4>Artist 4</h4>
            </div>
        </div>
        <div class="library-song" id="4">
            <img src="https://chillhop.com/wp-content/uploads/2020/07/ff35dede32321a8aa0953809812941bcf8a6bd35-1024x1024.jpg"
                alt="" />
            <div class="library-song-info">
                <h3>Song 5</h3>
                <h4>Artist 5</h4>
            </div>
        </div>
        <div class="library-song" id="5">
            <img src="https://chillhop.com/wp-content/uploads/2020/09/0255e8b8c74c90d4a27c594b3452b2daafae608d-1024x1024.jpg"
                alt="" />
            <div class="library-song-info">
                <h3>Song 6</h3>
                <h4>Artist 6</h4>
            </div>
        </div> --}}
        <div class="add-song">Add Song <i class="far fa-plus-square"></i></div>
    </div>

    <script src="vanilla-js-audio-player-main/scripts/songs.js"></script>
    <script src="vanilla-js-audio-player-main/scripts/app.js"></script>
</body>

</html>
