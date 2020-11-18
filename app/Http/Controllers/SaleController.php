<?php

namespace App\Http\Controllers;

use App\Models\Models;
use App\Models\Set;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
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
        return response()->json($request);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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


    // 
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
