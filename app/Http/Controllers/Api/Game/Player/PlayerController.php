<?php

namespace App\Http\Controllers\Api\Game\Player;

use App\Http\Controllers\Api\Game\Traits\GameControllerCallableIntercept;
use App\Http\Controllers\Controller;
use App\Services\Repositories\PlayerRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class PlayerController extends Controller
{
    use GameControllerCallableIntercept;

    protected PlayerRepositoryInterface $playerRepository;

    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    function index(): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get logged player data';

        return $this->run(function (){
            return $this->playerRepository->findById(auth()->id());
        });
    }

    function getEncryptedData(): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'get encrypted data';

        return $this->run(function () {
            $string_decodificada = "Teste de encriptação.";

            $algoritmo = "AES-256-CBC";
            $chave = "q2V8UP1hT7fnXMo4iOc4KXDfAdoCZghJ";
            $iv = "VDMIUoaWFQbRjnhU";

            $string_codificada = openssl_encrypt($string_decodificada, $algoritmo, $chave, OPENSSL_RAW_DATA, $iv);

            return [
                'string_decodificada' => $string_decodificada,
                'string_codificada' => base64_encode($string_codificada)
            ];
        });
    }

    function validateEncryptedData(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->actionName = 'validate encrypted data';

        return $this->run(function () use($request){
            $string_decodificada = $request->string_decodificada;
            $string_codificada = $request->string_codificada;

            $algoritmo = "AES-256-CBC";
            $chave = "q2V8UP1hT7fnXMo4iOc4KXDfAdoCZghJ";
            $iv = "VDMIUoaWFQbRjnhU";

            $string_apos_decodificacao = openssl_decrypt(base64_decode($string_codificada), $algoritmo, $chave, OPENSSL_RAW_DATA, $iv);

            if($string_apos_decodificacao == $string_decodificada)
                return true;
            else
                return false;
        });
    }
}
