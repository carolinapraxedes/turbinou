<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PasseioForm extends Component
{
    public $passeio;
    public $passeios;
    public $destinos;

    public function __construct($passeio = null, $passeios = null, $destinos = [])
    {
        $this->passeio = $passeio; // Recebe o passeio para edição, se houver
        $this->passeios = $passeios ?? []; // Recebe todos os passeios
        $this->destinos = $destinos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.passeio-form');
    }
}
