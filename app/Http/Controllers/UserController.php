<?php

namespace App\Http\Controllers;
use Auth;
use Hash;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;
class UserController extends Controller
{
    //
    function storeAvatar(Request $request){
    	$user = Auth::user();
    	if(Input::hasFile('image')){
    		$file = Input::file('image');
    		$file->move(public_path().'/avatar/', $file->getClientOriginalName());

    		$user->avatar = $file->getClientOriginalName();
    	}
    	$user->save();
    	return view('auth.profile');
    }
    function storeProfile(Request $request){
    	$user = Auth::user();
    	$user->name = $request->name;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	$user->save();
    	return view('auth.profile');
    }
    function get_users(){
        return view('auth.list');
    }
    function change_password(Request $request){
        $this->validate($request, 
        [
            'oldPassword'=>'required',
            'newPassword'=>'required|same:newPassword',
            'reTypePassword'=>'required|same:newPassword'
        ]);
        if(Auth::Check()){
            $current_password = Auth::User()->password;
            if(Hash::check($request->oldPassword, $current_password)){
                $user_id = Auth::User()->id;
                $user = User::find($user_id);
                $user->password = Hash::make($request->newPassword);
                $user->save();
                session()->flash('notif', 'Mật khẩu thay đổi thành công ');
                
                return redirect()->route('profile');
            }
            else{
                session()->flash('notif','Bạn đã nhập sai mật khẩu');
                return redirect()->route('profile');
            }
        }

    }
}
