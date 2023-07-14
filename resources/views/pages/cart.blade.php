@extends('component.main')
@section('main')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('orders') }}" class="text-dark fs-4" style="text-decoration: none"><i
                            class="fa-solid fa-arrow-left"></i> Back</a>
                </div>
                <form action="{{ route('checkout') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="kode_pelanggan" class="form-label">Pelanggan</label>
                                    <select class="form-select" id="pelanggan" name="kode_pelanggan"
                                        onchange="getDomisili()" required>
                                        <option selected value="">Pilih Pelanggan</option>
                                        @foreach ($pelanggan as $value)
                                            <option value="{{ $value['ID_PELANGGAN'] }}">{{ $value['NAMA'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    <label for="domisili" class="form-label">Domisili</label>
                                    <input type="text" class="form-control" id="domisili" placeholder="Domisili"
                                        required readonly>
                                    <input type="hidden" name="tgl" value="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                            <div class="col-sm-12 table-responsive mt-3">
                                <table class="table">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Item</th>
                                            <th>Qty</th>
                                            <th class="text-center">Harga</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                            $kode = session()->get('kode');
                                            $item = session()->get('item');
                                            $qty = session()->get('qty');
                                            $harga = session()->get('harga');
                                            $count = count($kode);
                                            $total = 0;
                                        @endphp
                                        @for ($i = 0; $i < $count; $i++)
                                            <tr>
                                                <td width="5%">{{ $no++ }}</td>
                                                <td width="35%">
                                                    {{ $item[$i] }}
                                                    <input type="hidden" name="item[]" value="{{ $kode[$i] }}">
                                                </td>
                                                <td width="20%">
                                                    <input type="number" min="1" class="form-control" name="qty[]"
                                                        id="qty{{ $i }}"
                                                        onkeyup="updateHarga({{ $i }})"
                                                        value="{{ $qty[$i] }}">
                                                </td>
                                                <td width="20%">
                                                    <input type="text" class="form-control text-center"
                                                        id="harga{{ $i }}" value="{{ $harga[$i] }}"
                                                        readonly>
                                                </td>
                                                <td width="20%">
                                                    <input type="text" id="total_harga{{ $i }}"
                                                        class="form-control text-center" name="total_harga"
                                                        value="{{ $harga[$i] }}" readonly>

                                                    @php
                                                        $total += $harga[$i];
                                                    @endphp
                                                </td>
                                            </tr>
                                        @endfor
                                        <tr>
                                            <td colspan="4" class="text-end">Total</td>
                                            <td id="total" class="text-center">
                                                Rp {{ $rupiah = number_format($total, 0, ',', '.') }}
                                            </td>
                                            <input type="hidden" name="total" id="val_total" value="<?= $total ?>">
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary rounded-3 float-end mb-3">Checkout</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function getDomisili() {
            var data_user = document.getElementById('pelanggan');
            var user = data_user.value;
            // console.log(user);
            fetch('http://127.0.0.1:8000/api/pelanggan/' + user)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("domisili").value = data[0].DOMISILI;
                    // Lakukan sesuatu dengan data yang diterima dari API
                    // console.log(data);
                })
                .catch(error => {
                    // Tangani error jika terjadi
                    console.error(error);
                });
        }

        function updateHarga(row) {
            var qty = parseFloat(document.getElementById("qty" + row).value);
            var harga = parseFloat(document.getElementById("harga" + row).value);
            var totalPerItem = qty * harga;

            document.getElementById("total_harga" + row).value = totalPerItem;

            calculateSubTotal(); // Panggil fungsi calculateSubTotal() setiap kali nilai total_peritem berubah
        }

        function calculateSubTotal() {
            var totalPerItems = document.getElementsByName("total_harga");
            var subTotal = 0;

            for (var i = 0; i < totalPerItems.length; i++) {
                subTotal += parseFloat(totalPerItems[i].value);
            }

            const numberSubTotal = subTotal;
            const options = {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            };
            const formatSubTotal = numberSubTotal.toLocaleString('id-ID', options);

            document.getElementById("total").textContent = formatSubTotal;
            document.getElementById("val_total").value = subTotal;
        }
    </script>
@endsection
@section('script')
    @if (session('error_orders'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error_orders') }}",
            })
        </script>
    @endif
@endsection
