<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\SiteContato;

class LoginService implements LoginServiceInterface
{
    public function logar($credenciais) {
        $token = auth('api')->attempt($credenciais);

        return $token;
        //return $this->respondWithToken($token);
    }
}