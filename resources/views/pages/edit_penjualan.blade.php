@extends('component.main')
@section('main')
    <div class="card">
        <div class="card-body">
            <form action="/update_penjualan/{{ $data_penjualan['ID_NOTA'] }}" method="post">
                @csrf

                {{-- Form Hidden --}}
                <input type="hidden" name="tgl" value="{{ $data_penjualan['TGL'] }}">
                <input type="hidden" name="kode_pelanggan" value="{{ $data_penjualan['KODE_PELANGGAN'] }}">

                <div class="col-sm-12">
                    <table class="table fw-bold">
                        <tr>
                            <td>Pelanggan</td>
                            <td>:</td>
                            <td>{{ $data_penjualan['NAMA'] }}</td>
                        </tr>
                        <tr>
                            <td>Domisili</td>
                            <td>:</td>
                            <td>{{ $data_penjualan['DOMISILI'] }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pesan</td>
                            <td>:</td>
                            <td>
                                {{ date('d-M-Y', strtotime($data_penjualan['TGL'])) }}
                            </td>
                        </tr>
                    </table>
                </div>
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Total harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                            $total = 0;
                        @endphp
                        @foreach ($data_item_penjualan as $i => $item)
                            <tr>
                                <td width="5%">{{ $no++ }}</td>
                                <td width="35%">
                                    {{ $item['nama_barang'] }}
                                    <input type="hidden" name="item[]" value="{{ $item['KODE_BARANG'] }}">
                                </td>
                                <td width="20%">
                                    <input type="number" min="1" class="form-control" name="qty[]"
                                        id="qty{{ $i }}" onkeyup="updateHarga({{ $i }})"
                                        value="{{ $item['qty'] }}">
                                </td>
                                <td width="20%">
                                    <input type="text" class="form-control text-center" id="harga{{ $i }}"
                                        value="{{ $item['harga'] }}" readonly>
                                </td>
                                <td width="20%">
                                    <input type="text" id="total_harga{{ $i }}"
                                        class="form-control text-center" name="total_harga"
                                        value="{{ $item['harga'] * $item['qty'] }}" readonly>
                                    @php
                                        $total += $item['harga'] * $item['qty'];
                                    @endphp
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end">Total</td>
                            <td id="total" class="text-center">{{ $total }}</td>
                            <input type="hidden" name="total" id="val_total" value="<?= $total ?>">
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-sm btn-primary rounded-pill float-end">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
