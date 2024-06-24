<?php

namespace App\Livewire;

use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class EditUser extends ModalComponent
{
    public $imagenes;

    public function mount($imagenes)
    {
        $this->imagenes = $imagenes;
    }

    public function render()
    {
        return view('livewire.edit-user', [
            'imagenes' => $this->imagenes,
        ]);
    }
}
