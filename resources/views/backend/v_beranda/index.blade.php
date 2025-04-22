@extends('backend.v_layouts.app')

@section('content')
<!-- contentAwal --> 

<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius:15px;">
            <div class="card-body">
                <h5 class="card-title" style="color:black"> {{$judul}}</h5>
                <div class="alert " role="alert" style="background-color:#FCA311; border-radius:15px; color:black">
                    <h4 class="alert-heading"> Selamat Datang, {{ Auth::user()->nama }}</h4>
                    Dashboard KOPIKUKI dengan hak akses yang anda miliki sebagai
                    <b>
                        @if (Auth::user()->role ==1)
                        Super Admin
                        @elseif(Auth::user()->role ==0)
                        Admin
                        @endif
                    </b>
                    ini adalah halaman utama dari Dashboard KOPIKUKI.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="card" style="border-radius:15px;">
            <div class="card-body">
                <h5 class="card-title" style="color:black">Total User</h5>
                <div class="alert" role="alert" style="background-color:#FCA311; border-radius:15px; color:black">
                    <h4 class="alert-heading">{{ $totalUser }} Pengguna</h4>
                    Jumlah pengguna yang terdaftar di Dashboard KOPIKUKI.
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card" style="border-radius:15px;">
            <div class="card-body">
                <h5 class="card-title" style="color:black">Total Produk</h5>
                <div class="alert" role="alert" style="background-color:#FCA311; border-radius:15px; color:black">
                    <h4 class="alert-heading">{{ $totalProduk }} Produk</h4>
                    Jumlah produk yang tersedia di Dashboard KOPIKUKI.
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card" style="border-radius:15px;">
            <div class="card-body">
                <h5 class="card-title" style="color:black">Statistik Pengguna dan Produk</h5>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total User', 'Total Produk'], // Label untuk grafik
                datasets: [
                    {
                        label: 'Total User', // Label untuk dataset pertama
                        data: [{{ $totalUser }}, 0], // Data untuk Total User (Total Produk di-set ke 0 untuk bar kedua)
                        backgroundColor: '#3e5569', // Warna latar belakang untuk bar pertama
                        borderColor: '#3e5569', // Border yang serasi dengan warna latar belakang bar pertama
                        borderWidth: 1 // Lebar border
                    },
                    {
                        label: 'Total Produk', // Label untuk dataset kedua
                        data: [0, {{ $totalProduk }}], // Data untuk Total Produk (Total User di-set ke 0 untuk bar pertama)
                        backgroundColor: '#FCA311', // Warna latar belakang untuk bar kedua
                        borderColor: '#FCA311', // Border yang serasi dengan warna latar belakang bar kedua
                        borderWidth: 1 // Lebar border
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Mulai sumbu Y dari 0
                    }
                }
            }
        });
    });
</script>


<!-- contentAkhir --> 
@endsection
