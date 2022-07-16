@extends('layouts.app')

@push('addon-style')
    <link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="card">
        <h1>Data Permintaan Barang</h1>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTableHistori" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Departemen</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        @php
                            $encrypted = Crypt::encrypt($transaction->id);
                        @endphp
                        <tr>
                            <td>{{ $transaction->nik }}</td>
                            <td>{{ $transaction->name }}</td>
                            <td>{{ $transaction->departemen }}</td>
                            <td>{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y H:i:s') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Aksi
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{ route('histori-request-detail',$encrypted) }}">Detail</a>
                                    </div>
                                </div>
                            </td>
                        </tr>                  
                    @endforeach 
                </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="{{ url('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
        $("#dataTableHistori").DataTable({
        ordering: false,
    });
});
    </script>
@endpush