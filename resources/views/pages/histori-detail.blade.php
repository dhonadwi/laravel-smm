@extends('layouts.app')

@push('addon-style')
    <link href="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="card">
       <div class="card-body">
        <table class="table table-striped">
                <tbody>
                  <tr>
                    <th>NIK</th>
                    <th colspan="4">{{ $transaction->nik }}</th>
                  </tr>
                  <tr>
                    <th>Nama</th>
                    <td colspan="4">{{ $transaction->name }}</td>
                  </tr>
                  <tr>
                    <th>Departemen</th>
                    <td colspan="4">{{ $transaction->departemen }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal Permintaan</th>
                    <td colspan="4">{{ \Carbon\Carbon::parse($transaction->tanggal)->format('d-m-Y H:i:s') }}</td>
                  </tr>
                  <tr>
                    <th>Tanggal Input</th>
                    <td colspan="4">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y H:i:s') }}</td>
                  </tr>
                </tbody>
            </table>
            <p>Detail Barang</p>
            <table class="table" id="dataTableDetail">
                <thead>
                    <th>Nama Barang</th>
                    <th>Lokasi</th>
                    <th>Kuantiti</th>
                    <th>Satuan</th>
                    <th>Keterangan</th>
                </thead>
                <tbody>
                    @foreach ($transaction->details as $detail)
                    <tr>
                        <td>{{ $detail->nama_barang }}</td>
                        <td>{{ $detail->lokasi }}</td>
                        <td>{{ $detail->kuantiti }}</td>
                        <td>{{ $detail->satuan }}</td>
                        <td>{{ $detail->keterangan }}</td>
                    </tr>
                @endforeach          
                </tbody>
            </table>
       </div>
       <a href="{{ route('histori-request') }}" class="btn btn-danger">Kembali</a>
    </div>
@endsection

@push('addon-script')
    <script src="{{ url('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
        $("#dataTableDetail").DataTable({
        ordering: true,
    });
});
    </script>
@endpush