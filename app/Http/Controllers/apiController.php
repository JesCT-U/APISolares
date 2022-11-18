<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Orden;
use App\Models\OrdenDetalle;
use App\Models\Pedido;
use App\Models\productos;
use App\Models\Proveedor;
use App\Models\Reabastecimiento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class apiController extends Controller
{
    public function users(Request $request){

        $users = User::all();
        return response()->json($users);
    }

    public function login(Request $reques){
        $respuesta = ["estado" => 0, "msg" => "", "name" => "", "email" => ""];
        $data = json_decode($reques->getContent());
        $user = User::where('email',$data->email)->first();
        if($user){
            if(Hash::check($data->password,$user->password)){
                $token = $user->createToken('app');
                $respuesta["estado"] = 1;
                $respuesta["name"] = $user->name;
                $respuesta["email"] = $user->email;
                $respuesta["msg"] = $token->plainTextToken;
            }else{
                $respuesta['msg'] = "credenciales no encontradas";
            }
        }else{
            $respuesta['msg'] = "usuario no encontrado";
        }
        return response()->json($respuesta);
    }

    public function productos(Request $request){
        $productos = productos::where('estado','1')->get();
        return response()->json($productos);
    }
    public function productos_id($id){
        $reabastecimiento = Reabastecimiento::select('reabastecimiento.reabastecimiento_id','reabastecimiento.unidades','reabastecimiento.fecha','reabastecimiento.Total','proveedor.proveedor','productos.producto')
        ->where('reabastecimiento.estado','1')
        ->where('reabastecimiento_id',$id)
        ->join('productos','productos.productos_id','reabastecimiento.productos_id')
        ->join('proveedor','proveedor.proveedor_id','reabastecimiento.proveedor_id')
        ->get();
        return response()->json($reabastecimiento);
    }

    public function productos_crear(Request $request){
        productos::create([
            'codigo' => $request->codigo,
            'producto' => $request->producto,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'precio_compra' => $request->precio_compra,
            'stock' => $request->stock,
            'stock_min' => $request->stock_min,
            'categorias_id' => $request->categorias_id,
        ]);
    }

    public function abastecimiento(){
        $reabastecimiento = Reabastecimiento::select('reabastecimiento.reabastecimiento_id','reabastecimiento.unidades','reabastecimiento.fecha','reabastecimiento.Total','proveedor.proveedor','productos.producto')
        ->where('reabastecimiento.estado','1')
        ->join('productos','productos.productos_id','reabastecimiento.productos_id')
        ->join('proveedor','proveedor.proveedor_id','reabastecimiento.proveedor_id')
        ->get();
        return response()->json($reabastecimiento);
    }
    public function abastecimiento_id($id){
        $reabastecimiento = Reabastecimiento::select('reabastecimiento.reabastecimiento_id','reabastecimiento.unidades','reabastecimiento.fecha','reabastecimiento.Total','proveedor.proveedor','productos.producto')
        ->where('reabastecimiento.estado','1')
        ->where('reabastecimiento.estado','1')
        ->where('reabastecimiento.reabastecimiento_id',$id)
        ->join('productos','productos.productos_id','reabastecimiento.productos_id')
        ->join('proveedor','proveedor.proveedor_id','reabastecimiento.proveedor_id')
        ->get();
        return response()->json($reabastecimiento);
    }

    public function abastecimiento_crear(Request $request){
        if($request){
            if($request->unidades && $request->total && $request->productos_id && $request->proveedor_id){
                Reabastecimiento::create([
                    'unidades' => $request->unidades,
                    'Total' => $request->total,
                    'fecha' => Carbon::now(),
                    'productos_id' => $request->productos_id,
                    'proveedor_id' => $request->proveedor_id,
                ]);
                $msg = ['msg' => 'Registro Creado'];
                return response()->json($msg);
            }else{
                $msg = ['msg' => 'datos incorrectos'];
                return response()->json($msg);
            }

        }else{
            $msg = ['msg' => 'no hay datos'];
            return response()->json($msg);
        }
    }
    public function proveedores(){
        $proveedores = Proveedor::where('estado',1)->get();
        return response()->json($proveedores);
    }
    public function proveedores_id($id){
        $proveedores = Proveedor::where('proveedor_id',$id)->where('estado',1)->get();
        return response()->json($proveedores);
    }

    public function categorias(){
        $categorias = Categorias::where('estado','1')->get();
        return response()->json($categorias);
    }
    public function ordenes_detalle(){
        $detalles_ordenes = OrdenDetalle::where('estado','1')->get();
        return response()->json($detalles_ordenes);
    }

    //Mis metodos estrellas
    public function dayReport(Request $request)
    {
        $hoy = Carbon::today();
        $ordenes = Orden::whereDate('fecha','=', $hoy)->count(); //ok
        $pedidos = Pedido::where('estado','=','1')->get()->count(); //ok
        $total = Orden::where('fecha','=', $hoy)->get()->sum('total'); //ok
        $stock = productos::where('estado',1,'and')->where('stock','>','stock_min')->get()->count(); //ok

        $array = [
            ["title" => "Ordenes del dia", "value" => $ordenes." ordenes", "route" => "/fist"],
            ["title" => "Pendientes entrega", "value" => $pedidos." pedidos", "route" => "/second"],
            ["title" => "Total ventas dia", "value" => "Q.".$total, "route" => "/third"],
            ["title" => "Stock minimo", "value" => $stock." productos", "route" => "/fouth"],
        ];

        return response()->json($array);
    }

    public function monthReport(Request $request)
    {
        $en = date("Y-m-t");
        $st = date("Y-m-01");
        $ordenes = Orden::where([['fecha','>=',$st],['fecha','<=',$en]])->get()->count(); //ok
        $ventas = Orden::where([['fecha','>=',$st],['fecha','<=',$en]])->get()->sum('total'); //ok
        $clientes = productos::where('estado','=','1')->get()->count(); //cambiar clientes
        $productos = productos::where('estado','=','1',)->get()->count(); //ok
        $vendidos = OrdenDetalle::where([['created_at','>=',$st],['created_at','<=',$en]])->get()->sum('unidades'); //ok

        $array = [
            ["title" => "Ordenes del mes","value" => $ordenes. " ordenes"],
            ["title" => "Total ventas del mes","value" => "Q.".$ventas],
            ["title" => "Total de clientes","value" => $clientes." clientes"],
            ["title" => "Total de productos","value" => $productos." productos"],
            ["title" => "Productos vendidos","value" => $vendidos." unidades"]
        ];

        return response()->json($array);
    }

    public function stockMin(Request $request){
        $stock = productos::where('estado',1,'and')->where('stock','>','stock_min')->get(); //nofunciona el where 2

        return response()->json($stock);
    }

    public function OrdenDay(Request $request){
        $hoy = Carbon::today();
        $ordenes = Orden::whereDate('fecha','=', $hoy)->get(); //ok

        return response()->json($ordenes);
    }

    public function PedidoDay(Request $request){
        $ordenes = Pedido::where('estado','=','1')->get(); //ok

        return response()->json($ordenes);
    }

    public function TotalDay(Request $request){
        $hoy = Carbon::today();
        $total = Orden::where('fecha','=', $hoy)->get(); //ok

        return response()->json($total);
    }
}
