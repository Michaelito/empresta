<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ConveniosController extends Controller
{

    public function index(Request $request)
    {

        try {

            $json = file_get_contents("simulador/convenios.json");
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