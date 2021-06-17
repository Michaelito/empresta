<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TaxasInstituicoesController extends Controller
{
    public function taxas_instituicoes(Request $request)
    {
        try {

            //dd('asdf');

            $json = file_get_contents("simulador/taxas_instituicoes.json");
            $data = json_decode($json);

            if (!$json) {
                return response()->json([
                    'status' => false,
                    'message' => "Requisição não autorizada!.",
                ], 500);
            }

            //return json
            return response()->json([
                'status' => true,
                'message' => "The request has succeeded",
                'convenios' => compact('data'),
            ], 200);

        } catch (Exception $e) {

            //return json
            return response()->json([
                'status' => false,
                'message' => "The request has not succeeded",
                'message_error' => "Ocorreu algum problema: " . $e->getMessage(),
                'data' => null,
            ], 500);

        }
    }
}