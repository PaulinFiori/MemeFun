<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComentarioMeme extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'comentario_meme';
    protected $fillable = ['user_id', 'meme_id' , 'descricao'];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function meme() {
        return $this->belongsTo(Meme::class, "meme_id", "id");
    }
}
