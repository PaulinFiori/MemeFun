<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComentarioPost extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'comentario_post';
    protected $fillable = ['user_id', 'post_id' , 'descricao', 'comentario_post'];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function post() {
        return $this->belongsTo(Post::class, "post_id", "id");
    }
}
