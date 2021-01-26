<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Features\SM4;

class Settings extends Controller
{
    private $key;
    public function setMasterKey(Request $request){
        $user = auth()->user();
        $origin = bin2hex(Str::limit(sm3($user->master_key),16));;
        $sm4 = new SM4();
        //dd($user);
        if($user->master_key == "DEFAULT"){
            $user->master_key = $request->key;
            $user->save();
            $this->key = bin2hex(Str::limit(sm3($request->key),16));

            $user->vaults()->each(function($vault) use ($origin,$sm4){
                $vault->items()->each(function($item) use ($origin,$sm4){
                    //把金鑰內容解密
                    $payload = $item->payload;

                    $payload['secret'] = $sm4->setKey($this->key)->encryptData(
                        $sm4->setKey($origin)->decryptData($payload['secret'])
                    );

                    $item->payload = $payload;
                    $item->save();
                });
            });

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
