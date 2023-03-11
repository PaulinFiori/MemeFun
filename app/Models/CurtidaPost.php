<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class curtidapost extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'curtida_post';
    protected $fillable = ['user_id', 'post_id'];
}
