<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirIn extends Model
{
    use HasFactory;
    protected $table = "parkir_in";
    protected $fillable =['user_id','kategori_item_id','plat','price','price2','total','status','image','rombongan','porporasi_kebersihan','porporasi','created_at'];

    public function kategori(){
        return $this->belongsTo(KategoriItem::class,'kategori_item_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
