<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class usuarioTag extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'user_tag';
    protected $fillable = ['user_id', 'tag_id'];

    public function tag() {
        return $this->hasMany(Tag::class);
    }

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
