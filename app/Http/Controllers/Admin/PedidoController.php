<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pedido;
use App\Models\Negocio;
use App\Models\DetallePedido;
use App\Notifications\OrderNotification;

class PedidoController extends Controller
{
    public function list(){

        //Llama a todos los registros que hay en la tabla PEDIDO
        $pedidos= Pedido::all();

        //Retorna la consulta de la variable a la vista pedidos list
        return view('admin.pedidos.list', compact('pedidos'));
    }

    public function viewDetail($id){

        //Hace una consulta a la BD mediante el modelo PEDIDO enviando como parámetro un ID de PEDIDO
        $pedido = Pedido::FindOrFail($id);
        $detalle_pedido = DetallePedido::where('idPedido',$id)->get();

        //Retorna la consulta de la variable a la vista pedidos detail
        return view('admin.pedidos.detail', compact('pedido','detalle_pedido'));
    }


    public function notification($id){

        //Cambia el estado sobre notificación del pedido de 0(Pendiente) a 1(Enviado)
        $consultaPedido = Pedido::FindOrFail($id);
        $consultaPedido->estado = 1;
        $consultaPedido->save();

        //Instancia el modelo Pedido para agregar atributos y pasar al array de la notificación
        $pedido = new Pedido;
        $pedido->fecha = $consultaPedido->fecha;
        $pedido->nombreCliente = $consultaPedido->client->name;
        $pedido->id = $id;

        //Obtiene el modelo Negocio para enviar Notificación
        $notification = Negocio::first();
        $notification->notify(new OrderNotification($pedido));

        //Muestra la vista anterior
        return redirect()->back();

    }


    public function mark_all_notifications(){

        //Marca que toda las notificaciones ya fueron leídas
        auth()->user()->unreadNotifications->markAsRead();
        //Redirecciona a la vista Pedidos
        return redirect()->route('admin.pedido.index');

    }

    public function mark_a_notifications($notification_id, $order_id){

        //Consulta para marcar sólo la notificación como leída mediante el ID del pedido
        auth()->user()->unreadNotifications->when($notification_id, function($query) use($notification_id){
            return $query->where('id', $notification_id);
        })->markAsRead();

        //Obtiene el pedido
        $order = Pedido::find($order_id);
        //Redirecciona a la vista del pedido mediante el ID
        return redirect()->route('admin.pedido.detail', $order);
    }
}

