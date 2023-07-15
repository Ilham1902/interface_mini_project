@extends('component.main')
@section('main')
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gradient text-white mb-4" style="background-color: #4E4FEB">
                <div class="card-header text-center">
                    <h5>ORDERS</h5>
                </div>
                <div class="card-body">
                    <h1 class="text-center" style="line-height: 50px">{{ $totalPenjualan }}</h1>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('orders') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gradient text-white mb-4" style="background-color: #4E4FEB">
                <div class="card-header text-center">
                    <h5>OMSET</h5>
                </div>
                <div class="card-body">
                    <h5 class="text-center" style="line-height: 50px">Rp. {{ number_format($totalOmset, 0, ',', '.') }}
                    </h5>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('list_orders') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gradient text-white mb-4" style="background-color: #4E4FEB">
                <div class="card-header text-center">
                    <h5>PELANGGAN</h5>
                </div>
                <div class="card-body">
                    <h1 class="text-center" style="line-height: 50px">{{ $totalPelanggan }}
                    </h1>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('custommers') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-gradient text-white mb-4" style="background-color: #4E4FEB">
                <div class="card-header text-center">
                    <h5>BARANG</h5>
                </div>
                <div class="card-body">
                    <h1 class="text-center" style="line-height: 50px">{{ $totalBarang }}
                    </h1>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('inventory') }}">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
@endsection
