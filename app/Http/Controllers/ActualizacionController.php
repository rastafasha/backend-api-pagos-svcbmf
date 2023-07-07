<?php

namespace App\Http\Controllers;
use App\Models\Actualizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActualizacionController extends Controller
{
    //

    public function index()
    {
        // $this->authorize('index', Directory::class);

        $actualizacions = Actualizacion::get();

        return response()->json([
            'code' => 200,
            'status' => 'List Actualizacions',
            'actualizacions' => $actualizacions,
        ], 200);
    }

    public function store(Request $request)
    {

        try {
            DB::beginTransaction();

            $validatedData = $request->all();



        $actualizacion = new Actualizacion();
        $actualizacion->nombre = $validatedData['nombre'];
        $actualizacion->surname = $validatedData['surname'];
        $actualizacion->especialidad = $validatedData['especialidad'];
        $actualizacion->universidad = $validatedData['universidad'];
        $actualizacion->ano = $validatedData['ano'];
        $actualizacion->org = $validatedData['org'];
        $actualizacion->website = $validatedData['website'];
        $actualizacion->email = $validatedData['email'];
        $actualizacion->direccion = $validatedData['direccion'];
        $actualizacion->direccion1 = $validatedData['direccion1'];
        $actualizacion->estado = $validatedData['estado'];
        $actualizacion->ciudad = $validatedData['ciudad'];
        $actualizacion->telefonos = $validatedData['telefonos'];
        $actualizacion->tel1 = $validatedData['tel1'];
        $actualizacion->telhome = $validatedData['telhome'];
        $actualizacion->telmovil = $validatedData['telmovil'];
        $actualizacion->telprincipal = $validatedData['telprincipal'];
        $actualizacion->facebook = $validatedData['facebook'];
        $actualizacion->instagram = $validatedData['instagram'];
        $actualizacion->twitter = $validatedData['twitter'];
        $actualizacion->linkedin = $validatedData['linkedin'];
        $actualizacion->save();


            DB::commit();
            return response()->json([
                'message' => 'Actualizacion created successfully',
                'actualizacion' => $actualizacion,
            ], 201);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error no crated' . $exception,
            ], 500);
        }
    }

    public function show(Actualizacion $actualizacion)
    {

        if (!$actualizacion) {
            return response()->json([
                'message' => 'actualizacion not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'actualizacion' => $actualizacion,
        ], 200);
    }

}
