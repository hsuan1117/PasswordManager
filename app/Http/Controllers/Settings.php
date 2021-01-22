<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Settings extends Controller
{

    public function setMasterKey(Request $request){
        $user = auth()->user();
        //dd($user);
        if($user->master_key == "DEFAULT"){
            $user->master_key = $request->key;
            $user->save();
            return redirect(route('dashboard'))
                ->with('message.msg','OK')
                ->with('message.type','success');
        }
        return redirect(route('dashboard'))
            ->with('message.msg','Fail, you cannot modify master key.')
            ->with('message.type','error');
    }

    public function middleware($middleware, array $options = []) {
        return $this->middleware('auth');
    }
}
