<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => 'required',
            'name' => 'required',
            'kuantiti' => 'required',
            'departemen' => 'required',
            'tanggal' => 'required',
            'kode_barang' => 'required',
            'lokasi' => 'required',
            'kuantiti' => 'required',
            'satuan' => 'required',
            'keterangan' => 'required',
        ];
    }
}
