<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Items;
use App\Http\Features\SM4;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Vault;
use App\Models\Item;

class WebsiteController extends Controller
{
    //
    public function modify(Request $request){
        $sm4 = new SM4();
        $user  = auth()->user();
        $vault = Vault::find($request->vault_id);
        $item  = $vault->items()->find($request->item_id);
        $key = bin2hex(Str::limit(sm3($user->master_key),16));


        $payload = $item->payload;
        $payload['name'] = $request->item_name;

        $payload['secret'] = $sm4->setKey($key)->encryptData(json_encode([
            'domain' => $request->domain,
            'account' => $request->account,
            'password' => $request->password
        ]));
        $item->payload = $payload;

        $item->save();

        return redirect(route('items.show',[
            'id' => $request->vault_id,
            'item' => $request->item_id
        ]));
    }

    public function add(Request $request){
        $sm4 = new SM4();
        $user  = auth()->user();
        $vault = Vault::find($request->vault_id);
        $key = bin2hex(Str::limit(sm3($user->master_key),16));

        $secret = [
            'domain' => $request->domain,
            'account' => $request->account,
            'password' => $request->password
        ];
        $encrypted = $sm4->setKey($key)->encryptData(json_encode($secret));

        $item = $vault->items()->create([
            'payload'=>[
                'type' => $request['item_type'] ?? 'Default',
                'name' => $request['item_name'] ?? 'Default',
                'secret' => $encrypted
            ]
        ]);

        return redirect(route('items.show',[
            'id' => $request->vault_id,
            'item' => $item->id
        ]));
    }





}
