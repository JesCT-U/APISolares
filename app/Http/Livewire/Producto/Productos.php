<?php

namespace App\Http\Livewire\Producto;

use App\Models\Categorias;
use App\Models\productos as ModelsProductos;
use Livewire\Component;

class Productos extends Component
{
    public $open = false;
    public $productos_id,$codigo,$producto,$descripcion,$precio,$precio_compra,$stock,$stock_min,$categorias_id;
    public $datos_categorias;
    public function render()
    {
        $datos = ModelsProductos::where('productos.estado',1)
        ->join('categorias','categorias.categorias_id','productos.categorias_id')
        ->get();
        $this->datos_categorias = Categorias::where('estado',1)->get();
        return view('livewire.producto.productos',['datos' => $datos]);
    }
    public function openModal(){
        $this->open = true;
    }
    public function closeModal(){
        $this->open = false;
        $this->limpiar();
    }
    public function guardar(){
        ModelsProductos::updateOrCreate(['productos_id' => $this->productos_id],
        [
            'codigo' => $this->codigo,
            'producto' => $this->producto,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'precio_compra' => $this->precio_compra,
            'stock' => $this->stock,
            'stock_min' => $this->stock_min,
            'categorias_id' => $this->categorias_id,
        ]);
        $this->closeModal();
        $this->limpiar();
    }
    public function limpiar(){
        $this->productos_id = '';
        $this->codigo = '';
        $this->producto ='';
        $this->descripcion = '';
        $this->precio = '';
        $this->precio_compra = '';
        $this->stock = '';
        $this->stock_min = '';
        $this->categorias_id = '';
    }
    public function editar($id){
        $this->limpiar();
        $datos = ModelsProductos::find($id);
        $this->productos_id = $datos->productos_id;
        $this->codigo = $datos->codigo;
        $this->producto = $datos->producto;
        $this->descripcion = $datos->descripcion;
        $this->precio = $datos->precio;
        $this->precio_compra = $datos->precio_compra;
        $this->stock = $datos->stock;
        $this->stock_min = $datos->stock_min;
        $this->categorias_id = $datos->categorias_id;
        $this->openModal();
    }
    public function eliminar($id){
        ModelsProductos::updateOrCreate(['productos_id' => $id],[
            'estado' => 0,
        ]);
    }
}
