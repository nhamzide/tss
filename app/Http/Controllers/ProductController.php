<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Product_pic;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index(){
        $product = DB::table('products')->get();
        $pic = DB::table('product_pics')->get();
        return view('products.index',compact('product','pic'));
    }

    public function add(){

        return view('products.add');
    }

    public function edit($id){
        $products = Product::find($id);
        return view('products.edit',compact('products'));
    }

    public function add_img($id){
        $id = $id;
        // $products = Product_pic::find($id);
        $pic = Product_pic::where('product_id', $id)->get();
        
        return view('products.add_img',compact('pic','id'));
    }





    public function add_to_db(Request $request){
        
        $request->validate([
            'product_name' => 'required|max:255',
            'product_price' => 'required|max:10'
        ]);

        $data = [];
        $data['name'] = $request->product_name;
        $data['price'] = $request->product_price;
        $data['created_at'] = date('Y-m-d H:i:s');
                    
        DB::table('products')->insert($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");

    }

    public function add_img_to_db(Request $request){
        
        $request->validate([
            'product_pic' => 'required'
        ]);

        $file_pic = $request->file('product_pic');
        $pic_ext = strtolower($file_pic->getClientOriginalExtension());
        $name_gen = hexdec(uniqid());
        $pic_name = $name_gen.'.'.$pic_ext;
        
        $upload_location = 'image/product_pic/';
        $path = $upload_location.$pic_name;
        
        $file_pic->move($upload_location,$pic_name);
        
        Product_pic::insert([
            'product_id'=>$request->id,
            'pic_name'=>$path,
            'created_at'=>Carbon::now()
        ]);    


        // $data = [];
        // $data['pic_name'] = $pic_name;
        // $data['product_id'] = $request->id;
        // $data['created_at'] = date('Y-m-d H:i:s');
                    
        // DB::table('products_pic')->insert($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อย");

    }

    public function edit_to_db(Request $request){
        
        $request->validate([
            'product_name' => 'required|max:255',
            'product_price' => 'required|max:10'
        ]);

        $data = [];
        $id = $request->id;
        $data['name'] = $request->product_name;
        $data['price'] = $request->product_price;
        $data['updated_at'] = date('Y-m-d H:i:s');
                    
       
        DB::table('products')
        ->where('id',$id)
        ->update($data);
        return redirect()->back()->with('success',"อัพเดทข้อมูลเรียบร้อย");

    }

    public function delete($id){
        $delete = Product::find($id)->delete();
        return redirect()->back()->with('success',"ลบข้อมูลเรียบร้อย");

    }

    public function change_status(Request $request)
    {
        
        $data = [];
        $id = $request->id;
        if( $request->is_enable == 1){
            $data['is_enable'] = 0;
        }else{
            $data['is_enable'] = 1;
        }
        
 
        DB::table('products')
        ->where('id',$id)
        ->update($data);
        // return redirect()->back()->with('success',"อัพเดทข้อมูลเรียบร้อย");

    }

}
