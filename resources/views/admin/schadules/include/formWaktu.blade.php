<div class="form-group mt-1">
    <label for="">Waktu</label>
    <div class="bg-light p-2 rounded">
        <div class="row">
            @php
                $count = 1;
                $separate = 1;
            @endphp
            @foreach ($times as $time)
                @if ($count == $separate)
                    <div class="col-1 mb-1 pb-1">
                @endif
                <div>
                    <input type="checkbox" name="times[]" id="times" aria-label="">
                    <label for="">{{ $time }}</label>
                </div>
                @if ($count == $separate + 11)
        </div>
        @php
            $separate = $separate + 12;
        @endphp
        @endif
        @php
            $count++;
        @endphp
        @endforeach
    </div>
</div>
</div>
