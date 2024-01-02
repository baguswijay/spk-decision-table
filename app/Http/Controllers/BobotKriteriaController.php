<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BobotKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = BobotKriteria::all();
        $total = $kriterias->sum('bobot');
        $botMax = $kriterias->max('bobot');
        $jumBaris = $kriterias->count();
        return view('bobotKriteria', compact('kriterias', 'total', 'botMax', 'jumBaris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kriteria'   => 'required',
            'bobot'        => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $kriteria = BobotKriteria::create([
            'kriteria'     => $request->kriteria,
            'bobot'   => $request->bobot
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data'    => $kriteria
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(BobotKriteria $bobotKriteria)
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $bobotKriteria
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
    //     $kriteria = BobotKriteria::find($id);

    //     return view('components.bobotKriteria.edit', compact('kriteria'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BobotKriteria $bobotKriteria)
    {
        $validator = Validator::make($request->all(), [
            'kriteria'      => 'required',
            'bobot'         => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // dd($kriteria);
        // create post
        $bobotKriteria->update([
            'kriteria'      => $request->kriteria,
            'bobot'         => $request->bobot
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $bobotKriteria
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        BobotKriteria::where('id', $id)->delete();

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data BobotKriteria Berhasil Dihapus!.',
        ]);
    }
}
