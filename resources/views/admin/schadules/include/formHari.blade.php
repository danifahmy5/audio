<div class="form-group">
    <label>Hari</label>
    <div class="bg-light p-2">
        <div class="row">
            @foreach ($days as $day)
                @if ($loop->index == 0 || $loop->index == 4)
                    <div class="col-1">
                @endif
                <div>
                    <input class="mr-1" type="checkbox" id="days-{{ $day->value }}" value="{{ $day->value }}" />
                    <label for="days-{{ $day->value }}">{{ $day->name }}
                    </label>
                </div>

                @if ($loop->index == 3 || $loop->index == 6)
        </div>
        @endif
        @endforeach
    </div>
</div>
</div>
