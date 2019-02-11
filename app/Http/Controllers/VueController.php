<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_encode;

class VueController extends Controller
{
    //return a arrayc
    public function index(){
        $info = DB::table('table_posts')->select('id as user_id','name','email')->orderBy('id','desc')->paginate(10);
        return $info;
    }

    //delete user
    public function delete($id){
        $result = DB::table('table_posts')->where('id', '=', $id)->delete();
        if($result){
            return json_encode(['status'=>'success']);
        }else{
            return json_encode(['status'=>'failure']);
        }
    }

    //saerch for user with name and email
    public function search($text){
        //if text is empty
        if(strlen($text)<1){
            return redirect()->route('vuejs');
        }
        // select locate('o',name),name from  table_posts where locate('o',name) >0 order by locate('o',name);
        $info = DB::table('table_posts')->select('id as user_id','name','email')->where('name','like','%'.$text.'%')->orderByRaw('locate("'.$text.'",name)')->paginate(10);
        return $info;
    }


    //update function for edit user informations
    public function update(Request $request){
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        if($request->id){
            $result = DB::table('table_posts')
            ->where('id', "$id")
            ->update(['name' => "$name",'email'=> "$email",'password'=>"$password"]);
            if($result){
                return json_encode('was updated');
            }
        }

        return json_encode('doesnt updated');
    }
}
