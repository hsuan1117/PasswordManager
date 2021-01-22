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
        if (Gate::forUser(Auth::user())->allows('show-vault', $vault)) {
            echo "hi";
        }
        return view('App.Vaults.show', [
            'vault' => $vault
        ]);
    }

    public function __construct() {
        $this->middleware('auth');
    }

}
