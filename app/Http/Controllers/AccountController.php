<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Auth;
use App\Accounts;
use App\Transaction;
use App\Parents;
use App\Students;
use App\Groups;

class AccountController extends Controller
{
    
    function searchAccount(Request $request){
    	$term = $request->term;
    	if(empty($term)){
    		return \Response::json([]);
    	}
    	else{
    		$acc = Accounts::where('name','LIKE','%'.$term.'%')->get()->toArray();
    		return \Response::json($acc);
    	}
    }
    function searchAccountParents(Request $request){
        if(empty($request->term)){
            return \Response::json([]);
        }
        else{
<<<<<<< HEAD
            $resultAccount = array();
            $resultAccount = Accounts::where('name','LIKE','%'.$request->term.'%')->where('type',1)->get()->toArray();
            $parent = Parents::where('phone','LIKE','%'.$request->term.'%')->get()->toArray();
            foreach ($parent as $key => $value) {
                # code...
                $parentAcc = Accounts::find($value['acc_id'])->toArray();
                array_push($resultAccount, $parentAcc);
            }

=======
                $resultAccount = array();
                $resultAccount = Accounts::where('name','LIKE','%'.$request->term.'%')->where('type',1)->get()->toArray();
                $parent = Parents::where('phone','LIKE','%'.$request->term.'%')->get()->toArray();
                foreach ($parent as $key => $value) {
                    # code...
                    $parentAcc = Accounts::find($value['acc_id'])->toArray();
                    array_push($resultAccount, $parentAcc);
            }
>>>>>>> master
            return \Response::json($resultAccount);
        }
    }
    function list_account(){        
        $accounts = Accounts::orderBy('id','DESC')->get();
        foreach ($accounts as $key => $value) {
            # code...
            $value->groups = $value->groups()->select('groups.id','groups.name')->get();
            $negTransaction = Transaction::where('from',$value->id)->sum('amount');
            $posTransaction = Transaction::where('to',$value->id)->sum('amount');
            $accounts[$key]->balance = $posTransaction-$negTransaction;
        }
        return $accounts;
    }
    function view_list(){
        return view('account.list');
    }
    function add_new(Request $request){
        $account = new Accounts();
        $account->name = $request->name;
        $account->dob = isset($request->dob) ? $request->dob : NULL;
        $account->type = $request->type;
        $account->cat = $request->cat;
        $account->save();
        if(isset($request->groups)){
            foreach ($request->groups as $key => $value) {
                # code...
                $account->groups()->attach($value['id']);
            }
        }
        $account->groups = $account->groups()->select('groups.id','groups.name')->get();
        return 1;
    }
    function get_edit($id){
        $account = Accounts::find($id);
        $account->groups = $account->groups()->get();
        return $account;
    }
    function post_group(Request $request){
        // Tạo group mới, đồng thời thêm acc vào group đó
        // Request: {name: "tên group mới", accounts: []}
        $this->validate($request,[
            'name'=>'unique'
        ]);
        $new_group = new Groups();
        $new_group->name = $request->namespacee;
        $new_group->save();
        foreach ($request->accounts as $acc_id) {
            # code...
            $new_group->accounts()->attach($acc_id);
        }
        return 1;
    }
    function post_batch(Request $request){
        // Thêm acc vào group đã có
        // Request: {groupsToAdd: [], groupsToRemove: [], ids: []}
        foreach ($request->ids as $acc_id) {
            # code...
            $account = Accounts::Find($acc_id);
            $account->groups()->attach($request->groupsToAdd);
            $account->groups()->detach($request->groupsToRemove);

        }
        return 1;

    }
    function post_transaction(Request $request){
        //Thay đổi, chỉnh sửa transaction
        //Request: {id:'',from:'',to:'',description:'',date:'',status:'1'}
        $this->validate($request, [
            'id'=>'required',
            'from'=>'required','to'=>'required','date'=>'required','amount'=>'required'
        ]);
        $transaction = Transaction::find($id);
        $transaction->amount = $request->amount;
        $transaction->from = $request->from;
        $transaction->to = $request->to;
        $transaction->description = $request->description;
        $transaction->date = date('Y-m-d',strtotime($request->date));
        $transaction->status = $request->status;
        $transaction->user = Auth::user()->name;
        $transaction->save();


    }
    public function string_to_date($str){

    }
    function get_transaction($filter){
        //default filter
        $default_filter = ['from'=>['acc'=>[], 'group'=>[], 'tag'=>[]], 'to'=>['acc'=>[], 'group'=>[], 'tag'=>[]],'after'=>date('Y-m-d',strtotime(1/1/1997)), 'before'=>date('Y-m-d')];
        $result = [];
        //
        $filterToArray = explode("|", $filter);
        foreach ($filterToArray as $key => $value) {
            # code...
            $arr = explode(":", $value);
            if(in_array($arr[0], ['acc','group','tag'])){
                array_push($default_filter[$arr[0]], $arr[1]);
            }
            else{
                $default_filter[$arr[0]] = $arr[1];
            }
        }
        //All Accounts filtered
        $allAccount_id = [];
        //Accounts in Group
        $accountsInGroup_id = [];
        foreach ($default_filter['group'] as $value) {
            # code...
           

        }
        echo "<pre>";
        print_r($default_filter);

    }
    function list_group(){
        $data = [];
        $groups = Groups::select('id','name')->get();
        return json_encode($groups);
    }
    function edit_account($id, Request $request){
        $account = Accounts::find($id);
        $account->name = $request->name;
        $account->dob = isset($request->dob) ? $request->dob : NULL;
        $account->type = $request->type;
        $account->cat = $request->cat;
        $account->save();
        $account->groups()->detach();
        if(isset($request->groups)){            
            foreach ($request->groups as $key => $value) {
                # code...
                $check = $account->groups()->where('groups_id', $value['id'])->get();
                echo "<pre>";
                print_r($check->toArray());
                if(empty($check->toArray())){
                    $account->groups()->attach($value['id']);
                }
            }
        }

        $account->groups = $account->groups()->select('groups.id','groups.name')->get();
        return 1;
    }
}
