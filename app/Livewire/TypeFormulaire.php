<?php

namespace App\Livewire;

use Livewire\Component;

class TypeFormulaire extends Component
{
    public string $type = '';

    public array $form = [
        'name' => '',
        'phoneNumber' => '',
        'deliveryTime' => '',
        'personNumber' => '',
        'tableNumber' => '',
    ];

    public function typeFormulaireSurPlace()
    {
        $this->type = 'surPlace';

    }

    public function typeFormulaireEmporter()
    {
        $this->type = 'emporter';
    }

    public function render()
    {
        return view('livewire.type-formulaire');
    }
}
