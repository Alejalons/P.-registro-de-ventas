<?php

namespace App\Http\Controllers;

use App\Models\Models;
use App\Models\Set;
use App\Models\Sale;
use App\Models\Product;
use Illuminate\Http\Request;

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
    public function index()
    {
        $models = Models::all();
        return view('sale.index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
          //Validaciones
          $campos=[
            'cliente' => ['required', 'string', 'max:191'],
            'direcccion' => ['required', 'string', 'max:191'],
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


        $data = request()->except('_token');
        $product = Sale::create([
            'nameClient' => $data['cliente'],
            'address' => $data['direcccion'],
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

        for ($i=0; $i < count($data['producto']) ; $i++) {            
            
            $product->product()->attach(Product::where('id', $data['producto'][$i])->first());
        }
        
        // return response()->json($request);
        return view('home') -> with('MensajeCreacion', 'Venta creada con exito');

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
                array_push($products_name, $models['name'].' - '.$sets['name']);
            }
            $products->productoNombre =  $products_name;

        }
        
        $venta = $ventas[0];
        // return response() -> json($venta);  
        return view('sale.edit', compact('venta')) ;
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
        // dd($id);
        //  return response() -> json($request);  
        
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

        $data = request()->except(['_token', '_method']);
        

        $venta = Sale::whereId($id_venta)->first();
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
       
        // actualiza tabla que se encuentra en intermedio con producto
        $venta -> product() -> sync($data['producto']);
        

        if($ModifiedVenta = Sale::findOrFail($id_venta)){
            return redirect('home') -> with('MensajeUpdate', 'Venta Modificada con exito');
        }
        else
        {
            return redirect('sale.edit') -> with('MensajeUpdateError', 'Venta No fue Modificada con exito');
        }

        return response() -> json($ModifiedVenta);  



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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

                    $text=$model -> name. ' | '.$set->name . ' ('.$set->pivot->price.')' ;
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

        // return "hola";
        $valPrice = 0;
        $value = [];
        $id = null;
        if($request->has('id')){

            $id = $request->id;

            for ($i=0; $i < count($id); $i++) { 

                $value = Product::select("price")
                                ->where('id', '=', "$id[$i]")
                                ->get();

                $valPrice += $value[0] -> price;
            }

        }

        return response()->json($valPrice);
        
    }
}
