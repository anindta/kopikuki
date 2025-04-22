@extends('backend.v_layouts.app') 
@section('content') 
<!-- template -->

<div class="row">
    <div class="col-12">
        <div class="card"  style="border-radius:15px;">
            <form class="form-horizontal" action="{{ route('backend.laporan.cetakuser') }}" method="post"
                target="_blank">
                @csrf
                <div class="card-body">
                    <h4 class="card-title" style="color:black;"> {{$judul}} </h4>

                    <div class="form-group" style="color:black;">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tanggal_awal" onkeypress="return hanyaAngka(event)" value="{{ old('tanggal_awal') }}" class="form-control @error('tanggal_awal') is-invalid @enderror" placeholder="Masukkan Jumlah Pinjam" style="color:black; border-radius:10px; border:1px solid black;">
                        @error('tanggal_awal')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group" style="color:black;">
                        <label>Tanggal Akhir</label>
                        <input style="color:black; border-radius:10px; border:1px solid black;" type="date" name="tanggal_akhir" onkeypress="return hanyaAngka(event)" value="{{ old('tanggal_akhir') }}" class="form-control @error('tanggal_akhir') is-invalid @enderror" placeholder="Masukkan Jumlah Pinjam">
                        @error('tanggal_akhir')
                            <span class="invalid-feedback alert-danger" role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <br>
                    <button type="submit" class="btn" style="background-color:#14213D; border-radius:10px; color:white;">Cetak</button>

            </form>
        </div>
    </div>
</div>

<!-- end template-->
@endsection