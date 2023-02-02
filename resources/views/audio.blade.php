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
    <input type="hidden" value="{{ is_null($schadules) ? 10 : $schadules->duration }}" id="my-duration">
    <div class="app">
        <nav>
            <span id="connect-link">
                <a href="{{ route('login') }}"
                    style="color: white;
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
            <input type="range" max="100" value="{{ is_null($schadules) ? 100 :  $schadules->volume }}" step="1" />
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
        <div class="add-song">Add Song <i class="far fa-plus-square"></i></div>
    </div>
    <script>
        const duration = document.getElementById('my-duration').value;
        const timeout = parseInt(duration) * 60 * 1000

        setTimeout(() => {
            window.close();
        }, timeout);
    </script>

    <script src="vanilla-js-audio-player-main/scripts/songs.js"></script>
    <script src="vanilla-js-audio-player-main/scripts/app.js"></script>

</body>

</html>
