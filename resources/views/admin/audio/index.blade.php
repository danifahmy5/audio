@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>{{ __('Daftar audio') }}</h4>
                            <a href="{{ route('audio.create') }}" class="btn btn-primary">Tambah audio</a>

                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($audio as $value)
                                    <tr>
                                        <td>
                                            {{ indexToNumber($loop->index, request()->query('page', 1)) }}
                                        </td>
                                        <td>
                                            {{ $value->name }}
                                        </td>
                                        <td>
                                            <button
                                                onclick="if(confirm('apakah yakin akan menghapus audio, jika menghapus semua audio yang terikat dengan jadwal akan di hapus')){document.getElementById('delete-{{ $value->id }}').submit()}"
                                                class="btn btn-danger">Hapus</button>
                                        </td>
                                    </tr>
                                    <form method="post" action="{{ route('audio.destroy', $value->id) }}"
                                        id="delete-{{ $value->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $audio->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
