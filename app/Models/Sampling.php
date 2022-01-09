<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampling extends Model
{
    protected $fillable = [
        'slot_id','model','img','desc','jml','cus_id','admin_id','status',
    ];
    protected $table="sampling";
}
