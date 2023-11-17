
@extends('admin.asset.template')

@section('main')
    <div class="row">
        <div class="col mb-4">
            <div class="card">
                <div class="card-body p-4">
                <h3 class="font-weight-bolder mb-3">Daftar Kategori</h3>
                    <a href="{{ url('kategori/create') }}" class="btn btn-primary">Tambah Data</a>
                    <div class="row">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($listkategori as $list)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $list->name }}</td>
                                    <td>
                                        <a href="{{ url('kategori/'. $list->id. '/edit') }}" class="btn btn-warning text-dark">Edit</a>
                                        <button type="submit" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('delete-kategori-{{ $list->id }}').submit();">Hapus</button>
                                        <form id="delete-kategori-{{ $list->id }}"  action="{{ url('kategori/'. $list->id ) }}"method="POST" onclick="return confirm('yakin mau hapus')">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        {{-- <a href="tablekategori/{{ $list->id }}" class="btn btn-danger" onclick="return confirm('Anda yakin akan menghapus data?')">Hapus</a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection