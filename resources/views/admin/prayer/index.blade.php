@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>{{ __('Daftar jadwal sholat') }}</h4>

                        </div>
                    </div>
                    <div class="card-body">
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
