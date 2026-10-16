<?php
 
namespace App\Http\Controllers;
 
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
 
class RegistroController extends Controller
{
    public function index()
    {
        return view('registro');
    }
 
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombres'         => 'required|max:100',
            'apellidos'       => 'required|max:100',
            'fechaNacimiento' => 'required|date',
            'ninos'           => 'required|integer|min:0',
            'madreCabeza'     => 'required',
            'estudio'         => 'required',
            'generos'         => 'nullable|array',
        ]);
 
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
 
        $registro = Registro::create([
            'nombres'          => $request->nombres,
            'apellidos'        => $request->apellidos,
            'fecha_nacimiento' => $request->fechaNacimiento,
            'ninos'            => $request->ninos,
            'madre_cabeza'     => $request->madreCabeza,
            'estudia'          => $request->estudio,
            'generos'          => $request->has('generos') ? implode(', ', $request->generos) : null,
        ]);
 
        return redirect('/')
            ->with('type', 'success')
            ->with('message', 'Registro guardado exitosamente')
            ->with('registro', $registro->toArray());
    }
}
