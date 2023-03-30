<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'post';
    protected $fillable = ['titulo', 'descricao', 'anexo', 'user_id'];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function curtidas() {
        return $this->hasMany(CurtidaPost::class)->where("curtida", 1);
    }

    public function naoCurtidas() {
        return $this->hasMany(CurtidaPost::class)->where("curtida", 0);
    }


    public function comentarios() {
        return $this->hasMany(ComentarioPost::class);
    }
}
