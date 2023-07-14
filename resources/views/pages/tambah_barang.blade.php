@extends('component.main')
@section('main')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('create_item') }}" method="post">
                @csrf
                <div class="col-sm-12">
                    <table class="table fw-bold">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>
                                <input type="text" class="form-control" name="nama">
                            </td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>
                                <input type="text" class="form-control" name="kategori">
                            </td>
                        </tr>
                        <tr>
                            <td>Harga</td>
                            <td>:</td>
                            <td>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                    <input type="number" class="form-control" name="harga" placeholder="Masukan Harga"
                                        aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <button type="submit" class="btn btn-sm btn-primary rounded-pill float-end">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
@endsection
