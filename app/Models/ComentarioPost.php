<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comentariopost extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'comentario_post';
    protected $fillable = ['user_id', 'post_id' , 'descricao'];
}
