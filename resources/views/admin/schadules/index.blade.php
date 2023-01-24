@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Session::has('message'))
                    <div class="alert alert-info">
                        <strong>{{ Session::get('message') }}</strong>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <h4>{{ __('Daftar Jadwal') }}</h4>
                            <a href="{{ route('schadules.create') }}" class="btn btn-primary">Tambah jadwal</a>

                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>No</td>
                                    <td>Nama</td>
                                    <td>Dimulai saat</td>
                                    <td>Durasi</td>
                                    <td>Action</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($schadules as $value)
                                    <tr>
                                        <td>
                                            {{ indexToNumber($loop->index, request()->query('page', 1)) }}
                                        </td>
                                        <td>
                                            {{ $value->name }}
                                        </td>
                                        <td>
                                            {{-- {{ $value->times }} --}}
                                            @php
                                                $start_at = $value->times->first();
                                            @endphp
                                            {{ $start_at->day }} pada jam {{ $start_at->time }} dan
                                            {{ $value->times->count() - 1 }} lainnya
                                        </td>
                                        <td>
                                            {{ $value->duration }} Menit
                                        </td>
                                        <td>

                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('schadules.edit', $value->id) }}">Edit</a>
                                            @if ($value->status)
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('schadules.toggle', $value->id) }}">
                                                    Nonaktifkan
                                                </a>
                                            @else
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('schadules.toggle', $value->id) }}">
                                                    Aktifkan
                                                </a>
                                            @endif
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('schadules.show', $value->id) }}">Detail</a>

                                            <button
                                                onclick="if(confirm('apakah yakin akan menghapus jadwal')){document.getElementById('delete-{{ $value->id }}').submit()}"
                                                class="btn btn-danger btn-sm">Hapus</button>
                                        </td>
                                    </tr>
                                    <form method="POST" action="{{ route('schadules.destroy', $value->id) }}"
                                        id="delete-{{ $value->id }}">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        {{ $schadules->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
