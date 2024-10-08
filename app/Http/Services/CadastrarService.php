<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\BemVindoMail;
use Illuminate\Http\File;

class CadastrarService implements CadastrarServiceInterface
{
    public function salvar(Request $request) {
        if($request->_token != '') {
            $regras = [
                "Nome" => "required|min:1|max:45",
                "Senha" => "required|min:6",
                "Email" => "email",
                "Nome_Marcacao" => "required|unique:users,nome_marcacao"
            ];

            $feedback = [
                "required" => "O campo :attribute é requirido",
                "Nome.min" => "O campo nome tem que ter no mínimo 1 letra",
                "Nome.max" => "O campo nome tem que ter no máximo 45 letras",
                "Senha.min" => "O campo senha tem que ter no mínimo 6 letras",
                "Nome_Marcacao.unique" => "O campo nome de usuário tem que ser único"
            ];

            $request->validate($regras, $feedback);

            $usuario = new User();
            $usuario->tipo = "U";
            $usuario->name = $request->Nome;
            $usuario->nome_marcacao = $request->Nome_Marcacao;
            $usuario->password = Hash::make($request->Senha);
            $usuario->email = $request->Email;

            if($request->Foto != null) {
                $tamanhoFoto = (filesize($request->file('Foto')) / 1024) / 1024;

                if($tamanhoFoto > 5.0) {
                    return "Imagem enviada é maior do que 5mb.";
                }

                $file = $request->file('Foto');

                //todo: salvar no s3
                /*$pastaDoArquivoNaS3 = Storage::disk('s3')->put("Fotos/", $file);*/

                $imagemUrn = $file->store('imagens', 'public');

                $linkDaFoto = 'storage/' . $imagemUrn;

                $usuario->foto = $linkDaFoto;
            }

            if($request->Banner != null) {
                $tamanhoBanner = (filesize($request->file('Banner')) / 1024) / 1024;

                if($tamanhoBanner > 5.0) {
                    return "Imagem enviada é maior do que 5mb.";
                }

                $file = $request->file('Banner');

                //todo: salvar no s3
                /*$pastaDoArquivoNaS3 = Storage::disk('s3')->put("Banners", $file);

                $linkDaFoto = str_replace('//', '/', Storage::disk('s3')->url($pastaDoArquivoNaS3));
                $linkDaFoto = str_replace('https:/', 'https://', $linkDaFoto);*/

                $imagemUrn = $file->store('imagens', 'public');

                $linkDaFoto = 'storage/' . $imagemUrn;

                $usuario->banner = $linkDaFoto;
            }

            $usuario->save();

            $usuario->sendBemVindoNotification();
            //Mail::to($usuario->email)->send(new BemVindoMail($usuario));

            return "Cadastrado com sucesso";
        }
    }

    public static function getPastaFoto_AWSS3() {
        return 'USUARIO_FOTO';
    }

    public static function getPastaBanner_AWSS3() {
        return 'USUARIO_BANNER';
    }
}