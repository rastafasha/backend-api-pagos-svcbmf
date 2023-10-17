<?php

namespace App\Http\Controllers;

use App\Models\Tiposdepago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class tiposdepagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tiposdepagos = Tiposdepago::orderBy('created_at', 'DESC')
        ->get();


        return response()->json([
            'code' => 200,
            'status' => 'Listar todos los Pagos',
            'tiposdepagos' => $tiposdepagos,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentStore(Request $request)
    {
        //
        return Tiposdepago::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tiposdepago  $tipodepago
     * @return \Illuminate\Http\Response
     */
    public function paymentShow(Tiposdepago $tipodepago)
    {
        //
        if (!$tipodepago) {
            return response()->json([
                'message' => 'Pago not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'tipodepago' => $tipodepago,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentMethod  $tiposdepago
     * @return \Illuminate\Http\Response
     */
    public function edit(Tiposdepago $tiposdepago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tiposdepago  $tiposdepago
     * @return \Illuminate\Http\Response
     */
    public function paymentUpdate(Tiposdepago $request, $id)
    {
        //

        try {
            DB::beginTransaction();

            $input = $request->all();
            $tiposdepago = Tiposdepago::find($id);
            $tiposdepago->update($input);


            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Update tiposdepago success',
                'tiposdepago' => $tiposdepago,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error no update'  . $exception,
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tiposdepago  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function paymentDestroy(Tiposdepago $tiposdepago)
    {
        //

        // $this->authorize('paymentDestroy', Tiposdepago::class);

        try {
            DB::beginTransaction();


            $tiposdepago->delete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'tiposdepago delete',
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Borrado fallido. Conflicto',
            ], 409);
        }
    }

    public function UpdateStatus(Request $request, $id)
    {
        $tiposdepago = Tiposdepago::findOrfail($id);
        $tiposdepago->status = $request->status;
        $tiposdepago->update();
        return $tiposdepago;
    }

    public function activos()
    {

        $tiposdepagos = Tiposdepago::orderBy('created_at', 'DESC')
                
                ->where('status', $status='ACTIVE')
                ->get();
            return response()->json([
                'code' => 200,
                'status' => 'Listar tiposdepagos activas',
                'tiposdepagos' => $tiposdepagos,
            ], 200);
    }
}
