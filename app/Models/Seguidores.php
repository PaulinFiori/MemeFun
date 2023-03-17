<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidores extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_seguidor_id'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function seguidor() {
        return $this->hasOne(User::class, "id", "user_seguidor_id");
    }
}
