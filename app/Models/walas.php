<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class walas extends Model
{
    use HasFactory;

    protected $table = 'datawalas';
    protected $primaryKey = 'idwalas';
    protected $fillable = ['idguru','namakelas','tahunajaran', 'jenjang'];
    public function guru(){
        return $this->belongsTo(guru::class, 'idguru', 'idguru');
    }
    public function kelas(){
        return $this->hasMany(kelas::class, 'idwalas', 'idwalas');
    }
}
