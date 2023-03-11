<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class curtidameme extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'curtida_meme';
    protected $fillable = ['user_id', 'meme_id'];
}
