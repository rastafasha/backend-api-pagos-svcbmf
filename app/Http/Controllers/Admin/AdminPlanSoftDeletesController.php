<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminPlanSoftDeletesController extends Controller
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
        $this->authorize('indexDeletes', Plan::class);

        $plans = Plan::select([
            "name",
        ])
        ->orderBy('id', 'desc')
        ->onlyTrashed()
        ->get();
            
        return response()->json([
            'code' => 200,
            'status' => 'Listar todos los planes borrados',
            'plans' => $plans,
        ], 200);
    }

    /**
     * Brings back a deleted blog post.
     * @param Int $id
     * @return JsonResponse
     */
    public function paymentDeleteShow($id)
    {   
        $this->authorize('paymentDeleteShow', Plan::class);

        try {
            DB::beginTransaction();

                $plan = Plan::select([
                    "id", "name", "created_at", "updated_at", "deleted_at",
                ])
                ->onlyTrashed()
                ->findOrFail($id);;

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Información del pago borrada',
                'plan' => $plan,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Pago no encontrado en el sistema de borrados lógicos',
            ], 200);
        }
    }


    /**
     * Brings back a deleted blog post.
     * @param Int $id
     * @return JsonResponse
     */
    public function paymentDeleteRestore(int $id)
    {   
        $this->authorize('paymentDeleteRestore', Plan::class);

        try {
            DB::beginTransaction();

            $plan = Plan::onlyTrashed()->findOrFail($id)->restore();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Pago restaurada',
                'plan' => $plan,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'No se encontra en la lista de planes borrados lógicos',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentDeleteForce($id)
    {   
        $this->authorize('paymentDeleteForce', Plan::class);

        try {
            DB::beginTransaction();

            $plan = Plan::onlyTrashed()->findOrFail($id)->forceDelete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'El plan fue borrado totalmente del sistema',
                'plan' => $plan,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Plan no encontrado',
                'Error' =>  $exception->getMessage(),
            ], 200);
        }
    }
}
