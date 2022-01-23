<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampling extends Model
{
    protected $fillable = [
        'slot_id','model','img','desc','jml','cus_id','admin_id','status','ling_b','ling_pgang','ling_pingl','ling_lh','leb_bahu','pj_lengan','ling_kr_leng','ling_lengan',
        'ling_pergel','leb_muka','leb_pungg','panj_pungg','panj_baju','tinggi_pingl','ling_pinggang','ling_pesak',
        'ling_paha','ling_lutut','ling_kaki','panj_cln_rok','tingg_dudk',
    ];
    protected $table="sampling";
}
