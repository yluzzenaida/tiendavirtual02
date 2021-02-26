<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['articulos']=Articulo::paginate(1);

        return view('articulo.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('articulo.create');
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
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            'CodMarca'=>'required|string|max:100',
            'CodCategoria'=>'required|string|max:100',
            'Stock'=>'required|string|max:100',
            'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];
        $mensaje=[
            'required'=>'EL :attribute es requerido',
            'Descripcion.required'=>'La descripcion es requerida',
            'Foto.required'=>'La foto es requerida'
            


        ];

        $this->validate($request, $campos, $mensaje);




        //$datosArticulo = request()->all();
        $datosArticulo = request()->except('_token');

        if($request->hasFile('Foto')){

            $datosArticulo['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Articulo::insert($datosArticulo);

        //return response()->json($datosArticulo);
        return redirect('articulo')->with('mensaje','Articulo agregado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $articulo=Articulo::findOrFail($id);
        return view('articulo.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Descripcion'=>'required|string|max:100',
            'Precio'=>'required|string|max:100',
            'CodMarca'=>'required|string|max:100',
            'CodCategoria'=>'required|string|max:100',
            'Stock'=>'required|string|max:100',
            

        ];
        $mensaje=[
            'required'=>'EL :attribute es requerido',
            'Descripcion.required'=>'La descripcion es requerida'
            
            


        ];

        if($request->hasFile('Foto')){
            $campos=[ 'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $mensaje=['Foto.required'=>'La foto es requerida'];

        }

        $this->validate($request, $campos, $mensaje);




        //
        $datosArticulo = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $articulo=Articulo::findOrFail($id);
            Storage::delete(['public/'.$articulo->foto]);
            $datosArticulo['Foto']=$request->file('Foto')->store('uploads','public');


        }
        Articulo::where('id','=',$id)->update($datosArticulo);
        $articulo=Articulo::findOrFail($id);
        //return view('articulo.edit', compact('articulo'));
        return redirect('articulo')->with('mensaje','Articulo Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $articulo=Articulo::findOrFail($id);

        if(Storage::delete('public/'.$articulo->foto)){

        Articulo::destroy($id);
        }
        return redirect('articulo')->with('mensaje','Articulo Borrado');
    }
}
