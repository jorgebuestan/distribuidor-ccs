<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::user()->hasRole('admin')) {
            return view('not_authorized');
        }

        $tipo_contribuyente = 

        return view('admin.empresas');
    }

    public function obtener_listado_empresas(Request $request)

    {
        $columns = [
            0 => 'empresas.id',
            1 => 'acciones'
        ];

        $query = DB::table('empresas')
            ->select(
                'empresas.id',
                'empresas.razon_social',
                'empresas.ruc',
            )
            ->orderBy('empresas.razon_social', 'asc');  

    // Busqueda por razon social o ruc

    if ($search = $request->input('search.value')) {
        $query->where(function($query) use ($search) {
            $query->where('empresas.razon_social', 'like', "%$search%")
                ->orWhere('empresas.ruc', 'like', "%$search%");
        });
    }

    $totalFiltered = $query->count();

    // Ordenar por columna seleccionada y direccion de ordenamiento (asc o desc) 

    $orderColumnIndex = $request->input('order.0.column');
    $orderDir = $request->input('order.0.dir', 'asc');

    if (isset($columns[$orderColumnIndex])) {
        $orderColumn = $columns[$orderColumnIndex];
        $query->orderBy($orderColumn, $orderDir);
    }

    // Paginacion
    $start = $request->input('start') ?? 0;
    $length = $request->input('length') ?? 10;
    $query->skip($start)->take($length);

    $empresas = $query->get();

    //pendiente de revisar
    $json_data = [
        'draw' => intval($request->input('draw')),
        'recordsTotal' => DB::table('empresas')->count(),
        'recordsFiltered' => $totalFiltered,
    ];

    return response()->json($json_data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
