<?php

namespace App\Http\Controllers\Admin;

use JWTAuth;
use App\Models\User;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CurrencyFormRequest;
use App\Http\Requests\CurrencyUpdateRequest;

class AdminCurrencyController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $this->authorize('index', Currency::class);

       $currenciesAll = Currency::get();

        return response()->json([
            'code' => 200,
            'status' => 'List Currencies',
            'currenciesAll' => $currenciesAll,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CurrencyFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function currencyStore(CurrencyFormRequest $request)
    {
        // $this->authorize('currencyStore', Currency::class);

        try {
            DB::beginTransaction();

            $currency = new Currency();

            $input = $this->currencyInput();
            $currency->fill($input)->save();

            DB::commit();

            Log::info("Creación de moneda exitoso- 
            Usuario: {$request->user()->username}, Agent: {$request->header('user-agent')}");

            return response()->json([
                'message' => 'Currency created successfully',
                'currency' => $currency,
            ], 201);
        } catch (\Throwable $exception) {
            DB::rollBack();

            Log::error("Error en crear una moneda - Usuario: 
            {$request->user()->username} Mensaje de error: {$exception->getMessage()}");


            return response()->json([
                'message' => 'Error no crated',
                'exception' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function currencyShow(Currency $currency)
    {
        $currency = Currency::find($id);

        if(is_object($currency)){
            $data = [
                'code' => 200,
                'status' => 'success',
                '$currency' => $currency
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'error',
                'message' => 'La $currency no existe.'
            ];
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CurrencyFormRequest  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function currencyUpdate(CurrencyFormRequest $request, Currency $currency)
    {
        $this->authorize('currencyStore', Currency::class);
        try {
            DB::beginTransaction();

            $input = $this->currencyInput();
            $currency->fill($input)->update();

            DB::commit();

            Log::info("Creación de plan exitoso- 
            Usuario: {$request->user()->username}, Agent: {$request->header('user-agent')}");


            return response()->json([
                'code' => 200,
                'status' => 'Update currency success',
                'currency' => $currency,
            ], 200);
        } catch (\Throwable $exception) {

            DB::rollBack();

            Log::error("Error en crear un plan - Usuario: 
            {$request->user()->username} Mensaje de error: {$exception->getMessage()}");

            return response()->json([
                'message' => 'Error no update',
                'exception' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function currencyDestroy(Request $request, Currency $currency)
    {

        $this->authorize('currencyDestroy', Currency::class);
        try {
            DB::beginTransaction();

            $currency->delete();

            DB::commit();

            Log::info("Borrado de Moneda exitoso- 
            Usuario: {$request->user()->username}, Agent: {$request->header('user-agent')}");


            return response()->json([
                'code' => 200,
                'status' => 'Currency delete',
            ], 200);
        } catch (\Throwable $exception) {

            DB::rollBack();

            Log::error("Error en borrar una moneda - Usuario: 
            {$request->user()->username} Mensaje de error: {$exception->getMessage()}");
            return response()->json([
                'message' => 'Error no update',
                'exception' => $exception->getMessage(),
            ], 500);
        }
    }

    /**
     * Función protegida para guardar los datos
     *
     * @return array
     */
    protected function currencyInput(): array
    {
        return [
            "name" => request("name"),
        ];
    }
}
