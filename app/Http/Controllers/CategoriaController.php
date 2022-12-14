<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Empleado;
use PDF;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //$categorias = Categoria::all();
        $categorias = Categoria::where('isEnable','=',1)->get();
        return view('categoria.index')->with('categorias',$categorias);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categorias = new Categoria();
        $id_user = auth()->user()->id;
        //$id = auth()->user()->id;
        $empleado = Empleado::where('id_user','=',$id_user)->first();
        $nombre = $request->get('nombre');
        $categorias->nombre = $nombre;
        $categorias->detalle = $request->get('detalle');
        //$categorias->matricula = auth()->user()->matricula;
        $categorias->matricula = $empleado->matricula;
        $categorias->sufijo_categoria = strtoupper(substr($nombre,0,2));

        $categorias->save();
        return redirect('/categorias');
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
     * @param  int  $id_categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = Categoria::find($id);
        return view('categoria.edit')->with('categoria',$categoria);
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
        $categoria = Categoria::find($id);
        $nombre = $request->get('nombre');
        $categoria->nombre = $nombre;
        $categoria->detalle = $request->get('detalle');
        $categoria->sufijo_categoria = strtoupper(substr($nombre,0,2));

        $categoria->save();
        return redirect('/categorias');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->isEnable = false;
        $categoria->save();
        //$categoria->delete();
        return redirect('/categorias');
    }

    //Funciones propias
    public function reporte(){
        $categorias = Categoria::where('isEnable','=',1);
        $fecha_actual = date_create(date('d-m-Y'));
        $fecha = date_format($fecha_actual,'d-m-Y');
        $pdf = PDF::loadView('categoria/pdf_categoria',compact('categorias','fecha'));
        return $pdf->download('categorias_'.date_format($fecha_actual,"Y-m-d").'.pdf');
        //return view('categoria/pdf_categoria',compact('categorias','fecha'));
    }
}
