<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Meme;
use App\Models\Seguindo;
use App\Models\Seguidores;
use Illuminate\Support\Facades\DB;

class PerfilService implements PerfilServiceInterface
{
    public function editar(Request $request) {
        if($request->_token != '') {
            $regras = [
                "nome" => "required|min:1|max:45",
                "email" => "email"
            ];

            $feedback = [
                "required" => "O campo :attribute é requirido",
                "nome.min" => "O campo nome tem que ter no mínimo 1 letra",
                "nome.max" => "O campo nome tem que ter no máximo 45 letras"
            ];

            $request->validate($regras, $feedback);

            $usuario = auth()->user();
            $usuario->tipo = auth()->user()->tipo;
            $usuario->name = $request->nome;

            $jaExisteNomeMarcacao = User::where("nome_marcacao", $request->nome_marcacao)->first();

            if($jaExisteNomeMarcacao == null) $usuario->nome_marcacao = $request->nome_marcacao;

            if($request->senha != null ) $usuario->password = Hash::make($request->senha);
            $usuario->email = $request->email;

            if($request->foto != null) {
                $tamanhoFoto = (filesize($request->file('foto')) / 1024) / 1024;

                if($tamanhoFoto > 5.0) {
                    return "Imagem enviada é maior do que 5mb.";
                }

                $file = $request->file('foto');

                //todo: salvar no s3
                /*$pastaDoArquivoNaS3 = Storage::disk('s3')->put("Fotos/", $file);*/

                $imagemUrn = $file->store('imagens', 'public');

                $linkDaFoto = 'storage/' . $imagemUrn;

                $usuario->foto = $linkDaFoto;
            }

            if($request->banner != null) {
                $tamanhoBanner = (filesize($request->file('banner')) / 1024) / 1024;

                if($tamanhoBanner > 5.0) {
                    return "Imagem enviada é maior do que 5mb.";
                }

                $file = $request->file('banner');

                //todo: salvar no s3
                /*$pastaDoArquivoNaS3 = Storage::disk('s3')->put("Banners", $file);

                $linkDaFoto = str_replace('//', '/', Storage::disk('s3')->url($pastaDoArquivoNaS3));
                $linkDaFoto = str_replace('https:/', 'https://', $linkDaFoto);*/

                $imagemUrn = $file->store('imagens', 'public');

                $linkDaFoto = 'storage/' . $imagemUrn;

                $usuario->banner = $linkDaFoto;
            }

            $usuario->save();
        } else {
            return "Ocorreu um erro no servidor.";
        }
    }

    public function buscarMemes($id) {
        $memes;

        if(!isset($_GET['filtro']) || $_GET['filtro'] == "ultimas") {
            $memes = Meme::where("user_id", $id)->orderBy("created_at", "desc")->get();
        } else if(isset($_GET['filtro']) && $_GET['filtro'] == "populares") {
            $memes = Meme::select('meme.*')
                ->join('curtida_meme', 'meme.id', '=', 'curtida_meme.meme_id')
                ->where('meme.user_id', $id)
                ->whereNull('curtida_meme.deleted_at')
                ->groupBy('meme.id')
                ->orderBy(DB::raw('COUNT(curtida_meme.meme_id)'), 'desc')
                ->get();
        } 

        return $memes;
    }

    public function buscarUsuario($id) {
        return User::find($id);
    }

    public function seguir($id) {
        DB::beginTransaction();
        try {
            Seguindo::create([
                'user_seguindo' => $id,
                'user_id' => auth()->user()->id
            ]);

            Seguidores::create([
                'user_id' => $id,
                'seguido_por' => auth()->user()->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }

    public function deseguir($id) {

        DB::beginTransaction();
        try {
            $seguindo = Seguindo::where("user_seguindo", $id)
                ->where("user_id", auth()->user()->id)
                ->first();
                
            $seguindo->delete();

            $seguidor = Seguidores::where("user_id", $id)
                ->where("seguido_por", auth()->user()->id)
                ->first();

            $seguidor->delete();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
    }
}