<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrdenCompra;
use App\Models\Proveedor;
use App\Models\Producto;


use Illuminate\Support\Facades\DB;

class OrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prov = Proveedor::all();
        return view('ordenCompra.index')->with('proveedores',$prov);

        $prod = Producto::all();
        return view('ordenCompra.index')->with('productos',$prod);
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
        //
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

    public function buscarProductos()
    {
        $id = request('id');
        
        $options='';
        $results = Producto::where('id_proveedor',$id)->get();
        
            foreach($results as $prod){
            
                if(($prod->cantidad)>0){
                    $options.="<tr>";
                    $options.="<td><input type='checkbox' class='checkProd'value='{$prod->id}'></td>";
                    $options.="<td>{$prod->descripcion}</td>";
                    $options.="<td>
                    </td>";
                    $options.="<td><input class='form-control' id='precioProd{$prod->id}' type='number'  value='{$prod->precio}' readonly></td>";
                    
                    $options.="</tr>";
                }
                
            }
    
            echo $results;
        return $results;
    }

   
}
