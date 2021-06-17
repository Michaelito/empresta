<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SimulacaoController extends Controller
{

    /**
     * Store a newly created resource in storeCompanieAddress.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simulacao(Request $request)
    {

        try {

            $validateData = Validator::make($request->all(), [
                "valor_emprestimo" => "required",
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'message' => $validateData->messages(),
                ], 422);
            }

            $json = file_get_contents("simulador/taxas_instituicoes.json");
            $data = json_decode($json);

            //input
            $valor_emprestimo = $request->valor_emprestimo;

            $array = [];
            foreach ($data as $key => $r) {

                $valor_parcela = number_format($valor_emprestimo / $r->parcelas, 2, '.', ' ');

                $array[$key]['taxa'] = $valor_emprestimo * $r->coeficiente;
                $array[$key]['parcelas'] = $r->parcelas;
                $array[$key]['valor_parcela'] = (float) $valor_parcela;
                $array[$key]['convenio'] = $r->convenio;

            }

            //Return json
            return response()->json([
                'status' => true,
                'message' => "The request has succeeded",
                'data' => compact('array'),
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