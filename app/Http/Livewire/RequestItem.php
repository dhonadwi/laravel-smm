<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class RequestItem extends Component
{
    public $items, $nama_barang, $lokasi;
    public $updateMode = false;
    public $inputs = [];
    public $i = 0;
    public $cek = 0;

    public function add($i)
    {
        $i++;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
        $this->i = count($this->inputs);
    }

    public function store()
    {
        // $validator = Validator::make($this->inputs, [
        //     'name' => 'required',
        //     'lokasi' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['status' => false, 'message' => $validator->errors()], 422);
        // }

        // return $this->inputs;
        // $validatedDate = $this->validate(
        //     [
        //         'account.0' => 'required',
        //         'username.0' => 'required',
        //         'account.*' => 'required',
        //         'username.*' => 'required',
        //     ],
        //     [
        //         'account.0.required' => 'Account field is required',
        //         'username.0.required' => 'Username field is required',
        //         'account.*.required' => 'Account field is required',
        //         'username.*.required' => 'Username field is required',
        //     ]
        // );

        // foreach ($this->account as $key => $value) {
        //     Account::create(['account' => $this->account[$key], 'username' => $this->username[$key]]);
        // }

        // $this->inputs = [];

        // $this->resetInputFields();

        // session()->flash('message', 'Account Added Successfully.');
    }

    public function render()
    {
        $data = Item::all();
        return view('livewire.request-item', [
            'data' => $data
        ]);
    }
}
