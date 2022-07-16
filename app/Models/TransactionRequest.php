<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionRequest extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function details()
    {
        return $this->hasMany(TransactionRequestDetail::class, 'transaction_id', 'id');
    }
}
