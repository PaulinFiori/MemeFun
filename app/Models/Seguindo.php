<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguindo extends Model
{
    use HasFactory;

    protected $table = 'seguindo';

    protected $fillable = [
        'user_id',
        'user_seguindo_id'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function seguindo() {
        return $this->hasOne(User::class, "id", "user_seguindo_id");
    }
}
