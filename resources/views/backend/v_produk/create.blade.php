@extends('backend.v_layouts.app') 

@section('content') 
<!-- contentAwal -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card"  style="border-radius:15px; border:1px solid black">
                <form class="form-horizontal" action="{{ route('backend.produk.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="card-body"">
                        <h4 class="card-title" style="color:black;">{{ $judul }}</h4>
                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label style="color:black;">Foto</label>
                                    <img class="foto-preview">
                                    <input style="border-radius: 10px; color:black; border:1px solid black;" type="file" name="foto"
                                        class="form-control @error('foto') is-invalid @enderror"
                                        onchange="previewFoto()">
                                    @error('foto')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label style="color:black;">Kategori</label>
                                    <select style="border-radius: 10px; color:black; border:1px solid black;" class="form-control @error('kategori') is-invalid @enderror"
                                        name="kategori_id">
                                        <option value="" selected>--Pilih Kategori--</option>
                                        @foreach ($kategori as $k) 
                                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('kategori_id')
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color:black;">Nama Produk</label>
                                    <input style="border-radius: 10px; color:black; border:1px solid black;" type="text" name="nama_produk" value="{{ old('nama_produk') }}"
                                        class="form-control @error('nama_produk') is-invalid @enderror"
                                        placeholder="Masukkan Nama Produk">
                                    @error('nama_produk')
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color:black;">Detail</label><br>
                                    <textarea style="border-radius: 10px; color:black; border:1px solid black;" name="detail"
                                        class="form-control @error('detail') is-invalid @enderror" id="ckeditor">{{ old('detail') }}</textarea>
                                    @error('detail')
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color:black;">Harga</label>
                                    <input style="border-radius: 10px; color:black; border:1px solid black;" type="text" onkeypress="return hanyaAngka(event)" name="harga"
                                        value="{{ old('harga') }}"
                                        class="form-control @error('harga') is-invalid @enderror"
                                        placeholder="Masukkan Harga Produk">
                                    @error('harga')
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color:black;">Berat</label>
                                    <input style="border-radius: 10px; color:black; border:1px solid black;" type="text" onkeypress="return hanyaAngka(event)" name="berat"
                                        value="{{ old('berat') }}"
                                        class="form-control @error('berat') is-invalid @enderror"
                                        placeholder="Masukkan Berat Produk">
                                    @error('berat')
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label style="color:black;">Stok</label>
                                    <input style="border-radius: 10px; color:black; border:1px solid black;" type="text" onkeypress="return hanyaAngka(event)" name="stok"
                                        value="{{ old('stok') }}"
                                        class="form-control @error('stok') is-invalid @enderror"
                                        placeholder="Masukkan Stok Produk">
                                    @error('stok')
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" class="btn " style="background-color:#14213D; border-radius:10px; color:white;">Simpan</button>
                            <a href="{{ route('backend.produk.index') }}">
                                <button type="button" class="btn" style="background-color:#FCA311; border-radius:10px; color:white;">Kembali</button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
.ck-rounded-corners .ck.ck-editor__main > .ck-editor__editable, .ck.ck-editor__main > .ck-editor__editable.ck-rounded-corners {
  border-radius: var(--ck-border-radius);
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
  border:1px solid black;
}
.ck-rounded-corners .ck.ck-editor__top .ck-sticky-panel .ck-toolbar, .ck.ck-editor__top .ck-sticky-panel .ck-toolbar.ck-rounded-corners {
  border-radius: var(--ck-border-radius);
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border:1px solid black;
}
</style>
<!-- contentAkhir -->
@endsection