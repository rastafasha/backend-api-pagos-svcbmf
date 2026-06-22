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
use Illuminate\Support\Facades\Storage;

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
        if ($request->hasFile('image')) {
            $path = Storage::putFile("payments", $request->file('image'));
            $request->request->add(["image" => $path]);
        }


        $payment = Payment::create([
            "referencia" => $request->patient_id,
            "metodo" => $request->appointment_id,
            "bank_name" => $request->nombre,
            "monto" => $request->monto,
            "validacion" => $request->email,
            "currency_id" => $request->bank_name,
            "nombre" => $request->metodo,
            "email" => $request->referencia,
            "user_id" => $request->status,
            "plan_id" => $request->tasabcv,
            "status" => $request->tasabcv,
            "image" => $path,
            // "status_pay" =>$request->amount != $request->amount_add ? 2 : 1,
        ]);
        //envio de correo al doctor
        // Mail::to($appointment->doctor->email)->send(new NewPaymentRegisterMail($payment));
        // Mail::to($email_doctor)->send(new NewPaymentRegisterMail($payment));

        return response()->json([
            "message" => 200,
            "payment" => $payment,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paymentShow(Payment $payment)
    {
        // $this->authorize('paymentShow', Payment::class);
        // $payment = Payment::select([
        //     "id", "referencia", "metodo", "bank_name", "monto",
        //     "validacion", "currency_id", "nombre", "email", "status", "user_id", "plan_id",
        //     "image" ])
        //     ->with(["currencies"])
        //     ->find($payment);

        if (!$payment) {
            return response()->json([
                'message' => 'Pago not found.'
            ], 404);
        }

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
    public function paymentUpdate(PaymentUpdateRequest $request, $id)
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
                'message' => 'Error no update' . $exception,
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


    public function updateStatus(Request $request, $id)
    {
        // 1. Buscamos el pago (siempre viene el ID)
        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->motivo_rechazo = $request->motivo_rechazo;
        $payment->save();

        // 2. Si es RECHAZADO, terminamos aquí para evitar errores de null
        if ($request->status === 'REJECTED') {
            return response()->json([
                'status' => 'success',
                'message' => 'Pago rechazado y notificado correctamente'
            ]);
        }

        if ($request->status === 'APPROVED') {
            // Mail::to($appointment->patient->email)->send(new ConfirmationAppointment($appointment));

        }
        return response()->json([
            "message" => 200,
            "payment" => $payment,

        ]);

    }

    public function pagosbyUser(Request $request, $patient_id)
    {

        $payments = Payment::where("patient_id", $patient_id)->orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'code' => 200,
            'status' => 'success',
            "payments" => $payments,
        ], 200);
    }

    public function pagosPendientes()
    {

        $payments = Payment::where('status', 'PENDING')->orderBy("id", "desc")
            ->paginate(10);
        return response()->json([
            "total" => $payments->total(),
            "payments" => $payments
        ]);

    }


    public function search(Request $request)
    {
        return Payment::search($request->buscar);
    }
}