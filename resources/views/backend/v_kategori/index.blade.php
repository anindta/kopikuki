@extends('backend.v_layouts.app')

@section('content')
<!-- contentAwal -->

<div class="row">
    <div class="col-12">
        <a href="{{ route('backend.kategori.create') }}">
            <button type="button" class="btn m-b-10" style="background-color:#14213D; border-radius:10px; color:white;"><i class="fas fa-plus"></i> Tambah</button>
        </a>

        <div class="card" style="border-radius:15px;">
            <div class="card-body" style="color:black;">
                <h5 class="card-title"> {{$judul}} </h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr style="color:black;">
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($index as $row)
                                <tr style="color:black;">
                                    <td> {{ $loop->iteration }} </td>
                                    <td> {{$row->nama_kategori}} </td>
                                    <td>
                                        <a href="{{ route('backend.kategori.edit', $row->id) }}" title="Ubah Data">
                                            <button type="button" class="btn btn-sm" style="background-color: #FCA311; color:white; border-radius:15px; margin-right:5px;"><i class="far fa-edit"></i> Ubah</button>
                                        </a>

                                        <form method="POST" action="{{ route('backend.kategori.destroy', $row->id) }}" style="display: inline-block;">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"  class="btn btn-sm show_confirm" style="background-color: #B6000F; color:white; border-radius:15px" data-konf-delete="{{ $row->nama_kategori }}" title="Hapus Data">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
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

<!-- contentAkhir -->
@endsection
