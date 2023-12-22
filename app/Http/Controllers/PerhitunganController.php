<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use App\Models\Kalori;
use App\Models\Karbohidrat;
use App\Models\Perhitungan;
use App\Models\ProteinKriteria;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proteinOptions = ProteinKriteria::select('protein','nilai', 'id' )->get();
        $dataProtein = Perhitungan::with('protein')->get();

        $karbohidratOptions = Karbohidrat::all();
        $dataKarbohidrat = Perhitungan::with('karbohidrat')->get();

        $kaloriOptions = Kalori::all();
        $dataKalori = Perhitungan::with('kalori')->get();

        $hitungs = Perhitungan::all();

        // $bobot = BobotKriteria::select('bobot')->get();
        // $karbohidrat = Karbohidrat::select('nilai')->get();
        if (count($hitungs) > 0)
        {
            $hitungMax = $hitungs->sortByDesc('hasil')->first();
        } else {
            $hitungMax = null;
        }

        // $hasil = ($proteinOptions->get('nilai') * $bobot[0]->bobot) + ($karbohidrat * $bobot[1]->bobot);

        // $hasil = ($proteinOptions->pluck('nilai')->first() * $bobot->first()->bobot) + ($karbohidrat->first()->nilai * $bobot->skip(1)->first()->bobot);
        // dd($hasil);

        // $bobotProtein = $bobot->first()->bobot;
        // $bobotKarbohidrat = $bobot->skip(1)->first()->bobot;

        // $hasil = ($proteinOptions->pluck('nilai')->first() * $bobotProtein) + ($karbohidrat->first()->nilai * $bobotKarbohidrat);
        return view('perhitungan.index', compact('proteinOptions','karbohidratOptions', 'dataKarbohidrat' ,'hitungs', 'dataProtein', 'hitungMax', 'kaloriOptions', 'dataKalori'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proteinOptions = ProteinKriteria::all();
        return view('perhitungan.create', compact('proteinOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'id_protein' => 'required|exists:protein_kriterias,id',
            'id_karbohidrat' => 'required|exists:karbohidrats,id',
            'id_kalori' => 'required|exists:kaloris,id'
        ]);

        $protein = ProteinKriteria::find($request->id_protein);
        $karbohidrat = Karbohidrat::find($request->id_karbohidrat);
        $kalori = Kalori::find($request->id_kalori);

        $bobotKriteriaProtein = BobotKriteria::where('kriteria', 'Protein')->first();
        $bobotKriteriaKarbohidrat = BobotKriteria::where('kriteria', 'Karbohidrat')->first();
        $bobotKriteriaKalori = BobotKriteria::where('kriteria', 'Kalori')->first();

        $nilaiBobotProtein = $bobotKriteriaProtein ? $bobotKriteriaProtein->bobot : 0.6;
        $nilaiBobotKarbohidrat = $bobotKriteriaKarbohidrat ? $bobotKriteriaKarbohidrat->bobot : 0.2;
        $nilaiBobotKalori = $bobotKriteriaKalori ? $bobotKriteriaKalori->bobot : 0.2;

        $hasil = ($protein->nilai * $nilaiBobotProtein) + ($karbohidrat->nilai * $nilaiBobotKarbohidrat) + ($kalori->nilai * $nilaiBobotKalori);

        Perhitungan::create([
            'nama' => $request->nama,
            'id_protein' => $request->id_protein,
            'id_karbohidrat' => $request->id_karbohidrat,
            'id_kalori' => $request->id_kalori,
            'hasil' => $hasil,
        ]);

        return redirect()->route('hitung.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Perhitungan $perhitungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hitungs = Perhitungan::find($id);
        $proteinOptions = ProteinKriteria::select('protein','nilai', 'id' )->get();
        $karbohidratOptions = Karbohidrat::all();
        $kaloriOptions = Kalori::all();
        // $hitungs = Perhitungan::all();
        $dataProtein = Perhitungan::with('protein')->get();
        $dataKarbohidrat = Perhitungan::with('karbohidrat')->get();

        return view('perhitungan.edit', compact('hitungs', 'proteinOptions', 'dataProtein', 'karbohidratOptions', 'dataKarbohidrat', 'kaloriOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'nama' => 'required|string',
            'id_protein' => 'required|exists:protein_kriterias,id',
            'id_karbohidrat' => 'required|exists:karbohidrats,id',
            'id_kalori' => 'required|exists:kaloris,id',
        ]);

        $hitungs =Perhitungan::find($id);

        $protein = ProteinKriteria::find($request->id_protein);
        $karbohidrat = Karbohidrat::find($request->id_karbohidrat);
        $kalori = Kalori::find($request->id_kalori);

        $bobotKriteriaProtein = BobotKriteria::where('kriteria', 'Protein')->first();
        $bobotKriteriaKarbohidrat = BobotKriteria::where('kriteria', 'Karbohidrat')->first();
        $bobotKriteriaKalori = BobotKriteria::where('kriteria', 'Kalori')->first();

        $nilaiBobotProtein = $bobotKriteriaProtein ? $bobotKriteriaProtein->bobot : 0.6;
        $nilaiBobotKarbohidrat = $bobotKriteriaKarbohidrat ? $bobotKriteriaKarbohidrat->bobot : 0.2;
        $nilaiBobotKalori = $bobotKriteriaKalori ? $bobotKriteriaKalori->bobot : 0.2;

        $hasil = ($protein->nilai * $nilaiBobotProtein) + ($karbohidrat->nilai * $nilaiBobotKarbohidrat) + ($kalori->nilai * $nilaiBobotKalori);


        $hitungs -> update([
            'nama' => $request -> nama,
            'id_protein' => $request -> id_protein,
            'id_karbohidrat' => $request -> id_karbohidrat,
            'id_kalori' => $request -> id_kalori,
            'hasil' => $hasil,
        ]);

        return redirect()->route('hitung.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hitungs = Perhitungan::find($id);

        $hitungs->delete();

        return redirect()->route('hitung.index');
    }
}
