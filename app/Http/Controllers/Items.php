<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Vault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Http\Features\SM4;
class Items extends Controller
{
    public function show($id,$item){
        $item_id = $item;
        $sm4 = new SM4();
        $user = auth()->user();
        $vault = Vault::find($id);
        $key = bin2hex(Str::limit(sm3($user->master_key),16));

        Log::alert("User {$user->id} access password [{$item}]");

        if (Gate::forUser($user)->allows('show-vault', $vault)) {
            echo "OK";
        }
        $item = Item::find($item);

        //把金鑰內容解密
        $payload = $item->payload;
        $payload['secret'] = json_decode(
            $sm4->setKey($key)->decryptData($item->payload['secret'])
        );
        $item->payload = $payload;
        //dd($item->payload['secret']);

        if(is_null($item->payload['secret'])){
            return view('App.Vaults.Items.show',[
                'item' => $item->payload,
                'message' => [
                    'type' => 'error',
                    'msg'  => 'master key error'
                ],
                'route' => [
                    'id' => $id,
                    'item' => $item_id
                ],
                'type' => 'old'
            ]);
        }

        return view('App.Vaults.Items.show',[
            'item' => $item->payload,
            'message' => [
                'type' => 'success',
                'msg'  => 'ok'
            ],
            'route' => [
                'id' => $id,
                'item' => $item_id
            ],
            'type' => 'old'
        ]);
    }

    public function add($id){
        return view('App.Vaults.Items.show',[
            'item' => [],
            'message' => [
                'type' => 'success',
                'msg'  => 'ok'
            ],
            'route' => [
                'id' => $id
            ],
            'type' => 'add'
        ]);

    }

    public function action_add(Request $request){
        $sm4 = new SM4();
        $user = auth()->user();
        $vault = Vault::find($request->id);
        $key = bin2hex(Str::limit(sm3($user->master_key),16));

        $encrypted = $sm4->setKey($key)->encryptData($request['item_payload']);

        $vault->items()->create([
            'payload'=>[
                'type' => $request['item_type'],
                'name' => $request['item_name'],
                'secret' => $encrypted
            ]
        ]);

        return redirect(route('vaults.list',[
            'id'=>$vault->id
        ]));
    }

    public function __construct() {
        $this->middleware('auth');
    }
}
