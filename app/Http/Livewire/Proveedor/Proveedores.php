<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Proveedor;
use Livewire\Component;

class Proveedores extends Component
{
    public $open = false;
    public $proveedor_id,$codigo,$proveedor,$nit,$estado;
    public function render()
    {
        $datos = Proveedor::where('estado','1')->get();
        return view('livewire.proveedor.proveedores',['datos' => $datos]);
    }
    public function openModal(){
        $this->open = true;
    }
    public function closeModal(){
        $this->open = false;
        $this->limpiar();
    }
    public function guardar(){
        Proveedor::updateOrCreate(['proveedor_id' => $this->proveedor_id],
        [
            'codigo' => $this->codigo,
            'proveedor' => $this->proveedor,
            'nit' => $this->nit,
        ]);
        $this->closeModal();
    }
    public function limpiar(){
        $this->proveedor_id = '';
        $this->codigo = '';
        $this->proveedor = '';
        $this->nit = '';
    }
    public function editar($id){
        $provedores = Proveedor::find($id);
        $this->proveedor_id = $provedores->proveedor_id;
        $this->codigo = $provedores->codigo;
        $this->proveedor = $provedores->proveedor;
        $this->nit = $provedores->nit;
        $this->openModal();
    }
    public function eliminar($id){
        Proveedor::updateOrCreate(['proveedor_id' => $id],
        [
            'estado' => 0,
        ]);
    }
}
