<?php

namespace App\Livewire;

use Livewire\Component;

class TypeFormulaire extends Component
{
    public string $type = 'surPlace';

    public array $form = [
        'table' => '',
        'address' => '',
    ];

    public function typeFormulaire()
    {
        if($this->type == 'surPlace'){
            $this->type = 'emporter';
        }elseif($this->type == 'emporter'){
            $this->type = 'surPlace';
        }
    }

    public function render()
    {
        return view('livewire.type-formulaire');
    }
}
