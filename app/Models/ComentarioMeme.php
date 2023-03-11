<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comentariomeme extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'comentario_meme';
    protected $fillable = ['user_id', 'meme_id' , 'descricao'];
}
