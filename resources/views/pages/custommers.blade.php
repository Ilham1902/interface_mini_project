@extends('component.main')
@section('main')
    <div class="card">
        <div class="card-body">
            <a href="{{ route('add_cust') }}" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-plus"></i> Tambah
                Pelanggan</a>
            <table class="table" id="table_list">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Domisili</th>
                        <th>Jenis Kelamin</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($custommers as $pelanggan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $pelanggan['NAMA'] }}</td>
                            <td>{{ $pelanggan['DOMISILI'] }}</td>
                            <td>{{ $pelanggan['JENIS_KELAMIN'] }}</td>
                            <td class="text-center">
                                <a href="custommers/{{ $pelanggan['ID_PELANGGAN'] }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger"
                                    onclick="hapus('{{ $pelanggan['ID_PELANGGAN'] }}')">
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
        $('#table_list').DataTable()


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
                    window.location.href = '/delete_custommers/' + id;
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
