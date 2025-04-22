@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->

<div class="row">
    <div class="col-12">
        <a href="{{ route('backend.user.create') }}">
            <button type="button" class="btn m-b-10" style="background-color:#14213D; border-radius:10px; color:white;">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </a>
        <div class="card" style="border-radius:15px;">
            <div class="card-body" style="color:black;">
                <h5 class="card-title">{{ $judul }}</h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr style="color:black;">
                                <th>No</th>
                                <th>Email</th>
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($index as $row)
                            <tr style="color:black;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>
                                    @if ($row->role == 1)
                                    <span class="badge " style="border-radius: 10px; background-color:#698a9c; padding: 5px 15px 5px 15px; color:white;">Super Admin</span>
                                    @elseif($row->role == 0)
                                    <span class="badge " style="border-radius: 10px; background-color:#f3701e; padding: 5px 15px 5px 15px; color:white;">Admin</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($row->status == 1)
                                    <span class="badge " style="background-color: #31603D; color:white; border-radius:15px; padding: 5px 15px 5px 15px;">Aktif</span>
                                    @elseif($row->status == 0)
                                    <span class="badge badge-secondary"  style="color:white; border-radius:15px; padding: 5px 15px 5px 15px;">NonAktif</span>
                                    @endif
                                </td>
                                <td style="">
                                    <a href="{{ route('backend.user.edit', $row->id) }}" title="Ubah Data">
                                        <button type="button" class="btn btn-sm" style="background-color: #FCA311; color:white; border-radius:15px; margin-right:5px;">  
                                            <i class="far fa-edit"></i> Ubah
                                        </button>
                                    </a>
                                    <form method="POST" action="{{ route('backend.user.destroy', $row->id) }}" style="display: inline-block;">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-sm show_confirm" style="background-color: #B6000F; color:white; border-radius:15px" data-konf-delete="{{ $row->nama }}" title="Hapus Data">
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
<style>
 
</style>


<!-- contentAkhir -->
@endsection
