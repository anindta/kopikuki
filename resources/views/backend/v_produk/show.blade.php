@extends('backend.v_layouts.app') 
@section('content') 
<!-- contentAwal -->

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" style="border-radius: 15px;">
                <div class="card-body">
                    <h4 class="card-title">{{ $judul }}</h4>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kategori_id" style="border-radius: 10px; color:black; border: 1px solid black;"
                                    class="form-control @error('kategori_id') is-invalid @enderror" disabled>
                                    <option value="" selected> - Pilih Kategori - </option>
                                    @foreach ($kategori as $row) 
                                        <option value="{{ $row->id }}" {{ old('kategori_id', $show->kategori_id) == $row->id ? 'selected' : '' }}>
                                            {{ $row->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" style="border-radius: 10px; color:black; border: 1px solid black;"
                                    value="{{ old('nama_produk', $show->nama_produk) }}"
                                    class="form-control @error('nama_produk') is invalid @enderror"
                                    placeholder="Masukkan Nama Produk" disabled>
                                @error('nama_produk')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Detail</label>
                                <textarea name="detail" class="form-control @error('detail') is-invalid @enderror"
                                    id="ckeditor" disabled>{{ old('detail', $show->detail) }}</textarea>
                                @error('detail')
                                    <span class="invalid-feedback alert-danger" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto Utama</label> <br>
                                <img src="{{ asset('storage/img-produk/' . $show->foto) }}" class="foto-preview"
                                    width="100%">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label>Foto Tambahan</label>
                            <div id="foto-container">
                                <div class="row">
                                    @foreach($show->fotoProduk as $gambar) 
                                        <div class="col-md-8">
                                            <img src="{{ asset('storage/img-produk/' . $gambar->foto) }}" width="100%" class="foto-preview">
                                        </div>
                                        <div class="col-md-4">
                                            <form action="{{ route('backend.foto_produk.destroy', $gambar->id) }}"
                                                method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn" style="background-color: #B6000F; color:white; border-radius:15px;">Hapus</button>
                                            </form>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                            </div>
                            <button type="button" class="btn add-foto mt-2" style="background-color:#14213D; border-radius:10px; color:white;">Tambah Foto</button>
                        </div>

                    </div>
                </div>

                <div class="border-top">
                    <div class="card-body">
                        <a href="{{ route('backend.produk.index') }}">
                            <button type="button" class="btn" style="background-color:#FCA311; border-radius:10px; color:white; text-decoration: none;">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .ck-rounded-corners .ck.ck-editor__main>.ck-editor__editable,
    .ck.ck-editor__main>.ck-editor__editable.ck-rounded-corners {
        border-radius: var(--ck-border-radius);
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
        border: 1px solid black;
    }

    .ck-rounded-corners .ck.ck-editor__top .ck-sticky-panel .ck-toolbar,
    .ck.ck-editor__top .ck-sticky-panel .ck-toolbar.ck-rounded-corners {
        border-radius: var(--ck-border-radius);
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        border: 1px solid black;
    }
</style>

<!-- contentAkhir -->
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const fotoContainer = document.getElementById('foto-container');
    const addFotoButton = document.querySelector('.add-foto');

    addFotoButton.addEventListener('click', function () {
        const fotoRow = document.createElement('div');
        fotoRow.classList.add('form-group', 'row');
        fotoRow.innerHTML = `
            <form action="{{ route('backend.foto_produk.store') }}" method="post" enctype="multipart/form-data"> 
                @csrf 
                <div class="col-md-12"> 
                    <input type="hidden" name="produk_id" value="{{ $show->id }}"> 
                    <input type="file" name="foto_produk[]" class="form-control @error('foto_produk') is-invalid @enderror" style="border-radius: 10px; color:black; border: 1px solid black;"> 
                    <button type="submit" class="btn" style="background-color:#31603D; border-radius:10px; color:white; margin-top:8px;">Simpan</button> 
                </div> 
            </form> 
        `;
        fotoContainer.appendChild(fotoRow);
    });
});
 
</script>