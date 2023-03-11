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
    protected $fillable = ['user_id', 'post_id' , 'descricao'];

    public function usuario() {
        return $this->hasOne(User::class);
    }

    public function post() {
        return $this->hasOne(Post::class);
    }
}
