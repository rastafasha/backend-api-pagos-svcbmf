<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Uploader;
use App\Models\Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\DirectoryStoreRequest;
use App\Http\Requests\DirectoryUpdateRequest;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class AdminDirectoryController extends Controller
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
        // $this->authorize('index', Directory::class);

        $directories = Directory::get();

        return response()->json([
            'code' => 200,
            'status' => 'List Directories',
            'directories' => $directories,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function directoryStore(DirectoryStoreRequest $request)
    {
        // $this->authorize('directoryStore', Directory::class);

        try {
            DB::beginTransaction();

            $validatedData = $request->all();



        $directory = new Directory();
        $directory->user_id = auth()->user()->id;
        $directory->nombre = $validatedData['nombre'];
        $directory->surname = $validatedData['surname'];
        $directory->especialidad = $validatedData['especialidad'];
        $directory->universidad = $validatedData['universidad'];
        $directory->ano = $validatedData['ano'];
        $directory->org = $validatedData['org'];
        $directory->website = $validatedData['website'];
        $directory->email = $validatedData['email'];
        $directory->direccion = $validatedData['direccion'];
        $directory->direccion1 = $validatedData['direccion1'];
        $directory->estado = $validatedData['estado'];
        $directory->ciudad = $validatedData['ciudad'];
        $directory->telefonos = $validatedData['telefonos'];
        $directory->tel1 = $validatedData['tel1'];
        $directory->telhome = $validatedData['telhome'];
        $directory->telmovil = $validatedData['telmovil'];
        $directory->telprincipal = $validatedData['telprincipal'];
        $directory->facebook = $validatedData['facebook'];
        $directory->instagram = $validatedData['instagram'];
        $directory->twitter = $validatedData['twitter'];
        $directory->linkedin = $validatedData['linkedin'];
        $directory->vcard = $validatedData['vcard'];
        $directory->status = $validatedData['status'];
        // $directory->image = $path;
       
        $directory->save();


            DB::commit();
            return response()->json([
                'message' => 'Directory created successfully',
                'directory' => $directory,
            ], 201);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'message' => 'Error no crated' . $exception,
            ], 500);
        }
        // return Directory::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function directoryShow(Directory $directory)
    {
        // $this->authorize('directoryShow', Directory::class);

        if (!$directory) {
            return response()->json([
                'message' => 'Directory not found.'
            ], 404);
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'directory' => $directory,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function directoryUpdate(Request $request, $id)
    {
        $directory = Directory::findOrfail($id);
        $directory->user_id = $request->user_id;
        $directory->nombre = $request->nombre;
        $directory->surname = $request->surname;
        $directory->especialidad = $request->especialidad;
        $directory->universidad = $request->universidad;
        $directory->ano = $request->ano;
        $directory->org = $request->org;
        $directory->website = $request->website;
        $directory->email = $request->email;
        $directory->direccion = $request->direccion;
        $directory->direccion1 = $request->direccion1;
        $directory->estado = $request->estado;
        $directory->ciudad = $request->ciudad;
        $directory->telefonos = $request->telefonos;
        $directory->tel1 = $request->tel1;
        $directory->telhome = $request->telhome;
        $directory->telmovil = $request->telmovil;
        $directory->telprincipal = $request->telprincipal;
        $directory->facebook = $request->facebook;
        $directory->instagram = $request->instagram;
        $directory->twitter = $request->twitter;
        $directory->linkedin = $request->linkedin;
        $directory->vcard = $request->vcard;
        $directory->status = $request->status;
        // $directory->image = $request->image;

        if(empty($directory->image)){
            $directory->update();
        }else{
           $directory->image = $request->image;
        }
        $directory->update();
        return $directory;
    }
    
    public function directoryUpdateStatus(Request $request, $id)
    {
        $directory = Directory::findOrfail($id);
        $directory->status = $request->status;
        $directory->update();
        return $directory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function directoryDestroy(Directory $directory)
    {
        // $this->authorize('directoryDestroy', Directory::class);

        try {
            DB::beginTransaction();

            if ($directory->image) {
                Uploader::removeFile('/img/directories', $directory->image);
            }

            $directory->delete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Directory delete',
            ], 200);
        } catch (\Throwable $exception) {

            DB::rollBack();
            return response()->json([
                'message' => 'Error no update',
            ], 500);
        }
    }

    protected function directoryInput(string $file = null): array
    {
        return [
            "nombre" => request("nombre"),
            "surname" => request("surname"),
            "especialidad" => request("especialidad"),
            "universidad" => request("universidad"),
            "ano" => request("ano"),
            "org" => request("org"),
            "website" => request("website"),
            "email" => request("email"),
            "direccion" => request("direccion"),
            "direccion1" => request("direccion1"),
            "estado" => request("estado"),
            "ciudad" => request("ciudad"),
            "telefonos" => request("telefonos"),
            "tel1" => request("tel1"),
            "telhome" => request("telhome"),
            "telmovil" => request("telmovil"),
            "telprincipal" => request("telprincipal"),
            "facebook" => request("facebook"),
            "instagram" => request("instagram"),
            "twitter" => request("twitter"),
            "linkedin" => request("linkedin"),
            "image" => $file,
            "vcard" => request("vcard"),
            "status" => request("status"),
        ];
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    protected function generateFileName(UploadedFile $file): string {
        $extension = $file->getClientOriginalExtension();
        $fullName = $file->getClientOriginalName();
        $pathFileName = trim(pathinfo($fullName, PATHINFO_FILENAME));
        $secureMaxName = substr(Str::slug($pathFileName), 0, 90);
        return sprintf('%s-%s.%s', $secureMaxName, now()->timestamp, $extension);
    }




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

             \Storage::disk('directories')->put($image_name, \File::get($image));

             $data = [
                 'code' => 200,
                 'status' => 'success',
                 'image' => $image_name
             ];

         }

         return response()->json($data, $data['code']);// devuelve un objeto json
     }

     public function getImage($filename)
     {

         //comprobar si existe la imagen
         $isset = \Storage::disk('directories')->exists($filename);
         if ($isset) {
             $file = \Storage::disk('directories')->get($filename);
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

     public function deleteFotoDirectory($id)
     {
         $directory = Directory::findOrFail($id);
         \Storage::delete('directories/' . $directory->image);
         $directory->image = '';
         $directory->save();
         return response()->json([
             'data' => $directory,
             'msg' => [
                 'summary' => 'Archivo eliminado',
                 'detail' => '',
                 'code' => ''
             ]
         ]);
     }

     public function search(Request $request){
        return Directory::search($request->buscar);
    }
}
