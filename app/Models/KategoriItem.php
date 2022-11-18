<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriItem extends Model
{
    use HasFactory;
    protected $table = "kategori_items";
    protected $fillable = ['items','price'];

    public function post(){
        return $this->hasMany(ParkirIn::class);
    }
}
