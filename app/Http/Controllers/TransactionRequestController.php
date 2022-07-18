<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Models\TransactionRequest;
use App\Models\TransactionRequestDetail;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class TransactionRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = TransactionRequest::with('details')
            ->orderBy('created_at', 'DESC')
            ->get();

        // return $data;
        return view('pages.histori', [
            'transactions' => $transactions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTransactionRequest $request)
    {
        $data = $request->all();

        //split id dan nik
        $split = explode(",", $data['nik']);
        $data['id'] = $split[0];
        $data['nik'] = $split[1];

        DB::beginTransaction();
        try {
            //create request transaction
            $transaction = TransactionRequest::create([
                'user_id' => $data['id'],
                'nik' => $data['nik'],
                'name' => $data['name'],
                'departemen' => $data['departemen'],
                'tanggal' => $data['tanggal']
            ]);

            foreach ($data['kode_barang'] as $key => $value) {
                $nama_barang = explode("_", $data['kode_barang'][$key]);

                // update kuantiti
                $item = Item::find($nama_barang[0]);
                $item['tersedia'] = $item['tersedia'] - $data['kuantiti'][$key];
                $item->save();

                //create transaction detail
                TransactionRequestDetail::create([
                    'transaction_id' => $transaction->id,
                    'nama_barang' => $nama_barang[1],
                    'lokasi' => $data['lokasi'][$key],
                    'kuantiti' => $data['kuantiti'][$key],
                    'satuan' => $data['satuan'][$key],
                    'keterangan' => $data['keterangan'][$key]
                ]);
            }

            DB::commit();
            return redirect()->route('request-barang')->with('message', 'Berhasil simpan data request.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('request-barang')->with('message', $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionRequest  $transactionRequest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        $transaction = TransactionRequest::with('details')
            ->where('id', $id)
            ->first();

        // return $transaction;
        return view('pages.histori-detail', [
            'transaction' => $transaction
        ]);
    }
}
