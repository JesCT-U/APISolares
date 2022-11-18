<?php

namespace App\Http\Livewire\Reabastecimientos;

use App\Models\productos;
use App\Models\Proveedor;
use App\Models\Reabastecimiento as ModelsReabastecimiento;
use Livewire\Component;
use Carbon\Carbon;

class Reabastecimiento extends Component
{
    public $open = false;
    public $datos_productos,$datos_proveedores;
    public $reabastecimiento_id,$productos,$provedores,$unidades,$total;
    public $productos_select;
    public function render()
    {
        $datos = ModelsReabastecimiento::select('reabastecimiento.reabastecimiento_id','reabastecimiento.unidades','reabastecimiento.fecha','reabastecimiento.Total','proveedor.proveedor','productos.producto')
        ->where('reabastecimiento.estado','1')
        ->join('productos','productos.productos_id','reabastecimiento.productos_id')
        ->join('proveedor','proveedor.proveedor_id','reabastecimiento.proveedor_id')
        ->get();
        $this->datos_productos = productos::where('estado','1')->get();
        $this->datos_proveedores = Proveedor::where('estado','1')->get();
        if($this->productos && $this->unidades){
            $this->productos_select = productos::find($this->productos);
            $this->total = $this->productos_select->precio_compra * $this->unidades;
        }
        return view('livewire.reabastecimientos.reabastecimiento',['datos' => $datos]);
    }
    public function openModal(){
        $this->open = true;
    }
    public function closeModal(){
        $this->open = false;
    }
    public function guardar(){
        ModelsReabastecimiento::updateOrCreate(['reabastecimiento_id' => $this->reabastecimiento_id],
        [
            'unidades' => $this->unidades,
            'Total' => $this->total,
            'fecha' => Carbon::now(),
            'productos_id' => $this->productos,
            'proveedor_id' => $this->provedores,
        ]);
    }
}
