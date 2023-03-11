<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Services\CadastrarServiceInterface;
use Illuminate\Http\Request;
use App\Http\Services\LoginServiceInterface;

class RegisterController extends Controller
{
    private $cadastrarService;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CadastrarServiceInterface $cadastrarService)
    {
        $this->middleware('guest');

        $this->cadastrarService = $cadastrarService;
    }

    protected function create(Request $request)
    {
        $msg = $this->cadastrarService->salvar($request);
        
        return redirect('/login')->with(['msg' => $msg]);
    }
}
