<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Projet;
class ProjetController extends Controller
{
    public function index()
    {
        $projets = Projet::all();
        return response()->json(['data' => $projets]);
    }

    public function store(Request $request)
    {
        $projet = Projet::create($request->all());
        return response()->json(['data' => $projet], 201);
    }

    public function show($id)
    {
        $projet = Projet::findOrFail($id);
        return response()->json(['data' => $projet]);
    }

    public function update(Request $request, $id)
    {
        $projet = Projet::findOrFail($id);
        $projet->update($request->all());
        return response()->json(['data' => $projet]);
    }

    public function destroy($id)
    {
        $projet = Projet::findOrFail($id);
        $projet->delete();
        return response()->json(null, 204);
    }
}

