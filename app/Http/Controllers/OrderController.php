<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\order;
use Illuminate\Support\Str;
use File;

class OrderController extends Controller
{
    public function addOrder(Request $req){
        $req->validate([
            'image' => 'required|mimes:jpg,png',
            'invoice' => 'required|mimes:pdf',
        ]);
        
        $data = new order;
        if($req->image){
            $image = $req->image;

            $imageName = Str::random(7).'.'.$image->getClientOriginalExtension();
            
            $req->image->move('orderImage',$imageName);
            
            $data->image = $imageName;
        }else{
            $data->image = $req->image;
        }
        
        if($req->invoice){
            $file = $req->invoice;
        
            $invoice = Str::random(7).'.'.$file->getClientOriginalExtension();
    
            $req->invoice->move('orderInvoice',$invoice);

            $data->invoice = $invoice;
        }else{
            $data->invoice = $req->invoice;
        }
        

        $data->checked = 0;
        $data->status = 0;
        $data->note = $req->note;
        $save = $data->save();

        if($save == 1){
            return redirect('/orderList')->with('success','New Order has been successfully added. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }
    }

    public function orders(){
        $orders = order::orderBy('created_at', 'DESC')->get();
        return view('order.orderList',compact('orders'))->with('i');
    }

    public function deleteOrder($id){
        $data = order::find($id);
        
        if(File::exists(public_path('orderImage/'.$data->image))){
            File::delete(public_path('orderImage/'.$data->image));
        }

        if(File::exists(public_path('orderInvoice/'.$data->invoice))){
            File::delete(public_path('orderInvoice/'.$data->invoice));
        }

        $delete = $data->delete();

        if($delete == 1){
            return redirect('/orderList')->with('success','Order has been successfully Remove. ');
        }else{
            return redirect('/orderList')->with('fail','Something went wrong.');
        }
    }

    public function viewOrder($id){
        $order = order::find($id);
        $order->checked = 1;
        $order->save();

        return view('order.orderView',compact('order'));
    }

    public function updateOrder($id , $status){
        $order = order::find($id);
        $order->status = $status;
        $order = $order->save();

        if($order == 1){
            return redirect('/orderList')->with('success','Order has been successfully updated. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }
    }

    public function downloadInvoice($file){
        return response()->download(public_path('orderInvoice/'.$file));
    }

    public function todayOrders(){
        $orders = order::orderBy('created_at', 'DESC')->where('status','0')->get();
        return view('order.todayOrders',compact('orders'))->with('i');
    }
}
