@extends('Backend.V_Layouts.App') 
@section('content') 
<!-- contentAwal --> 

<div class="container-fluid"> 
    <div class="row"> 
        <div class="col-12"> 
            <div class="card" style="border-radius:15px"> 
                <form class="form-horizontal" action="{{ route('backend.user.store') }}" method="post" enctype="multipart/form-data"> 
                    @csrf 

                    <div class="card-body" style="border-radius:15px"> 
                        <h4 class="card-title" style="color:black;">{{ $judul }}</h4> 
                        <div class="row"> 
                            <div class="col-md-4"> 
                            <div class="form-group">
                                    <label style="color:black;">Foto Preview</label>
                                    <img class="foto-preview">
                                    <input style="border-radius: 10px; color:black; border:1px solid black; margin-top:3px;" type="file" name="foto"
                                        class="form-control @error('foto') is-invalid @enderror"
                                        onchange="previewFoto()">
                                    @error('foto')
                                        <div class="invalid-feedback alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-md-8"> 
                                <div class="form-group"> 
                                    <label style="color:black;">Hak Akses</label> 
                                    <select name="role" class="form-control @error('role') is-invalid @enderror" style="border-radius: 10px; color:black; border: 1px solid black;"> 
                                        <option value="" {{ old('role') == '' ? 'selected' : '' }}> - Pilih Hak Akses - </option> 
                                        <option value="1" {{ old('role') == '1' ? 'selected' : '' }}>Super Admin</option> 
                                        <option value="0" {{ old('role') == '0' ? 'selected' : '' }}>Admin</option> 
                                        <option value="2" {{ old('role') == '2' ? 'selected' : '' }}>User</option>
                                    </select> 
                                    @error('role') 
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span> 
                                    @enderror 
                                </div> 
                                <div class="form-group"> 
                                    <label style="color:black;">Nama</label> 
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;" type="text" name="nama" value="{{ old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama"> 
                                    @error('nama') 
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span> 
                                    @enderror 
                                </div> 
                                <div class="form-group"> 
                                    <label style="color:black;">Email</label> 
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;" type="text" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"> 
                                    @error('email') 
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span> 
                                    @enderror 
                                </div> 
                                <div class="form-group"> 
                                    <label style="color:black;">HP</label> 
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;" type="text" onkeypress="return hanyaAngka(event)" name="hp" value="{{ old('hp') }}" class="form-control @error('hp') is-invalid @enderror" placeholder="Masukkan Nomor HP"> 
                                    @error('hp') 
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span> 
                                    @enderror 
                                </div> 
                                <div class="form-group"> 
                                    <label style="color:black;">Password</label> 
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan Password"> 
                                    @error('password') 
                                        <span class="invalid-feedback alert-danger" role="alert">{{ $message }}</span> 
                                    @enderror 
                                </div> 
                                <div class="form-group"> 
                                    <label style="color:black;">Konfirmasi Password</label> 
                                    <input style="border-radius: 10px; color:black; border: 1px solid black;" type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password"> 
                                </div> 
                            </div> 
                        </div> 
                    </div> 
                    <div class="border-top"> 
                        <div class="card-body"> 
                            <button type="submit" class="btn" style="background-color:#14213D; border-radius:10px; color:white;">Simpan</button> 
                            <a href="{{ route('backend.user.index') }}" class="btn" style="background-color:#FCA311; border-radius:10px; color:white;">Kembali</a> 
                        </div> 
                    </div> 
                </form> 
            </div> 
        </div> 
    </div> 
</div> 

<!-- contentAkhir --> 
@endsection
