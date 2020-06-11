<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Auth;
class UserController extends Controller
{
    public function front_page(){

        $user_list = User::all();
        $comment_list = User::where('comment','!=',null)->get();
        return view('front.welcome')->with('user_list',$user_list)->with('comment_list',$comment_list);
    }

    public function showFunctions(Request $request,$postMode){
        $data = $request->all();
        $user = Auth::user();

        if($request->ajax()){
            if($postMode == 'add-comment'){
                $insertCommentyQuery = User::where('id','=',$data['user_id'])->first();
                if($data['comment']==$insertCommentyQuery->comment){
                    return 3;
                }else{
                    $insertCommentyQuery->comment = $data['comment'];
                    if($insertCommentyQuery->save()){
    
                        return "<tr>
                                    <td>".$insertCommentyQuery->name."</td>
                                    <td>".$data['comment']."</td>
                                </tr>";
    
                    }else{
                        return $data['comment'];
                    }
                }
               

            }else{
                Session::flash('success',0);
                Session::flash('message','Undefine Method');
             }
         
        }else{
            Session::flash('success',0);
            Session::flash('message','Undefine Method');
        }
    }
}
