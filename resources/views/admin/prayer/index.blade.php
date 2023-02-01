@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>{{ __('Daftar jadwal sholat') }}</h4>
                            <form method="GET" action="{{route('pray.sync')}}">
                                <button class="btn btn-primary type="submit">Sync Data Sholat</button>

                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        @error('audio')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (Session::has('msg'))
                            <div class="alert alert-success">
                                {{ Session::get('msg') }}
                            </div>
                        @enderror
                        <div class="d-flex justify-content-between">
                            <form action="" method="get" class="d-flex">
                                <select style="width: 200px" class="form-control" name="month" id="month">
                                    @foreach ($monthList as $ml)
                                        <option {{ $month == $loop->iteration ? 'selected' : '' }}
                                            value="{{ $loop->iteration }}">{{ $ml }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm mx-2">Filter</button>

                            </form>
                            <form action="{{ route('pray.changeAudio') }}" method="post" class="d-flex"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="audio" class="form-control" id="audio">
                                <button style="width: 150px" type="submit" class="btn btn-danger btn-sm mx-2">Ganti
                                    Audio</button>
                            </form>

                        </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Tanggal</td>
                                    <td>Shubuh</td>
                                    <td>Dhuhur</td>
                                    <td>Ashar</td>
                                    <td>Manggrip</td>
                                    <td>Isya</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($praySchadules as $praying)
                                    <tr>
                                        <td>
                                            {{ indexToNumber($loop->index, request()->query('page', 1)) }}
                                        </td>
                                        <td>
                                            {{ $praying->date }}
                                        </td>
                                        <td>
                                            {{ $praying->subuh }}
                                        </td>
                                        <td>
                                            {{ $praying->dhuhur }}
                                        </td>
                                        <td>
                                            {{ $praying->ashar }}
                                        </td>
                                        <td>
                                            {{ $praying->manggrip }}
                                        </td>
                                        <td>
                                            {{ $praying->isya }}
                                        </td>
                                @endforeach
                            </tbody>
                        </table>
                </div>
                <div class="card-footer">
                    {{ $praySchadules->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
