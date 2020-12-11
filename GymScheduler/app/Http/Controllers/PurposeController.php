<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\Implementations\PurposeEloquent;
class PurposeController extends Controller
{
    protected $purpose;
    public function __construct(
        PurposeEloquent $purpose
    ) {
        $this->middleware('auth');  
        $this->purpose = $purpose;
    }
    public function all() {
        $res = $this->purpose->all();
        return response()->json($res, 200);
    }
}
