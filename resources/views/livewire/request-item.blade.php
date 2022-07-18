<div>
    <div class="row">
        @foreach ($inputs as $key => $value)
        <div class="col-1">
            {{ $value }}
        </div>
        <div class="col-2">
            <select id="kode_barang_{{ $value }}" class="form-control kode_barang" name="kode_barang[]" onchange="searchItem({{ $value }})" required>
                <option value="" selected disabled>Pilih</option>
                @foreach ($data as $item)
                    <option value="{{ $item->id.'_'.$item->nama_barang }}">{{ $item->kode_barang.'-'.$item->nama_barang }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <input type="text" name="lokasi[]" id="lokasi{{ $value }}" class="form-control" readonly>
        </div>
        <div class="col-1">
            <input type="text" id="tersedia{{ $value }}" class="form-control" value="0" readonly>
        </div>
        <div class="col-1">
            <input type="text" id="kuantiti{{ $value }}" name="kuantiti[]" placeholder="kuantiti" class="form-control" onkeyup="hitung({{ $value }})" value="" required>
        </div>
        <div class="col-1">
            <input type="text" placeholder="satuan" name="satuan[]" id="satuan{{ $value }}" class="form-control" readonly>
        </div>
        <div class="col-2">
            <input type="text" class="form-control" name="keterangan[]" id="keterangan{{ $value }}" placeholder="keterangan" required>
        </div>
        <div class="col-1"> 
            <input type="status" id="status{{ $value }}" placeholder="status" class="form-control" value="" disabled>
        </div>
        <div>
            <button class="btn btn-danger mb-3" wire:click.prevent="remove({{$key}})">-</i></button>
        </div>
        @endforeach
        </div>
        <div class="row align-items-right">
            <div class="col-12 ps-0">
                    <button type="button" class="btn btn-primary float-right mr-4" wire:click.prevent="add({{ $i }})">+</button>
            </div>
        </div>
</div>

@push('prepend-script')
    
<script>
    async function getItem(idBarang,id)
    {
        const url = `{{ url('api/item/${id}') }}`
        const findItem = await fetch(url)
        const dataItem = await findItem.json()
        document.querySelector(`#lokasi${idBarang}`).value = dataItem.item.lokasi
        document.querySelector(`#tersedia${idBarang}`).value = dataItem.item.tersedia
        document.querySelector(`#satuan${idBarang}`).value = dataItem.item.satuan
    }

    function searchItem(idBarang)
    {
        const options = document.querySelector(`#kode_barang_${idBarang}`).value;
        const id = options.split("_")
        getItem(idBarang,id[0])
    }

    function hitung(id)
    {
        let barang = document.querySelector(`#kode_barang_${id}`)
        let kuantiti = document.querySelector(`#kuantiti${id}`)
        let tersedia = document.querySelector(`#tersedia${id}`)
        let status = document.querySelector(`#status${id}`)

        //cek double input
        const double = [];
        const allBarang = document.querySelectorAll('.kode_barang')
        allBarang.forEach(barang => {
            double.push(barang.value)
        })

        const cekDouble = double.filter(elem => elem == barang.value).length
        if(cekDouble >1 )
        {
            kuantiti.value = ''
            alert('Barang sudah dipilih sebelumnya')
            barang.focus()
        }
        // console.log(double.find(elem => count(elem == barang.value)))


        //ngecek barang kosong
        if(parseInt(tersedia.value) < 1 ) {
            kuantiti.value = ''
            alert('Persediaan barang habis')
            barang.focus()
        }

        //ngecek persediaan barang
        if(parseInt(kuantiti.value) > parseInt(tersedia.value)) {
            status.value='kebanyakan'
            kuantiti.value = tersedia.value
            status.value='maksimal'
        } else {
            status.value='terpenuhi'
        }
    }
</script>
@endpush