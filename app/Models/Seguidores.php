<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguidores extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seguido_por'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function seguidor() {
        return $this->hasOne(User::class, "id", "seguido_por");
    }
}
