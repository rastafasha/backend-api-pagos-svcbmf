<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Directory;

class AdminDirectorySoftDeletesController extends Controller
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
        $this->authorize('indexDeletes', Directory::class);

        $directories = Directory::all()
        ->orderBy('id', 'desc')
        ->onlyTrashed()
        ->get();
            
        return response()->json([
            'code' => 200,
            'status' => 'Listar todos los directorios borrados',
            'directories' => $directories,
        ], 200);
    }

    /**
     * Brings back a deleted blog post.
     * @param Int $id
     * @return JsonResponse
     */
    public function directoryDeleteShow($id)
    {   
        $this->authorize('directoryDeleteShow', Directory::class);

        try {
            DB::beginTransaction();

                $directory = Directory::all()
                ->onlyTrashed()
                ->findOrFail($id);;

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Información del directorio borrada',
                'directory' => $directory,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Directorio no encontrado en el sistema de borrados lógicos',
            ], 200);
        }
    }


    /**
     * Brings back a deleted blog post.
     * @param Int $id
     * @return JsonResponse
     */
    public function directoryDeleteRestore(int $id)
    {   
        $this->authorize('directoryDeleteRestore', Directory::class);

        try {
            DB::beginTransaction();

            $directory = Directory::onlyTrashed()->findOrFail($id)->restore();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Directorio restaurada',
                'directory' => $directory,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Directorio no encontrada en la lista de directorios borrados lógicos',
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function directoryDeleteForce($id)
    {   
        $this->authorize('directoryDeleteForce', Directory::class);

        try {
            DB::beginTransaction();

            $directory = Directory::onlyTrashed()->findOrFail($id)->forceDelete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Directorio borrada totalmente del sistema',
                'directory' => $directory,
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'code' => 500,
                'status' => 'Directorio no encontrada',
                'Error' =>  $exception->getMessage(),
            ], 200);
        }
    }
}
