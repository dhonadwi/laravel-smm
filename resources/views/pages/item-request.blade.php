@extends('layouts.app')
@livewireStyles
@section('content')
            @if (session()->has('message'))
                <div class="alert alert-success">
                {{ session('message') }}
                </div>
            @endif
    @if($errors->any())
        <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        </div>
    @endif
    <div class="card">
        <h5>Tambah Permintaan Barang</h5>
            <div class="card-body">
            <form action="{{ route('simpan-request-barang') }}" method="post">
                @csrf
                <div class="row">
                    <div class="form-group col-4">
                        <label for="nik">NIK Karyawan</label>
                        <select name="nik" id="nik" class="form-control" onchange="cek()" required>
                            <option value="" selected disabled>Pilih Karyawan</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id.','.$user->nik }}">
                                    {{ $user->nik }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-4">
                        <label for="name">Nama Karyawan</label>
                        <input type="text" id="name" disabled class="form-control">
                        <input type="text" name="name" id="nameHidden" hidden>
                    </div>
                    <div class="form-group col-4">
                        <label for="departemen">Departemen</label>
                        <input type="text" id="departemen" disabled class="form-control">
                        <input type="text" name="departemen" id="departemenHidden" hidden>
                    </div>
                    <div class="form-group col">
                        <label for="departemen">Tanggal Permintaan</label>
                        <input type="datetime-local" name="tanggal" id="tanggal" class="form-control" required>
                    </div>
                </div>
                <hr class="sidebar-divider">
                <h5>Daftar Barang</h5>
                <div class="table-responsive">
                    <div class="table">
                        <div class="row mb-3">
                            <div class="col-1">#</div>
                            <div class="col-2">Barang</div>
                            <div class="col-2">Lokasi</div>
                            <div class="col-1">Tersedia</div>
                            <div class="col-1">Kuantiti</div>
                            <div class="col-1">Satuan</div>
                            <div class="col-2">Keterangan</div>
                            <div class="col-1">Status</div>
                            <div class="col">*</div>
                        </div>
                        <div>
                            @livewire('request-item')
                        </div>
                    </div>
                </div>
                 <a class="btn btn-success" href="#" data-toggle="modal" data-target="#submitModal">
                    Submit
                </a>
                <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Apakah data sudah sesuai?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Tekan tombol Submit untuk memproses.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
               {{-- <button type="submit" class="btn btn-success">Submit</button> --}}
            </form>
        </div>
    </div>
@endsection



@push('addon-script')
<script>
    async function getUser(id)
    {
        const url = `{{ url('api/user/${id}') }}`
        const findUser = await fetch(url)
        const dataUser = await findUser.json()
        document.querySelector('#name').value = dataUser.user.name
        document.querySelector('#nameHidden').value = dataUser.user.name
        document.querySelector('#departemen').value = dataUser.user.departemen
        document.querySelector('#departemenHidden').value = dataUser.user.departemen
    }

    function cek() {
        const id = document.querySelector('#nik').value;
        const nik = id.split(',');
        if(id){
            getUser(nik[0]);
        } else {
            document.querySelector('#name').value = ""
            document.querySelector('#departemen').value = ""
        }
    }
</script>
    
@endpush

@livewireScripts