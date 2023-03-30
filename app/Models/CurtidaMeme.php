<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurtidaMeme extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'curtida_meme';
    protected $fillable = ['user_id', 'meme_id'];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function meme() {
        return $this->belongsTo(User::class, "meme_id", "id");
    }
}
