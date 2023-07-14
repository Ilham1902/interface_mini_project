@extends('component.main')
@section('main')
    <style>
        .card-item {
            border: 1px solid;
            box-shadow: 5px 7px #888888 !important;
            height: 100%;
        }

        .card-item:hover {
            box-shadow: 5px 7px #0044ff !important;
        }
    </style>
    <div class="row mb-5">
        @foreach ($barang as $item)
            <div class="col-6 col-md-3 col-lg-3 mt-3">
                <div class="card rounded-3 card-item">
                    <form action="{{ route('add_cart') }}" method="post">
                        @csrf
                        <div class="card-body text-center">

                            <p class="fw-bold">{{ $item['NAMA'] }}</p>
                            <p class="fw-bold">Rp. {{ number_format($item['HARGA'], 0, ',', '.') }}</p>

                            <input type="hidden" name="item" value="{{ $item['NAMA'] }}">
                            <input type="hidden" name="kode" value="{{ $item['KODE'] }}">
                            <input type="hidden" name="harga" value="{{ $item['HARGA'] }}">
                            <input type="hidden" name="qty" value="1">
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill w-100"><i
                                    class="fa-solid fa-cart-plus"></i> Add to cart</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            })
        </script>
    @endif
    @if (session('success_orders'))
        <script>
            Swal.fire(
                'Good job!',
                "{{ session('success_orders') }}",
                'success'
            )
        </script>
    @endif
@endsection
