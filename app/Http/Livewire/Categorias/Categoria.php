<?php

namespace App\Http\Livewire\Categorias;

use App\Models\Categorias;
use Livewire\Component;

class Categoria extends Component
{
    public $open = false;
    public $categorias_id,$categoria,$prefijo;
    public function render()
    {
        $datos = Categorias::all();
        return view('livewire.categorias.categoria',['datos' => $datos]);
    }
    public function openModal(){
        $this->open = true;
    }
    public function closeModal(){
        $this->open = false;
        $this->limpiar();
        
    }
    public function guardar(){
        Categorias::updateOrCreate(['categorias_id' => $this->categorias_id],[
            'categoria' => $this->categoria,
            'prefijo' => $this->prefijo,
        ]);
        $this->closeModal();
    }
    public function limpiar(){
        $this->categorias_id = '';
        $this->categoria = '';
        $this->prefijo = '';
    }
    public function editar($id){
        $datos = Categorias::find($id);
        $this->categorias_id = $datos->categorias_id;
        $this->categoria = $datos->categoria;
        $this->prefijo = $datos->prefijo;
        $this->openModal();
    }
    public function eliminar($id){
        Categorias::updateOrCreate(['categorias_id' => $id],[
            'estado' => 0,
        ]);
    }
}
