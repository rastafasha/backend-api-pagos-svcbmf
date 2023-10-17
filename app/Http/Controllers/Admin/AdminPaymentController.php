<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Helpers\Uploader;
use App\Http\Requests\PaymentStoreRequest;
use App\Http\Requests\PaymentUpdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminPaymentController extends Controller
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
        // $this->authorize('index', Payment::class);

        $payments = Payment::orderBy('created_at', 'DESC')
        ->with([
            "currencies",
        ])
        ->get();


        return response()->json([
            'code' => 200,
            'status' => 'Listar todos los Pagos',
            'payments' => $payments,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentStore(PaymentStoreRequest $request)
    {
        // $this->authorize('paymentStore', Payment::class);

        // try {
        //     DB::beginTransaction();

        //     $payment = new Payment();

        //     $file = null;
        //     if ($request->hasFile('image')) {
        //         $file = Uploader::uploadFile('image', 'public/payments');
        //     }

        //     $input = $this->paymentInput($file);
        //     $payment->fill($input)->save();

        //     DB::commit();
        //     return response()->json([
        //         'message' => 'Payment created successfully',
        //         'payment' => $payment,
        //     ], 201);
        // } catch (\Throwable $exception) {
        //     DB::rollBack();
        //     return response()->json([
        //         'message' => 'Error no crated' . $exception,
        //     ], 500);
        // }

        return Payment::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentShow(Payment $payment)
    {
       

        if (!$payment) {
            return response()->json([
                'message' => 'Pago not found.'
            ], 404);
        }

        // $payment = Payment::select([
        //         "id", "referencia", "metodo", "bank_name", "monto",
        //     "validacion", "currency_id", "nombre", "email", "status", "user_id", "plan_id",
        //     "image"
        // ])
        // ->with(["users","plans"])
        //     ->find($payment);

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'payment' => $payment,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentUpdate(PaymentUpdateRequest $request,  $id)
    {
        try {
            DB::beginTransaction();

            $input = $request->all();
            $payment = Payment::find($id);
            $payment->update($input);


            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Update payment success',
                'payment' => $payment,
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentDestroy(Payment $payment)
    {
        $this->authorize('paymentDestroy', Payment::class);

        try {
            DB::beginTransaction();

            if ($payment->image) {
                Uploader::removeFile("public/payments", $payment->image);
            }

            $payment->delete();

            DB::commit();
            return response()->json([
                'code' => 200,
                'status' => 'Pago delete',
            ], 200);
        } catch (\Throwable $exception) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Borrado fallido. Conflicto',
            ], 409);
        }
    }

    protected function paymentInput(string $file = null): array
    {
        return [
            "referencia" => request("referencia"),
            "metodo" => request("metodo"),
            "bank_name" => request("bank_name"),
            "monto" => request("monto"),
            "validacion" => request("validacion"),
            "currency_id" => request("currency_id"),
            "nombre" => request("nombre"),
            "email" => request("email"),
            "user_id" => request("user_id"),
            "plan_id" => request("plan_id"),
            "status" => request("status"),
            "image" => $file,
        ];
    }

    protected function paymentInputUpdate(string $file = null): array
    {
        return [
            "validacion" => request("validacion"),
            "status" => request("status"),
        ];
    }

    public function recientes()
    {
        $payments = Payment::orderBy('created_at', 'DESC')
        ->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'payments' => $payments
        ], 200);
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

             \Storage::disk('payments')->put($image_name, \File::get($image));

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
         $isset = \Storage::disk('payments')->exists($filename);
         if ($isset) {
             $file = \Storage::disk('payments')->get($filename);
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

     public function deleteFotoPayment($id)
     {
         $payment = Payment::findOrFail($id);
         \Storage::delete('payments/' . $payment->image);
         $payment->image = '';
         $payment->save();
         return response()->json([
             'data' => $payment,
             'msg' => [
                 'summary' => 'Archivo eliminado',
                 'detail' => '',
                 'code' => ''
             ]
         ]);
     }

     public function search(Request $request){
        return Payment::search($request->buscar);
    }
}
