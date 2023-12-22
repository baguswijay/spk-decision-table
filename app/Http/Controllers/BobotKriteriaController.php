<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use Illuminate\Http\Request;

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
    public function show(BobotKriteria $bobotKriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BobotKriteria $bobotKriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BobotKriteria $bobotKriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BobotKriteria $bobotKriteria)
    {
        //
    }
}
