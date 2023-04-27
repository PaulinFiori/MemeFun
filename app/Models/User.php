<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use App\Notifications\PasswordReset;
use App\Notifications\BemVindo;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tipo',
        'name',
        'nome_marcacao',
        'email',
        'password',
        'foto',
        'banner'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function seguidores() {
        return $this->hasMany(Seguidores::class, "user_id", "id");
    }

    public function seguindo() {
        return $this->hasMany(Seguindo::class, "user_id", "id");
    }

    public function comentariosPost() {
        return $this->hasMany(ComentarioPost::class);
    }

    public function comentariosMeme() {
        return $this->hasMany(ComentarioMeme::class);
    }

    public function curtidasMeme() {
        return $this->hasMany(curtidaMeme::class);
    }

    public function curtidasPost() {
        return $this->hasMany(CurtidaPost::class);
    }

    public function memes() {
        return $this->hasMany(Meme::class);
    }

    public function post() {
        return $this->hasMany(Post::class);
    }

    public function usuariosTags() {
        return $this->hasMany(UserTag::class);
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new PasswordReset($token, $this->name));
    }

    public function sendBemVindoNotification() {
        $this->notify(new BemVindo($this->name));
    }
}
