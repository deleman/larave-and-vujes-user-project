<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VueController extends Controller
{
    //return a arrayc
    public function index(){
        $info = DB::table('table_posts')->select('id as user_id','name','email')->orderBy('id','desc')->paginate(10);
        return $info;
    }

    //delete user
    public function delete($id){
        return DB::delete('delete users where id = ?', [$id]);
    }
}
