<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
    


    public function planStore(Request $request){

        if ($request->hasFile('image')) {
            $path = Storage::putFile("payments", $request->file('image'));
            $request->request->add(["image" => $path]);
        }


        $plan = Plan::create([
            "name" => $request->name,
            "price" => $request->price,
            "currency_id" => $request->currency_id,
            "image" => $path,
            // "status_pay" =>$request->amount != $request->amount_add ? 2 : 1,
        ]);
       
        return response()->json([
            "message" => 200,
            "plan" => $plan,
        ]);
    }



    public function planUpdate(Request $request, $id)
    {
       
        $plan = Plan::findOrFail($id);
        if ($request->hasFile('imagen')) {
            if ($plan->image) {
                Storage::delete($plan->image);
            }
            $path = Storage::putFile("plans", $request->file('imagen'));
            $request->request->add(["image" => $path]);
        }

        $plan->update($request->all());

        return response()->json([
            "message" => 200,
            "plan" => $plan
        ]);

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
