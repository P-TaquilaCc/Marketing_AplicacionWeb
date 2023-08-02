<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\DetallePedido;

class PedidoNegocioController extends Controller
{
    public function list(){
        //Obtiene los registros de la tabla PEDIDO
        $pedidos= Pedido::where('estado','1')->where('idNegocio', session('idNegocio'))->get();
        //Lleva los registros a la vista
        return view('negocio.pedidos.list', compact('pedidos'));
    }

    public function viewdetail($id){

        //Obtiene el registro del pedido mediante el ID
        $pedido = Pedido::FindOrFail($id);
        //Obtiene el detalle del pedido mediante el ID de la tabla PEDIDO
        $detalle_pedido = DetallePedido::where('idPedido',$id)->get();

        //Lleva los registros de las consultas pedido y detalle pedido
        return view('negocio.pedidos.detail', compact('pedido','detalle_pedido'));
    }


    public function mark_all_notifications(){

        //Marca que toda las notificaciones ya fueron leídas
        auth()->user()->unreadNotifications->markAsRead();
        //Redirecciona a la vista Pedidos
        return redirect()->route('negocio.pedido.index');

    }

    public function mark_a_notifications($notification_id, $order_id){

        //Consulta para marcar sólo la notificación como leída mediante el ID del pedido
        auth()->user()->unreadNotifications->when($notification_id, function($query) use($notification_id){
            return $query->where('id', $notification_id);
        })->markAsRead();

        //Obtiene el pedido
        $order = Pedido::find($order_id);
        //Redirecciona a la vista del pedido mediante el ID
        return redirect()->route('negocio.pedido.detail', $order);
    }
}
