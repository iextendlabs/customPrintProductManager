<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
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
            $data->other_artcut_file = 'null';
        }

        $data->name = $req->name;
        if(isset($req->drive_link)){
            $data->drive_link = $req->drive_link;
        }else{
            $data->drive_link = 'null';
        }
        $data->daraz = $req->daraz;
        $data->decorguys = $req->decorguys;
        $data->carstickers = $req->carstickers;
        $data->sku = $req->sku;

        $save = $data->save();

        if($save == 1){
            return redirect('/productList')->with('success','New Product has been successfully added. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }
    }

    public function products(){
        $products = product::all();
        return view('product.productList',compact('products'));
    }

    public function searchProduct(Request $req){
        $query = product::query();
        $query->where('name','like', $req->search.'%' )
        ->orWhere('sku','like', $req->search.'%' );
        $products = $query->get();
        $search = $req->search;
        return view('product.productList',compact('products','search'));
        
    }

    public function filterProduct(Request $req){
        $query = product::query();
        if(isset($req->name)){
            $query->where('name','like',$req->name.'%');
        }
        if(isset($req->drive_link)){
            $query->where('drive_link',$req->drive_link.'%');
        }
        if(isset($req->sku)){
            $query->where('sku','like',$req->sku.'%');
        }
        if(isset($req->artcut_file)){
            if($req->artcut_file == 1){
                $query->where('artcut_file','!=','null');
            }else{
                $query->where('artcut_file','null');
            }
        }
        if(isset($req->other_artcut_file)){
            if($req->other_artcut_file == 1){
                $query->where('other_artcut_file','!=','null');
            }else{
                $query->where('other_artcut_file','null');
            }
        }
        if(isset($req->daraz)){
            $query->where('daraz',$req->daraz);
        }
        if(isset($req->decorguys)){
            $query->where('decorguys',$req->decorguys);
        }
        if(isset($req->carstickers)){
            $query->where('carstickers',$req->carstickers);
        }
        $products = $query->get();
        $old_data = [
            'name' => $req->name,
            'drive_link' => $req->drive_link,
            'sku' => $req->sku,
            'artcut_file' => $req->artcut_file,
            'other_artcut_file' => $req->other_artcut_file,
            'daraz' => $req->daraz,
            'decorguys' => $req->decorguys,
            'carstickers' => $req->carstickers,
        ];
        return view('product.productList',compact('products','old_data'));
        
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
            return redirect('/productList')->with('success','Product has been successfully Remove. ');
        }else{
            return redirect('/productList')->with('fail','Something went wrong.');
        }
    }

    public function getProduct($id){
        $product = product::find($id);

        return view('product.productEdit',compact('product'));
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
            return redirect('/productList')->with('success','Product has been successfully update. ');
        }else{
            return back()->with('fail','Something went wrong.');
        }

    }

    public function download($file){
        return response()->download(public_path('productfile/'.$file));
    }
}
