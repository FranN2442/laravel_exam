<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'extracto',
        'contenido',
        'acceso',
        'comentable',
        'caducable',
        'user_id'
    ];

    public function user(){

        return $this->belongsTo(User::class);

    }
}
