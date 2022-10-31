<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use File;

class ProductController extends Controller
{
    public function addProduct(Request $req){
        $req->validate([
            'name'=>'required|max:255',
            'drive_link'=>'nullable',
            'sku'=>'required',
            'image' => 'required|mimes:jpg,png',
            'artcut_file' => 'required',
            'other_artcut_file' => 'nullable',
        ]);
        
        $data = new product;
        if($req->image){
            $image = $req->image;

            $imageName = Str::random(7).'.'.$image->getClientOriginalExtension();
            
            $req->image->move('productimage',$imageName);
            
            $data->image = $imageName;
        }else{
            $data->image = $req->image;
        }
        
        if($req->artcut_file){
            $file = $req->artcut_file;
        
            $artcut_file = Str::random(7).'.'.$file->getClientOriginalExtension();
    
            $req->artcut_file->move('productfile',$artcut_file);

            $data->artcut_file = $artcut_file;
        }else{
            $data->artcut_file = $req->artcut_file;
        }
        
        if($req->other_artcut_file){
            $other_file = $req->other_artcut_file;

            $other_artcut_file = Str::random(7).'.'.$other_file->getClientOriginalExtension();
    
            $req->other_artcut_file->move('productfile',$other_artcut_file);
            
            $data->other_artcut_file = $other_artcut_file;
        }else{
            $data->other_artcut_file = $req->other_artcut_file;
        }

        $data->name = $req->name;
        $data->drive_link = $req->drive_link;
        $data->daraz = $req->daraz;
        $data->decorguys = $req->decorguys;
        $data->carstickers = $req->carstickers;
        $data->sku = $req->sku;

        $save = $data->save();

        if($save == 1){
            return redirect('/')->with('success','New Product has been successfully added. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }
    }

    public function products(){
        $products = product::all();
        return view('productList',compact('products'));
    }

    public function searchProduct(Request $req){
        $products = DB::table('products')
        ->where('name','like', $req->search.'%' )->get();
        if(count($products) != 0 ){
            return view('productList',compact('products'));
        }else{
            $products = DB::table('products')
            ->where('sku','like', $req->search.'%' )->get();
            return view('productList',compact('products'));
        }
    }

    public function deleteProduct($id){
        $data = product::find($id);
        
        if(File::exists(public_path('productimage/'.$data->image))){
            File::delete(public_path('productimage/'.$data->image));
        }

        if(File::exists(public_path('productfile/'.$data->artcut_file))){
            File::delete(public_path('productfile/'.$data->artcut_file));
        }

        if(File::exists(public_path('productfile/'.$data->other_artcut_file))){
            File::delete(public_path('productfile/'.$data->other_artcut_file));
        }
        $delete = $data->delete();
        if($delete == 1){
            return redirect('/')->with('success','Product has been successfully Remove. ');
        }else{
            return redirect('/')->with('fail','Something went wrong.');
        }
    }

    public function getProduct($id){
        $product = product::find($id);

        return view('productEdit',compact('product'));
    }

    public function updateProduct(Request $req){

        $req->validate([
            'name'=>'required|max:255',
            'drive_link'=>'nullable',
            'sku'=>'required',
            'image' => 'nullable|mimes:jpg,png',
            'artcut_file' => 'nullable',
            'other_artcut_file' => 'nullable',
        ]);

        $data = product::find($req->id);
        
            if(!empty($req->image)){
                if(File::exists(public_path('productimage/'.$data->image))){
                    File::delete(public_path('productimage/'.$data->image));
                }
                $image = $req->image;

                $imagename = Str::random(7).'.'.$image->getClientOriginalExtension();

                $req->image->move('productimage',$imagename);

                $data->image = $imagename;
            }
            else{
                $data->image = $data->image;
            }

            if(!empty($req->artcut_file)){
                if(File::exists(public_path('productfile/'.$data->artcut_file))){
                    File::delete(public_path('productfile/'.$data->artcut_file));
                }
                $file = $req->artcut_file;

                $artcut_file = Str::random(7).'.'.$file->getClientOriginalExtension();

                $req->artcut_file->move('productfile',$artcut_file);

                $data->artcut_file = $artcut_file;
            }
            else{
                $data->artcut_file = $data->artcut_file;
            }

            if(!empty($req->other_artcut_file)){
                if(File::exists(public_path('productfile/'.$data->other_artcut_file))){
                    File::delete(public_path('productfile/'.$data->other_artcut_file));
                }
                $other_file = $req->other_artcut_file;

                $other_artcut_file = Str::random(7).'.'.$other_file->getClientOriginalExtension();

                $req->other_artcut_file->move('productfile',$other_artcut_file);

                $data->other_artcut_file = $other_artcut_file;
            }
            else{
                $data->other_artcut_file = $data->other_artcut_file;
            }
        
        $data->name = $req->name;
        $data->daraz = $req->daraz;
        $data->decorguys = $req->decorguys;
        $data->carstickers = $req->carstickers;
        $data->drive_link = $req->drive_link;
        $data->sku = $req->sku;
        $save = $data->save();

        if($save == 1){
            return redirect('/')->with('success','Product has been successfully update. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }

    }

    public function download($file){
        return response()->download(public_path('productfile/'.$file));
    }
}
