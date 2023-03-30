<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meme extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'meme';
    protected $fillable = ['titulo', 'descricao', 'anexo', 'user_id'];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function curtidas() {
        return $this->hasMany(CurtidaMeme::class);
    }

    public function comentarios() {
        return $this->hasMany(ComentarioMeme::class);
    }
}
