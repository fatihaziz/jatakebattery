<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Library\Libs;
use Exception;
use Responder;
class ProductsControl extends Controller
{
    //

    public function __construct()
    {
        $this->lib = new Libs();
        $this->products = new Product();
        $this->middleware(function($req,$next){
            if(!$req->expectsJson())
                return Responder::error("unauthorized","unauthorized")->respond(401);
            if(!empty(session('admin_token')))
            {
                $this->token = session('admin_token');
                $this->products = new Product(['token'=>$this->token,]);
            }
            else
            {
                return redirect(route('admin.login'));
            }
            return $next($req);
        })->except(['show','index']);
    }

    public function index(Request $req)
    {
        abort(404);
    }

    public function show(Request $req, $id)
    {
        try {
            $resp = Product::detail($id)->firstOrFail();
            $data['page'] = 'detail';
            $recomend = Product::orderBy('views')->get()->toArray();
            $recomend = array_slice($recomend, 0, 4);
            $data['recomends'] = arr2Obj($recomend);
            $data['product']=$resp;
            // dd($data);
            return view('detail',$data);
        }
        catch (\Exception $e)
        {
            // throwing previous error
            throw $e;
        }
    }

    public function store(Request $req){

        try
        {
            $data = $req->all();
            $product = new Product($data);
            $product->save();
            return Responder::success($product)->respond(201);
        }
        catch(Exception $e)
        {
            Responder::error("product_create_fail","Fail to Create Product")->data($e)->respond();
        }

    }

    public function update(Request $req, $id)
    {
        try
        {
            $data = $req->all();
            $product = Product::find($id);
            $product->update($data);
            return Responder::success($product)->respond(201);
        }
        catch(Exception $e)
        {
            return Responder::error("product_update_fail","Fail to Update Product")->data($e)->respond();
        }
    }

    public function destroy(Request $req,$id)
    {
        try{
            $product = Product::find($id);
            $delete = $product->delete();
            return Responder::success($delete)->respond(204);
        }
        catch(\Exception $e)
        {
            return Responder::error("product_delete_fail","Fail to Delete Product")->data($e)->respond();
        }
    }
}