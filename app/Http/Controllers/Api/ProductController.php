<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiError;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        //Product::all();
        
        //return $this->product->all();

        $data = ['data' => $this->product->all()];
        //return response()->json($data);
        
        return response()->json($this->product->paginate(10));
        
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
        //POSTMAN
        //dd($request->all());

        //$productData = $request->all();
        //$this->product->create($productData); Assim crio dados com uma requisao POST

        try{

            $productData = $request()->all();
            $this->product()->create($productData);

            return response()->json(['msg' => 'Criado com Sucesso'],201);

        }
        catch(\Exception $e){
            if(config('app.debug')){

                return response()->json(ApiError::errorMessage($e->getMessage(),1010));

            }

            return response()->json(ApiError::errorMessage("Houve um erro ao realizar operação",1010));
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $id)
    {
        $data = ["data"=>$id];
        return response()->json($data);
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
        try{

            $productData = $request()->all();
            $product = $this->product->find($id);
            $product->update($productData);

            return response()->json(['msg' => 'Atualizado com Sucesso'],201);

        }
        catch(\Exception $e){
            if(config('app.debug')){

                return response()->json(ApiError::errorMessage($e->getMessage(),1010));

            }

            return response()->json(ApiError::errorMessage("Houve um erro ao realizar operação",1010));
        }

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
}
