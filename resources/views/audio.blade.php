<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="Script Tutorials" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title>{{ env('APP_NAME') }}</title>

    <!-- add styles and scripts -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('js/jquery-1.7.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/musicplayer.js') }}"></script>
    <!-- Add the slick-theme.css if you want default styling -->
</head>

<body style="background-image: url({{ $dirAudio[0]['cover'] }});background-size: cover;">
    <input type="hidden" value="{{ is_null($schadules) ? 10 : $schadules->duration }}" id="my-duration">
    <div class="music-player">
        <ul class="playlist">
            @foreach ($dirAudio as $item)
                <li data-cover="{{ $item['cover'] }}" data-artist="{{ $item['artist'] }}">
                    <a href="{{ $item['audio'] }}">
                        {{ $item['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    <script>
        $(".music-player").musicPlayer({
            elements: ['artwork', 'information', 'controls', 'progress', 'time',
                'volume'
            ], // ==> This will display in  the order it is inserted
            elements: ['controls', 'information', 'artwork', 'progress', 'time', 'volume'],
            controlElements: ['backward', 'play', 'forward', 'stop'],
            timeElements: ['current', 'duration'],
            timeSeparator: " : ", // ==> Only used if two elements in timeElements option
            infoElements: ['title', 'artist'],
            volume: 50,
            autoPlay: true,
            loop: false,

        });

        const duration = document.getElementById('my-duration').value;
        const timeout = parseInt(duration) * 60 * 1000

        setTimeout(() => {
            window.close();
        }, timeout);
    </script>
</body>

</html>
