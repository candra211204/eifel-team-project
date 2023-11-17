@extends('admin.asset.template')

@section('main')
<div class="row">
    <div class="col mb-4">
        <div class="card">
            <div class="card-body p-4">
                <h3 class="font-weight-bolder mb-3">Tambah Jenis Kategori</h3>
                    <div class="row">
                        <form action="{{ url('kategori') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis_kategori">Jenis Kategori</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>
                            <a href="{{ url('kategori') }}" class="btn btn-warning text-dark">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection