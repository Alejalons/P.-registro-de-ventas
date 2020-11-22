<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Models;
use App\Models\Set;
use App\Models\User;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Datebase\Eloquent\ModelNotFoundException;
use Illuminate\Datebase\Eloquent\RelationNotFoundException;


class SaleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');        

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            
            
            if(Auth::user()->isAdministrator()){                
                $ventas = Sale::all();
            }
            else
            {
                $ventas = Sale::select()
                    ->where('users_id', '=', auth()->id())
                    ->get();               
            }

           
            //inicializa array                
            $products = [];

            foreach ($ventas as $venta){
                $products = $ventas->find($venta -> id);
                // dd($products);
                
                $products_name = [];
                $products->user ->name ;
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
                // dd(array_count_values($products_name));
                // asigna productoNombre al objeto de venta
                $products->productoNombre =  array_count_values($products_name);

            }
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage() )->withInput();
        
        } catch (\ModelNotFoundException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        
        } catch (\RelationNotFoundException $ex) {
            return back()->withError($ex->getMessage() )->withInput();
        }
           

         return view('sale.index' , compact('ventas')) ;
         return response() -> json($ventas);        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('sale.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return response()->json($request);

        try {
            //Validaciones
            $campos=[
                'cliente' => ['required', 'string', 'max:191'],
                'direccion' => ['required', 'string', 'max:191'],
                'contacto' => ['required', 'string', 'max:14'],
                'contact2' => ['max:14'],
                'rut' => ['required', 'string', 'max:13'],
                'mail' => ['required', 'string','email', 'max:191'],
                'price' => ['required', 'string', 'max:11'],
                'dispatchPrice' => ['required', 'string', 'max:11'],
                'producto' => ['required']
            ];
            $Mensaje = ["required" => 'Es requerido'];
            $this->validate($request, $campos, $Mensaje);

            //obtengo datos exceptuando el token enviado por request
            $data = request()->except('_token');
            //creacion
            $product = Sale::create([
                'nameClient' => $data['cliente'],
                'address' => $data['direccion'],
                'contact' => $data['contacto'],
                'contactSecond' => $data['contact2'],
                'rut' => $data['rut'],
                'mail' => $data['mail'],
                'paymentMethod' => $data['tipo-pago'],
                'status' => $data['status'],
                'price' => str_replace(array('.', ','), '' , $data['price']),
                'dispatchPrice' => str_replace(array('.', ','), '' , $data['dispatchPrice']),
                'users_id' => auth()->id()
            ]);
            
            // inserta todos los id entregados por el array de productos
            for ($i=0; $i < count($data['producto']) ; $i++) 
            {   
                //se insertara las cantidad por cada producto
                for($e=0; $e < $data['cantProduct'][$i]; $e++)
                {
                    //inserta en sale_product id de la venta mas id de los productos
                    $product->product()->attach(Product::where('id', $data['producto'][$i])->first());   
                }         
                
            }
        
        } catch (\ModelNotFoundException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        
        } catch (\RelationNotFoundException $ex) {
            return back()->withError($ex->getMessage() )->withInput();
        }
        // return response()->json($request);
        return redirect('sale') -> with('MensajeCreacion', 'Venta creada con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {

            //consulto ventas
            $ventas = Sale::select()
                    ->where('id', '=', $id)
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
                    array_push($products_name, 'p='.$models['name'].' - '.$sets['name'].'id='.$product->id);
                }
                $products->productoNombre =  array_count_values($products_name);

            }
            
            $venta = $ventas[0];
        } catch (\Throwable $th) {

            return back()->withError($th->getMessage() )->withInput();   

        } catch (\ModelNotFoundException $ex) {

            return back()->withError($ex->getMessage())->withInput();
        
        } catch (\RelationNotFoundException $ex) {
            return back()->withError($ex->getMessage() )->withInput();
        }

        return view('sale.edit', compact('venta')) ;
        return response() -> json($venta);  

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id_venta)
    {
        
        
        // return response() -> json($request);  

        try {
            //Validaciones
            $campos=[
                'cliente' => ['required', 'string', 'max:191'],
                'direccion' => ['required', 'string', 'max:191'],
                'contacto' => ['required', 'string', 'max:14'],
                'contact2' => ['max:14'],
                'rut' => ['required', 'string', 'max:13'],
                'mail' => ['required', 'string','email', 'max:191'],
                'price' => ['required', 'string', 'max:11'],
                'dispatchPrice' => ['required', 'string', 'max:11']
            ];
            $Mensaje = ["required" => 'Es requerido'];
            $this->validate($request, $campos, $Mensaje);

            $data = request()->except(['_token', '_method']);
            
            //buscar objeto
            $venta = Sale::whereId($id_venta)->first();
            //actualiza
            $venta -> update([            
                    'nameClient' => $data['cliente'],
                    'address' => $data['direccion'],
                    'contact' => $data['contacto'],
                    'contactSecond' => $data['contact2'],
                    'rut' => $data['rut'],
                    'mail' => $data['mail'],
                    'paymentMethod' => $data['tipo-pago'],
                    'status' => $data['status'],
                    'price' => str_replace(array('.', ','), '' , $data['price']),
                    'dispatchPrice' => str_replace(array('.', ','), '' , $data['dispatchPrice']),
                    'users_id' => auth()->id()
                ]); 

            if(isset($data['producto'])){
                // actualiza tabla que se encuentra en intermedio con producto
                $venta -> product() -> detach();
                for ($i=0; $i < count($data['producto']) ; $i++) 
                {   
                    //se insertara las cantidad por cada producto
                    for($e=0; $e < $data['cantProduct'][$i]; $e++)
                    {
                        $venta -> product() -> attach($data['producto'][$i]);   
                    }
                }
            }
            else
            {
                $venta -> product() -> detach();
                for ($i=0; $i < count($data['cantProduct']) ; $i++) { 

                    foreach ($data['cantProduct'][$i] as $key => $value) 
                    {
                        // dd($key);
                        for($e=0; $e < $value ; $e++)
                        {
                            $venta -> product() -> attach($key);  
                                    
                        }
                    }
                }
                
            }
                     

            //busco o falla
            $ModifiedVenta = Sale::findOrFail($id_venta);
      
        } catch (\ModelNotFoundException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        
        } catch (\RelationNotFoundException $ex) {
            return back()->withError($ex->getMessage() )->withInput();
        }

        return redirect('sale') -> with('MensajeUpdate', 'Venta Modificada con exito');



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_venta)
    {
        try {

            $venta = Sale::whereId($id_venta)->first();
            $venta -> product() -> detach();
            $venta -> delete();
             
        } catch (\Throwable $th) {
            return back()->withError($th->getMessage() )->withInput();
        
        } catch (\ModelNotFoundException $ex) {
            return back()->withError($ex->getMessage())->withInput();
        
        } catch (\RelationNotFoundException $ex) {
            return back()->withError($ex->getMessage() )->withInput();
        }

        return redirect('sale') -> with('MsjSaleDelete', 'Venta Eliminada con exito');

        // return response() -> json($venta);  

    }


    //Funciones de buscar
    public function selectSearch(Request $request){
        $models = [];       
        if($request->has('q')){

            $search = $request->q;
            $models = Models::select("id", "name")
                        ->where('name', 'LIKE', "%$search%")
                        ->get();

            // dd($models);
            foreach ($models as $model){
                $products_sets = $models->find($model -> id);

                foreach($products_sets -> sets  as $set){        

                    $text=$model -> name. ' | '.$set->name ;
                    $data[] = ['id' => $set->pivot->id, 'text' => $text , 'price' => $set->pivot->price ];
                }
            
            }
        }
        // dd($data);
                   
        return response()->json($data);
    }

    //envia suma de cantidad de productos
    public function insertPrice(Request $request)
    {   
        
        $data = json_decode($request['array']);
        // return response()->json($data[0]->Id);
        
        $valPrice = 0;
        $value = [];
        $id = null;
        // if($request->has('id')){

            // $id = $request->id;

            for ($i=0; $i < count($data); $i++) { 

                $value = Product::select("price")
                                ->where('id', '=', $data[$i]->Id)
                                ->get();

                $precioCant = $value[0]->price * $data[$i]->cantidad;
                $valPrice += $precioCant;
            }

        // }

         return response()->json($valPrice);
        
    }

    //recortar string
// after ('@', 'biohazard@online.ge');
// //returns 'online.ge'
// //from the first occurrence of '@'

// before ('@', 'biohazard@online.ge');
// //returns 'biohazard'
// //from the first occurrence of '@'
    public static function after ($e, $inthat)
    {
        if (!is_bool(strpos($inthat, $e))){
            return substr($inthat, strpos($inthat,$e)+strlen($e));
        }
    }

    public static function before ($e, $inthat)
    {
        return substr($inthat, 0, strpos($inthat, $e));
    }

    public static function strrevpos($instr, $needle)
    {
        $rev_pos = strpos (strrev($instr), strrev($needle));
        if ($rev_pos===false) return false;
        else return strlen($instr) - $rev_pos - strlen($needle);
    }
}
