<?php

namespace App\Livewire;

use App\Models\Zoo;
use Livewire\Component;

class ZooSetter extends Component
{
    public $zoos, $zoo, $shMessage = true;

    public function render()
    {
        return view('livewire.zoo-setter');
    }

    function mount() : void {
        $this->zoos = Zoo::all();

        $this->setZoo();
        $this->setZooInSession();

        $this->shMessage = false;
    }

    function setZoo() {
        $this->zoo = !session('zooArr') ? Zoo::where('code', config('app.zoo'))->first()->id : session('zooArr')['id'];
    }

    function setZooInSession() {
        session([
            'zooArr' => Zoo::find($this->zoo)->toArray()
        ]);

        session()->flash('message', 'Se cambio el Zoo seleccionado.');
        $this->shMessage = true;
    }


}
