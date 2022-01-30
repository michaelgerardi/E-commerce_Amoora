<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInvoice extends Model
{
    protected $fillable = [
        'samp_id','prod_id','qty','ket','harga','total',
    ];
    protected $table="detail_invoice";
}
