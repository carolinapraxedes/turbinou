<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DestinoForm extends Component
{
    public $destino;
    public $destinos;

    public function __construct($destino = null, $destinos = null)
    {
        $this->destino = $destino; // Recebe o destino para edição, se houver
        $this->destinos = $destinos ?? []; // Recebe todos os destinos
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.destino-form');
    }
}
