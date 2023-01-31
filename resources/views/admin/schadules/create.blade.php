@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>{{ __('Tambah jadwal') }}</h4>

                        </div>
                    </div>
                    <form action="{{ route('schadules.store') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    placeholder="masukkan nama">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="shuffle">Jenis pemutaran</label>
                                <select type="text" name="shuffle" id="shuffle"
                                    class="form-control @error('shuffle') is-invalid @enderror" value="{{ old('shuffle') }}"
                                    placeholder="masukkan nama">
                                    <option value="">normal</option>
                                    <option value="true">acak</option>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="duration">Durasi</label>
                                <input type="number" name="duration" id="duration"
                                    class="form-control @error('duration') is-invalid @enderror"
                                    value="{{ old('duration') }}" placeholder="masukkan durasi dalam format menit">
                                @error('duration')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="volume">Volume</label>
                                <input type="number" name="volume" id="volume"
                                    class="form-control @error('volume') is-invalid @enderror" value="{{ old('volume') }}"
                                    placeholder="masukkan volume audio">
                                @error('volume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="days">Hari</label>
                                <select class="select2 form-control" multiple type="text" name="days[]" id="days"
                                    class="form-control" placeholder="masukkan nama">
                                    @foreach ($days as $day)
                                        <option value="{{ $day->value }}">
                                            {{ $day->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('days')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="times">Waktu</label>
                                <select class="select2 form-control" multiple type="text" name="times[]" id="times"
                                    class="form-control" placeholder="masukkan nama">
                                    @foreach ($times as $time)
                                        <option value="{{ $time }}">
                                            {{ $time }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('times')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="audio">Audio</label>
                                <select class="select2 form-control" multiple type="text" name="audio[]" id="audio"
                                    class="form-control" placeholder="masukkan nama">
                                    @foreach ($files as $file)
                                        <option value="{{ $file->id }}">
                                            {{ $file->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('audio')
                                    <small class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </small>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('schadules.index') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </form>


                </div>

            </div>
        </div>
    </div>
@endsection
