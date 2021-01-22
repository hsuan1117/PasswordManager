<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Item;
use App\Http\Features\SM4;

class ItemWebsite extends Component
{
    public $data;
    public $route;
    public $type;
    public function render()
    {
        //dd($this->data);
        return view('livewire.item-website');
    }
}
