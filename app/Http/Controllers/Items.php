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

        $key = $sm4->genKeyFromString($user->master_key);
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
        //dd($item->payload);

        if(is_null($item->payload['secret'])){
            Session::flash('message.type','error');
            Session::flash('message.msg' ,'There is a problem while decrypting the item.');
            return view('App.Vaults.Items.show',[
                'item' => $item->payload,
                'route' => [
                    'vault_id' => $id,
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
                'vault_id' => $id,
                'item' => $item_id
            ],
            'vault' => $vault,
            'type' => 'old'
        ]);
    }

    public function add($id){
        /*Session::flash('message.type','success');
        Session::flash('message.msg' ,'Okay !');*/
        return view('App.Vaults.Items.add',[
            'route' => [
                'vault_id' => $id
            ]
        ]);


        /**/
    }


    public function action_add(Request $request){
        switch ($request->item_type){
            case 'website':
                return view('App.Vaults.Items.show',[
                    'item' => [
                        'type' => 'website'
                    ],
                    'route' => [
                        'vault_id' => $request->vault_id
                    ],
                    'type' => 'add'
                ]);
                break;

        }
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
