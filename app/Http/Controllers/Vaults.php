<?php

namespace App\Http\Controllers;

use App\Models\Vault;
use App\Models\VaultUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;

class Vaults extends Controller {

    public function list() {
        Log::alert('Access Vault List: '.Auth::user()->id);
        $vaults = VaultUser::where('user', Auth::user()->id)->get();
        $vault_list = [];

        //dd($vaults);
        foreach ($vaults as $v) {
            $vault = $v->vault;

            array_push($vault_list, Vault::where('id', $vault)->get()[0]);
        }
        //dd($vault_list);
        return view('App.Vaults.list', [
            'vaults' => $vault_list
        ]);
    }

    public function show($id) {
        $vault = Vault::where('id',$id)->get()[0];
        if (Gate::forUser(Auth::user())->allows('show-vault', $vault)) {
            echo "hi";
        }
        return view('App.Vaults.show', [
            'vaults' => []
        ]);
    }

    public function __construct() {
        $this->middleware('auth');
    }

}
