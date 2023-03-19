<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ComunidadeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MelhoresController;
use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SeguidoresController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CadastrarController;
use App\Http\Controllers\RecuperarSenhaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')->name("home");
});

Route::controller(MelhoresController::class)->group(function() {
    Route::get('/melhores', 'melhores')->name("melhores");
});

Route::controller(SeguidoresController::class)->group(function() {
    Route::get('/seguidores', 'seguidores')->name("seguidores");
});

Route::controller(ComunidadeController::class)->group(function() {
    Route::get('/comunidade', 'comunidades')->name("comunidades");

    Route::get('/novo-post-comunidade', 'novoPostComunidade')->name("novo-post-comunidade");
    Route::post('/novo-post-comunidade', 'salvarNovoPostComunidade')->name("novo-post-comunidade");
});

Route::controller(PostsController::class)->group(function() {
    Route::get('/novo-post', 'novoPost')->name("novo-post");
    Route::post('/novo-post', 'salvarNovoPost')->name("novo-post");

    Route::get('/meme/{id}', 'memeEspecifico')->name("meme-especifico");
});

Route::controller(NotificacaoController::class)->group(function() {
    Route::get('/notificacao', 'notificacao')->name("notificacao");
});

Route::controller(PerfilController::class)->group(function() {
    Route::get('/perfil/{id}', 'perfil')->name("perfil");
    Route::get('/editar-perfil', 'editarPerfil')->name("editar-perfil");
    Route::post('/editar-perfil', 'salvarEditarPerfil')->name("editar-perfil");
    Route::get('/configuracoes', 'configuracoes')->name("configuracoes");
    Route::post('/sair', 'sair')->name("sair");
});

Route::controller(RankingController::class)->group(function() {
    Route::get('/ranking', 'ranking')->name("ranking");
});

Route::controller(LoginController::class)->group(function() {
    Route::get('/login', 'index')->name("login");
});

Route::controller(CadastrarController::class)->group(function() {
    Route::get('/cadastro', 'index')->name("cadastro");
    Route::post('/cadastro', 'salvarCadastro')->name("cadastro");
});

Route::controller(RecuperarSenhaController::class)->group(function() {
    Route::get('/recuperar-senha', 'index')->name("recuperar-senha");
    Route::post('/recuperar-senha', 'enviarSenha')->name("enviar-senha");

    Route::get('/recuperar-senha/nova-senha', 'novaSenha')->name("nova-senha");
    Route::post('/recuperar-senha/nova-senha', 'salvarSenha')->name("nova-senha");
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
