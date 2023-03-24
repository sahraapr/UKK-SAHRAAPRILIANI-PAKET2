<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Petugas extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    protected $fillable = ['nama_petugas', 'username', 'password', 'telp', 'level', 'status'];

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_petugas', 'id_petugas');
    }
}
