<?php

namespace App\Http\Controllers;

use App\Models\Parte;
use Illuminate\Http\Request;

class ParteController extends Controller
{

    public function index()
    {
        return Parte::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required']
        ]);

        $parte = new Parte;
        $parte->nombre = $request->input('nombre');
        $parte->save();
        return $parte;
    }


    public function show(Parte $parte)
    {
        return $parte;
    }

    public function update(Request $request, Parte $parte)
    {

        $request->validate([
            'nombre' => ['required']
        ]);

        $parte->nombre = $request->input('nombre');
        $parte->save();
        return $parte;
    }


    public function destroy(Parte $parte)
    {
        $parte->delete();

        return response()->noContent();
    }
}
