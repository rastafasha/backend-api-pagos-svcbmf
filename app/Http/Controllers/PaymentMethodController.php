<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentmethods = PaymentMethod::orderBy('created_at', 'DESC')
        ->with([
            "currencies",
        ])
        ->get();


        return response()->json([
            'code' => 200,
            'status' => 'Listar todos los Pagos',
            'paymentmethods' => $paymentmethods,
        ], 200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentStore(Request $request)
    {
        return PaymentMethod::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function paymentShow(PaymentMethod $paymentMethod)
    {
         if (!$paymentMethod) {
            return response()->json([
                'message' => 'Pago not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'paymentMethod' => $paymentMethod,
        ], 200);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function paymentUpdate(Request $request, PaymentMethod $id)
    {
        $paymentMethod = PaymentMethod::findOrfail($id);
        $paymentMethod->bankAccount = $request->bankAccount;
        $paymentMethod->bankAccountType = $request->bankAccountType;
        $paymentMethod->bankName = $request->bankName;
        $paymentMethod->ciorif = $request->ciorif;
        $paymentMethod->clientId = $request->clientId;
        $paymentMethod->email = $request->email;
        $paymentMethod->id = $request->id;
        $paymentMethod->paypalSecret = $request->paypalSecret;
        $paymentMethod->sandoxMode = $request->sandoxMode;
        $paymentMethod->telefono = $request->telefono;
        $paymentMethod->type = $request->type;
        $paymentMethod->user = $request->user;
        
        
        
        $paymentMethod->update();
        return $paymentMethod;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function paymentDestroy(PaymentMethod $paymentMethod, $id)
    {
        $paymentMethod =  PaymentMethod::where('id', $id)
                        ->first();

        if(!empty($paymentMethod)){

            // borrar
            $paymentMethod->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'paymentMethod' => $paymentMethod
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'el tiposdepago no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

     public function paymentUpdateStatus(Request $request, $id)
    {
        $paymentMethod = PaymentMethod::findOrfail($id);
        $paymentMethod->status = $request->status;
        $paymentMethod->update();
        return $paymentMethod;
    }

    public function activos()
    {

        $paymentMethods = PaymentMethod::orderBy('created_at', 'DESC')
                
                ->where('status', $status='ACTIVE')
                ->get();
            return response()->json([
                'code' => 200,
                'status' => 'Listar tiposdepagos activas',
                'paymentMethods' => $paymentMethods,
            ], 200);
    }
}
