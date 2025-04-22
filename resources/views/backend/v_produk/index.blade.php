@extends('backend.v_layouts.app')

@section('content')
<!-- contentAwal -->

<div class="row">
    <div class="col-12">
        <a href="{{ route('backend.produk.create') }}">
            <button type="button" class="btn m-b-10" style="background-color:#14213D; border-radius:10px; color:white;">
                <i class="fas fa-plus"></i> Tambah
            </button>
        </a>
        <div class="card" style="border-radius:15px;">
            <div class="card-body" style="color:black;">
                <h5 class="card-title" style="color:black;">{{ $judul }}</h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr style="color:black;">
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($index) && $index->count() > 0)
                                @foreach ($index as $row)
                                    <tr style="color:black;">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $row->kategori->nama_kategori }}</td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge" style="background-color:#31603D; border-radius:15px; color:white; padding: 5px 15px 5px 15px; color:white;">Publis</span>
                                            @elseif ($row->status == 0)
                                                <span class="badge" style="background-color:#6c757d; border-radius:15px; color:white; padding: 5px 15px 5px 15px; color:white;">Blok</span>
                                            @endif
                                        </td>
                                        <td>{{ $row->nama_produk }}</td>
                                        <td>Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                                        <td>{{ $row->stok }}</td>
                                        <td>
                                            <a href="{{ route('backend.produk.edit', $row->id) }}" title="Ubah Data">
                                                <button type="button" class="btn btn-sm"
                                                    style="background-color: #FCA311; color:white; border-radius:15px; margin-right:5px;">
                                                    <i class="far fa-edit"></i> Ubah
                                                </button>
                                            </a>
                                            <a href="{{ route('backend.produk.show', $row->id) }}" title="Gambar">
                                                <button type="button" class="btn btn-sm" style="background-color:#14213D; border-radius:15px; color:white;">
                                                    <i class="fas fa-plus"></i> Gambar
                                                </button>
                                            </a>
                                            <form method="POST" action="{{ route('backend.produk.destroy', $row->id) }}"
                                                style="display: inline-block;">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-sm show_confirm"
                                                    style="background-color: #B6000F; color:white; border-radius:15px;"
                                                    data-konf-delete="{{ $row->nama }}" title="Hapus Data">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">Data tidak tersedia</td>
                                </tr>
                            @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- contentAkhir -->
@endsection