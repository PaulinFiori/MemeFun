<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserConfiguracoes extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $table = 'users_configuracoes';
    protected $fillable = [
        'user_id',
        'modo_escuro', // 1 - modo escuro, 0 - modo claro
        'texto_cor',
        'borda_texto_cor'
    ];

    public function usuario() {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
