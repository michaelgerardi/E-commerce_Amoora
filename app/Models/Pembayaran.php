<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        'jenis_jasa','jenis_pembayaran','img_bukti','img_invoice','status',
    ];
    protected $table="pembayaran";
}
