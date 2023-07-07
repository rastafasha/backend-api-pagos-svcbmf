<?php

namespace App\Http\Controllers\Directories;

use App\Models\Directory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicDirectoryController extends Controller
{   
    // /**
    //  * Create a new AuthController instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('jwt.verify', ['except' => ['index']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $directories = Directory::forPublic();

        return response()->json([
            'code' => 200,
            'status' => 'List Directories Public',
            'directories' => $directories,
        ], 200);
    }
}
