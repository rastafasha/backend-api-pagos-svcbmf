<?php

namespace App\Http\Controllers\Admin;

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminCurrencySoftDeletesController extends Controller
{
    // /**
    //  * Create a new AuthController instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('jwt.verify');
    // }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('indexDeletes', Currency::class);

        $currencies = Currency::select([
            "name",
        ])
        ->orderBy('id', 'desc')
        ->onlyTrashed()
        ->get();
            
        return response()->json([
            'code' => 200,
            'status' => 'Listar todos las divisas o monedas borrados',
            'currencies' => $currencies,
        ], 200);
    }

    /**
     * Brings back a deleted blog post.
     * @param Int $id
     * @return JsonResponse
     */
    public function curencyDeleteShow($id)
    {   
        $this->authorize('currencyDeleteShow', Currency::class);

        try {
            DB::beginTransaction();

                $currency = Currency::select([
                    "id", "name", "created_at", "updated_at", "deleted_at",
                ])
                ->onlyTrashed()
                ->findOrFail($id);;

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Información de la moneda o divisa borrada',
                'currency' => $currency,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Moneda o divisa no encontrado en el sistema de borrados lógicos',
            ], 200);
        }
    }


    /**
     * Brings back a deleted blog post.
     * @param Int $id
     * @return JsonResponse
     */
    public function curencyDeleteRestore(int $id)
    {   
        $this->authorize('currencyDeleteRestore', Currency::class);

        try {
            DB::beginTransaction();

            $currency = Currency::onlyTrashed()->findOrFail($id)->restore();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Moneda o divisa restaurada',
                'currency' => $currency,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Moneda o divisa no encontrada en la lista de monedas o divisas borrados lógicos',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function curencyDeleteForce($id)
    {

        $this->authorize('currencyDeleteForce', Currency::class);

        try {
            DB::beginTransaction();

            $currency = Currency::onlyTrashed()->findOrFail($id)->forceDelete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Moneda o divisa borrada totalmente del sistema',
                'currency' => $currency,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Moneda o divisa no encontrada',
                'Error' =>  $exception->getMessage(),
            ], 200);
        }
    }
}
