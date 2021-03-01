<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Collection;
use App\Http\Features\SM4;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Vaults extends Controller {

    public function list() {
        Log::alert('Access Vault List: ' . auth()->user()->id);
        $user = auth()->user();
        $vaults = $user->vaults()->get();
        //dd($vaults);
        return view('App.Vaults.list', [
            'vaults' => $vaults
        ]);
    }

    public function show($id) {
        $vault = Vault::where('id', $id)->first();

        if (!Gate::forUser(Auth::user())->allows('show-vault', $vault)) {
            Session::flash('message.type','error');
            Session::flash('message.msg' ,'YOU Don\'t Have Permission!');
            return view('App.Common.error');
        }
        return view('App.Vaults.show', [
            'vault' => $vault
        ]);
    }

    public function delete($id){
        $vault = Vault::where('id',$id)->first();

        $vault->items();

        return redirect(route('vaults.list'));
    }
    public function add(){
        return view('App.Vaults.add');
    }

    public function action_add(Request $request){
        $user  = auth()->user();

        $vault = $user->vaults()->create([
            'name' => $request->vault_name,
            'description' => $request->vault_desc
        ]);

        return redirect(route('vaults.show',[
            'id' =>$vault->id
        ]));

    }

    public function __construct() {
        $this->middleware('auth');
    }

}
