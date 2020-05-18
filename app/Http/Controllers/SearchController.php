<?php

namespace App\Http\Controllers;

use App\Approach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function searchData(Request $request)
    {

        $j_code = $request->input('searchData');

        $result = DB::table('approaches')
            ->select(DB::raw("*"))
            ->where('j_code', '=', $j_code)
            ->get();

        echo '<pre>';
        print_r($result);
        die();
        //return $result;
    }


    public function index()
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
