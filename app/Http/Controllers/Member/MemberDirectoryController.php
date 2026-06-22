<?php

namespace App\Http\Controllers\Member;

use App\Models\User;
use App\Helpers\Uploader;
use App\Models\Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DirectoryStoreRequest;
use App\Http\Requests\DirectoryUpdateRequest;
use Illuminate\Support\Str;

class MemberDirectoryController extends Controller
{
    //  /**
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

        $directories = Directory::forMember();

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
        // $directory_is_valid = Directory::where("n_doc", $request->n_doc)->first();

        // if ($directory_is_valid) {
        //     return response()->json([
        //         "message" => 403,
        //         "message_text" => 'el directory ya existe'
        //     ]);
        // }

        if ($request->hasFile('image')) {
            $path = Storage::putFile("directories", $request->file('imagen'));
            $request->request->add(["image" => $path]);
        }

        $directory = Directory::create($request->all());

        return response()->json([
            "message" => 200,
            "directory" => $directory,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function directoryShow(Directory $directory)
    {
        // $this->authorize('directoryShow',$directory);

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


        $directory = Directory::findOrFail($id);
        if ($request->hasFile('imagen')) {
            if ($directory->image) {
                Storage::delete($directory->image);
            }
            $path = Storage::putFile("directories", $request->file('imagen'));
            $request->request->add(["image" => $path]);
        }

        $directory->update($request->all());

        return response()->json([
            "message" => 200,
            "directory" => $directory
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function directoryDestroy(Directory $directory)
    {

        // $this->authorize('directoryDestroy', $directory);

        try {
            DB::beginTransaction();

            if ($directory->image) {
                Uploader::removeFile("public/directories", $directory->image);
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


    public function search(Request $request)
    {
        // Get the search value from the request
        $search = $request->input('search');

        // Search in the title and body columns from the posts table
        $directories = Payment::query()
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        // Return the search view with the resluts compacted
        // return view('search', compact('plans'));
    }
}
