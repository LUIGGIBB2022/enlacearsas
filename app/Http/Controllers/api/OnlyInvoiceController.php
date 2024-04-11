<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class OnlyInvoiceController extends Controller
{
    public function OnlyInvoice(Request $request):JsonResponse
    {
        return response()->json(
            [
             'status'           => '200',
             'msg'              => 'Salida Exitosa',
             'request'      => $request->datafactura,
            ],Response::HTTP_ACCEPTED);
    }
}
