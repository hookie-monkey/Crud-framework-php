<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(2);
        return view ('empleados.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view ('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Cargo'=>'required|string|max:100',
            'Correo'=>'required|email',
            'Foto'=>'required|max:1000|mimes:jpeg,jpg,png',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Foto.required'=>'La foto es requerida'
        
        
        ];
        
        $this->validate($request, $campos,$mensaje);
        


        $datosEmpleado = request()->except('_token');
    
        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']=$request->file('Foto')->store('uploads','public');
        }
        Empleado::insert($datosEmpleado);
     // return response()->json($datosEmpleado);
        return redirect ('empleados')->with('mensaje','Empleado agregado');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id); 
        return view('empleados.edit', compact('empleado'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'Nombre'=>'required|string|max:100',
            'Apellido'=>'required|string|max:100',
            'Cargo'=>'required|string|max:100',
            'Correo'=>'required|email',
           
        ];
        $mensaje=['required'=>'El :attribute es requerido', ];
        if($request->hasFile('Foto')){
            $campos=[ 'Foto'=>'required|max:1000|mimes:jpeg,jpg,png',];
            $mensaje=['Foto.required'=>'La foto es requerida' ];
        }
        $this->validate($request, $campos,$mensaje);

        $datosEmpleado = request()->except(['_token','_method']);
    
        if($request->hasFile('Foto')){
            $empleado = Empleado::findOrFail($id); 
            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto'] = $request->file('Foto')->store('uploads','public');
        }
    
        Empleado::where('id','=',$id)->update($datosEmpleado);
        $empleado = Empleado::findOrFail($id); 
        //return view('empleados.edit', compact('empleado'));

        return redirect('empleados')->with('mensaje','Empleado Modificado');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
    
        if(Storage::delete('public/'.$empleado->Foto)){
            Empleado::destroy($id);
        }
    
        return redirect('empleados')->with('mensaje','Empleado borrado');
    }
}