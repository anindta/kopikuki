@extends('backend.v_layouts.app') 
@section('content') 
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card" style="border-radius:15px">
                <form action="{{ route('backend.produk.update', $edit->id) }}" method="post"
                    enctype="multipart/form-data">
                    @method('put') 
                    @csrf

                    <div class="card-body">
                        <h4 class="card-title">{{ $judul }}</h4>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Foto</label>
                                    {{-- view image --}}
                                    @if ($edit->foto)
                                        <img src="{{ asset('storage/img-produk/' . $edit->foto) }}" 
                                            width="100%">
                                    @else
                                        <img src="{{ asset('storage/img-produk/imgdefault.jpg') }}" 
                                            width="100%">
                                    @endif
                                    {{-- file foto --}}
                                    <input
                                        style=" margin-top:3px; border-radius: 10px; color:black; border: 1px solid black;"
                                        type="file" name="foto" class="form-control @error('foto') is-invalid @enderror"
                                        onchange="previewFoto()">
                                    @error('foto')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select style="border-radius: 10px; color:black; border: 1px solid black;"
                                        name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="" {{ old('status', $edit->status) == '' ? 'selected' : '' }}>-
                                            Pilih Status -</option>
                                        <option value="1" {{ old('status', $edit->status) == '1' ? 'selected' : '' }}>
                                            Public</option>
                                        <option value="0" {{ old('status', $edit->status) == '0' ? 'selected' : '' }}>Blok
                                        </option>
                                    </select>
                                    @error('status')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select style="border-radius: 10px; color:black; border: 1px solid black;"
                                        name="kategori_id"
                                        class="form-control @error('kategori_id') is-invalid @enderror">
                                        <option value="" selected>- Pilih Kategori -</option>
                                        @foreach ($kategori as $row) 
                                            <option value="{{ $row->id }}" {{ old('kategori_id', $edit->kategori_id) == $row->id ? 'selected' : '' }}>
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
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;"
                                        type="text" name="nama_produk"
                                        value="{{ old('nama_produk', $edit->nama_produk) }}"
                                        class="form-control @error('nama_produk') is-invalid @enderror"
                                        placeholder="Masukkan Nama Produk">
                                    @error('nama_produk')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Detail</label><br>
                                    <textarea name="detail" class="form-control @error('detail') is-invalid @enderror"
                                        id="ckeditor">{{ old('detail', $edit->detail) }}</textarea>
                                    @error('detail')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Harga</label>
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;"
                                        type="text" onkeypress="return hanyaAngka(event)" name="harga"
                                        value="{{ old('harga', $edit->harga) }}"
                                        class="form-control @error('harga') is-invalid @enderror"
                                        placeholder="Masukkan Harga Produk">
                                    @error('harga')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Berat</label>
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;"
                                        type="text" onkeypress="return hanyaAngka(event)" name="berat"
                                        value="{{ old('berat', $edit->berat) }}"
                                        class="form-control @error('berat') is-invalid @enderror"
                                        placeholder="Masukkan Berat Produk">
                                    @error('berat')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Stok</label>
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;"
                                        type="text" onkeypress="return hanyaAngka(event)" name="stok"
                                        value="{{ old('stok', $edit->stok) }}"
                                        class="form-control @error('stok') is-invalid @enderror"
                                        placeholder="Masukkan Stok Produk">
                                    @error('stok')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn"
                                style="background-color:#14213D; border-radius:10px; color:white;">
                                Perbaharui
                            </button>
                            <a href="{{ route('backend.produk.index') }}" class="btn"
                                style="background-color:#FCA311; border-radius:10px; color:white; text-decoration: none;">
                                Kembali
                            </a>
                        </div>
                    </div>
                </form>
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