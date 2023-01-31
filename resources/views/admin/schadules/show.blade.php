@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>{{ __('Detail Jadwal') }}</h4>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="bg-light p-3">

                            <table>
                                <tr>
                                    <th>Nama</th>
                                    <td>:</td>
                                    <td>{{ $schadule->name }}</td>
                                </tr>
                                <tr>
                                    <th>Durasi</th>
                                    <td>:</td>
                                    <td>{{ $schadule->duration }} Menit</td>
                                </tr>
                                <tr>
                                    <th>Volume</th>
                                    <td>:</td>
                                    <td>{{ $schadule->volume }} %</td>
                                </tr>
                            </table>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Hari</th>
                                            <th>Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schadule->times as $item)
                                            <tr>
                                                <td>{{ $item->day }}</td>
                                                <td>{{ $item->time }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="col-6">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Audio</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schadule->audio as $audio)
                                            <tr>
                                                <td>{{ $audio->name }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
