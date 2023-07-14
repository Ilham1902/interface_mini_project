@extends('component.main')
@section('main')
    @php
        $jenis_kelamin = ['PRIA' => 'PRIA', 'WANITA' => 'WANITA'];
    @endphp
    <div class="card">
        <div class="card-body">
            <form action="{{ route('create_cust') }}" method="post">
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
                            <td>Domisili</td>
                            <td>:</td>
                            <td>
                                <input type="text" class="form-control" name="domisili">
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td>:</td>
                            <td>
                                <select class="form-select" name="jenis_kelamin" required>
                                    @foreach ($jenis_kelamin as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
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
