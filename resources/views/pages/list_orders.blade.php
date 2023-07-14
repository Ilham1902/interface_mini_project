@extends('component.main')
@section('main')
    <div class="card">
        <div class="card-body">
            <table class="table" id="table_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Pelanggan</th>
                        <th>Total</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($list_orders as $orders)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ date('d-M-Y', strtotime($orders['TGL'])) }}</td>
                            <td>{{ $orders['NAMA'] }}</td>
                            <td>
                                {{-- Format angka menjadi Rupiah --}}
                                Rp {{ $rupiah = number_format($orders['SUB_TOTAL'], 0, ',', '.') }}
                            </td>
                            <td class="text-center">
                                <a href="edit_penjualan/{{ $orders['ID_NOTA'] }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid
                                    fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="hapus('{{ $orders['ID_NOTA'] }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#table_list').DataTable();

        function hapus(id) {
            event.preventDefault();

            // Menampilkan kotak konfirmasi
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data Akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengalihkan pengguna ke tautan jika dikonfirmasi
                    window.location.href = '/delete_penjualan/' + id;
                }
            });
        }
    </script>
    @if (session('success_update'))
        <script>
            Swal.fire(
                'Good job!',
                "{{ session('success_update') }}",
                'success'
            )
        </script>
    @endif
    @if (session('error_update'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('error_update') }}",
            })
        </script>
    @endif
@endsection
