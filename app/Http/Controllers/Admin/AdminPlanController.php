<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\User;
use App\Helpers\Uploader;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\PlanUpdateRequest;

class AdminPlanController extends Controller
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
        // $this->authorize('index', Plan::class);

        $plans = Plan::all();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'plans' => $plans,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function planStore(Request $request){
    //     // Recoger los datos por post
    //     $json = $request->input('json',null);
    //     $params = json_decode($json);
    //     $params_array = json_decode($json, true);

    //     if(!empty($params_array)){



    //         // Validar los datos
    //         $validate =  \Validator::make($params_array, [
    //             'name' => 'required',
    //             'price' => 'required',
    //             'currency_id' => 'required',
    //             'status' => 'required',
    //         ]);

    //         // Guardar la categoria
    //         if($validate->fails()){
    //             $data = [
    //                 'code' => 400,
    //                 'status' => 'error',
    //                 'message' => 'No se ha guardado el plan.'
    //             ];
    //         }else{
    //             $plan = new Plan();
    //             $plan->name = $params->name;
    //             $plan->price = $params->price;
    //             $plan->currency_id = $params->currency_id;
    //             $plan->status = $params->status;
    //             $plan->save();

    //             $data = [
    //                 'code' => 200,
    //                 'status' => 'success',
    //                 'plan' => $plan
    //             ];
    //         };
    //     }else{
    //         $data = [
    //             'code' => 400,
    //             'status' => 'error',
    //             'message' => 'No has enviado ningun plan.'
    //         ];
    //     }
    //     // Devolver resultado
    //     return response()->json($data, $data['code']);

    // }


    public function planStore(Request $request){
        return Plan::create($request->all());
    }


    // public function planUpdate($id, Request $request){
    //     // recoger los datos por post
    //     $json = $request->input('json', null);
    //     $params_array = json_decode($json, true);

    //     if(!empty($params_array)){

    //         // validar los datos
    //         $validar = \Validator::make($params_array, [
    //             'name' => 'required',
    //             'price' => 'required',
    //             'currency_id' => 'required',
    //             'status' => 'required',
    //         ]);
    //         // quitar lo que no quiero actualizar
    //         unset($params_array['id']);
    //         unset($params_array['created_at']);

    //         // actualizar el registro(categoria)
    //         $plan = Plan::where('id', $id)->update($params_array);

    //         $data = [
    //             'code' => 200,
    //             'status' => 'success',
    //             'plan' => $params_array
    //         ];

    //     }else{
    //             $data = [
    //                 'code' => 400,
    //                 'status' => 'error',
    //                 'message' => 'No has enviado ninguna plan.'
    //             ];
    //     }
    //     // devolver los datos
    //     return response()->json($data, $data['code']);
    // }

    public function planUpdate(Request $request, $id)
    {
        $plan = Plan::findOrfail($id);
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->currency_id = $request->currency_id;
        $plan->status = $request->status;
        $plan->image = $request->image;
        $plan->update();
        return $plan;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function planShow($id){
        // $this->authorize('planShow', Plan::class);
        $plan = Plan::find($id);

        if(is_object($plan)){
            $data = [
                'code' => 200,
                'status' => 'success',
                'plan' => $plan
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La plan no existe.'
            ];
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function planDestroy($id, Request $request){

        // conseguir el usuario identificado
        // $user = $this->getIdentity($request);

        // conseguir el video
        $plan =  Plan::where('id', $id)
                        ->first();

        if(!empty($plan)){

            // borrar
            $plan->delete();
            // devolver respuesta
            $data = [
                'code' => 200,
                'status' => 'success',
                'plan' => $plan
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'el plan no existe'
            ];
        }

        return response()->json($data, $data['code']);
    }

    protected function planInput(string $fileName = null): array
    {
        return [
            "name" => request("name"),
            "price" => request("price"),
            "currency_id" => request("currency_id"),
            "image" =>  $fileName,
        ];
    }

    protected function generateFileName(UploadedFile $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $fullName = $file->getClientOriginalName();
        $pathFileName = trim(pathinfo($fullName, PATHINFO_FILENAME));
        $secureMaxName = substr(Str::slug($pathFileName), 0, 90);
        return sprintf('%s-%s.%s', $secureMaxName.now()->timestamp, $extension);
    }




    // subir imagen avatar
    public function upload(Request $request)
    {
        // recoger la imagen de la peticion
        $image = $request->file('file0');
        // validar la imagen
        $validate = \Validator::make($request->all(),[
            'file0' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);
        //guardar la imagen en un disco
        if(!$image || $validate->fails()){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'Error al subir la imagen'
            ];
        }else{

            $extension = $image->getClientOriginalExtension();
            $image_name = $image->getClientOriginalName();
            $pathFileName = trim(pathinfo($image_name, PATHINFO_FILENAME));
            $secureMaxName = substr(Str::slug($image_name), 0, 90);
            $image_name = now().$secureMaxName.'.'.$extension;


            // $image_name = $image->getClientOriginalName();
            \Storage::disk('plans')->put($image_name, \File::get($image));

            $data = [
                'code' => 200,
                'status' => 'success',
                'image' => $image_name
            ];

        }

        //return response($data, $data['code'])->header('Content-Type', 'text/plain'); //devuelve el resultado

        return response()->json($data, $data['code']);// devuelve un objeto json
    }

    public function getImage($filename)
    {

        //comprobar si existe la imagen
        $isset = \Storage::disk('plans')->exists($filename);
        if ($isset) {
            $file = \Storage::disk('plans')->get($filename);
            return new Response($file, 200);
        } else {
            $data = array(
                'status' => 'error',
                'code' => 404,
                'mesaje' => 'Imagen no existe',
            );

            return response()->json($data, $data['code']);
        }

    }

    public function deleteFotoPlan($id)
    {
        $plan = Plan::findOrFail($id);
        \Storage::delete('plans/' . $plan->image);
        $plan->image = '';
        $plan->save();
        return response()->json([
            'data' => $plan,
            'msg' => [
                'summary' => 'Archivo eliminado',
                'detail' => '',
                'code' => ''
            ]
        ]);
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $plans = Plan::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        // return view('search', compact('plans'));
    }
}
