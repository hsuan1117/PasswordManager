<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Vault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Features\SM4;
use ZxcvbnPhp\Zxcvbn;


class Items extends Controller
{
    public function show($id,$item){
        $item_id = $item;
        $sm4 = new SM4();
        $user = auth()->user();
        $vault = Vault::find($id);
        $key = bin2hex(Str::limit(sm3($user->master_key),16));

        Log::alert("User {$user->id} access password {$item}");

        if (!Gate::forUser($user)->allows('show-vault', $vault)) {
            Session::flash('message.type','error');
            Session::flash('message.msg' ,'YOU Don\'t Have Permission!');
            return view('App.Common.error');
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
            Session::flash('message.type','error');
            Session::flash('message.msg' ,'There is a problem while decrypting the item.');
            return view('App.Vaults.Items.show',[
                'item' => $item->payload,
                'route' => [
                    'id' => $id,
                    'item' => $item_id
                ],
                'vault' => $vault,
                'type' => 'old'
            ]);
        }

        Session::flash('message.type','success');
        Session::flash('message.msg' ,'Okay!');
        return view('App.Vaults.Items.show',[
            'item' => $item->payload,
            'route' => [
                'id' => $id,
                'item' => $item_id
            ],
            'vault' => $vault,
            'type' => 'old'
        ]);
    }

    public function add($id){
        /*Session::flash('message.type','success');
        Session::flash('message.msg' ,'Okay !');*/
        return view('App.Vaults.Items.show',[
            'item' => [],
            'route' => [
                'id' => $id
            ],
            'type' => 'add'
        ]);
    }


    public function get_strength(Request $request){
        $zxcvbn = new Zxcvbn();
        $result = $zxcvbn->passwordStrength(
            $request->password,
            $request->info
        );
        return $result;
    }

    public function __construct() {
        //$this->middleware('auth');
    }
}
