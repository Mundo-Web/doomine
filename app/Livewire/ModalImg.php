<?php

namespace App\Livewire;

use Livewire\Component;

class ModalImg extends Component
{
    /* public $open = false;
    public $imagenes = [];

    protected $listeners = ['openModal' => 'open'];

    public function open($imagenes)
    {
        $this->imagenes = $imagenes;
        $this->open = true;
    }

    public function close()
    {
        // $this->open = false;
    } */

    public function render()
    {
        return view('livewire.modal-img');
    }
}
