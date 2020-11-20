<?php

namespace App\Http\Controllers;

use App\Models\Models;
use App\Models\Set;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user','admin']);
        
        //consulto ventas
        $ventas = Sale::select()
                ->where('users_id', '=', auth()->id())
                ->get();
               
        //inicializa array                
        $products = [];

        foreach ($ventas as $venta){
            $products = $ventas->find($venta -> id);
            
            // array_push($product, )
            //obtengo datos unidos a las ventas
            $products_name = [];
            foreach($products -> product  as $product){        

                //obtener id asociado a los producto
                $id_models=$product->models_id;
                $id_set=$product->set_id;
                
                //busca objeto asociado al id enviado
                $models = Models::find($id_models);
                $sets = Set::find($id_set);                

                //encuentra nombre
                array_push($products_name, $models['name'].' - '.$sets['name']);
            }
            $products->productoNombre =  $products_name;

        }
        
           
       //  return response() -> json($ventas);        
        return view('home' , compact(['ventas', 'products_name'])) ;
    }
}
