<?php

namespace App\Http\Controllers;

use App\Models\BobotKriteria;
use App\Models\Kalori;
use App\Models\Karbohidrat;
use App\Models\Natrium;
use App\Models\Perhitungan;
use App\Models\ProteinKriteria;
use App\Models\Usia;
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

        $natriumOptions = Natrium::all();
        $dataNatrium = Perhitungan::with('natrium')->get();

        $usiaOptions = Usia::all();
        $dataUsia = Perhitungan::with('usia')->get();

        $hitungs = Perhitungan::all();
        $max = Perhitungan::max('hasil');

        $kriteria = BobotKriteria::all();
        // $maxData = Perhitungan::where('hasil', $max)->get();

        // $bobot = BobotKriteria::select('bobot')->get();
        // $karbohidrat = Karbohidrat::select('nilai')->get();
        if (count($hitungs) > 0)
        {
            $maxData = Perhitungan::where('hasil', $max)->get();
            // dd($maxData);
            // $hitungMax = $hitungs->sortByDesc('hasil')->first();
        } else {
            $maxData = null;
        }

        // $hasil = ($proteinOptions->get('nilai') * $bobot[0]->bobot) + ($karbohidrat * $bobot[1]->bobot);

        // $hasil = ($proteinOptions->pluck('nilai')->first() * $bobot->first()->bobot) + ($karbohidrat->first()->nilai * $bobot->skip(1)->first()->bobot);
        // dd($hasil);

        // $bobotProtein = $bobot->first()->bobot;
        // $bobotKarbohidrat = $bobot->skip(1)->first()->bobot;

        // $hasil = ($proteinOptions->pluck('nilai')->first() * $bobotProtein) + ($karbohidrat->first()->nilai * $bobotKarbohidrat);
        return view('perhitungan.index', compact('kriteria','proteinOptions','karbohidratOptions', 'dataKarbohidrat' ,'hitungs', 'dataProtein', 'maxData', 'kaloriOptions', 'dataKalori', 'max',
        'natriumOptions', 'dataNatrium', 'usiaOptions', 'dataUsia'))->with('i');
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
            'id_kalori' => 'required|exists:kaloris,id',
            'id_natrium' => 'required|exists:natria,id',
            'id_usia'   => 'required|exists:usias,id'
        ]);

        $protein = ProteinKriteria::find($request->id_protein);
        $karbohidrat = Karbohidrat::find($request->id_karbohidrat);
        $kalori = Kalori::find($request->id_kalori);
        $natrium = Natrium::find($request->id_natrium);
        $usia   = Usia::find($request->id_usia);

        $bobotKriteriaProtein = BobotKriteria::where('kriteria', 'Protein')->first();
        $bobotKriteriaKarbohidrat = BobotKriteria::where('kriteria', 'Karbohidrat')->first();
        $bobotKriteriaKalori = BobotKriteria::where('kriteria', 'Kalori')->first();
        $bobotKriteriaNatrium = BobotKriteria::where('kriteria', 'Natrium')->first();
        $bobotKriteriaUsia = BobotKriteria::where('kriteria', 'Usia')->first();

        $nilaiBobotProtein = $bobotKriteriaProtein ? $bobotKriteriaProtein->bobot : 0.2;
        $nilaiBobotKarbohidrat = $bobotKriteriaKarbohidrat ? $bobotKriteriaKarbohidrat->bobot : 0.2;
        $nilaiBobotKalori = $bobotKriteriaKalori ? $bobotKriteriaKalori->bobot : 0.2;
        $nilaiBobotNatrium = $bobotKriteriaNatrium ? $bobotKriteriaNatrium->bobot : 0.2;
        $nilaiBobotUsia = $bobotKriteriaUsia ? $bobotKriteriaUsia->bobot : 0.2;

        $hasil = ($protein->nilai * $nilaiBobotProtein) + ($karbohidrat->nilai * $nilaiBobotKarbohidrat) + ($kalori->nilai * $nilaiBobotKalori) + ($natrium->nilai * $nilaiBobotNatrium) + ($usia->nilai * $nilaiBobotUsia);

        Perhitungan::create([
            'nama' => $request->nama,
            'id_protein' => $request->id_protein,
            'id_karbohidrat' => $request->id_karbohidrat,
            'id_kalori' => $request->id_kalori,
            'id_natrium' => $request->id_natrium,
            'id_usia' => $request->id_usia,
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
        $natriumOptions = Natrium::all();
        $usiaOptions = Usia::all();
        // $hitungs = Perhitungan::all();
        $dataProtein = Perhitungan::with('protein')->get();
        $dataKarbohidrat = Perhitungan::with('karbohidrat')->get();

        return view('perhitungan.edit', compact('hitungs', 'proteinOptions', 'dataProtein', 'karbohidratOptions', 'dataKarbohidrat', 'kaloriOptions', 'natriumOptions', 'usiaOptions'));
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
            'id_natrium' => 'required|exists:natria, id',
            'id_usia'   => 'required|exists:usias, id'
        ]);

        $hitungs =Perhitungan::find($id);

        $protein = ProteinKriteria::find($request->id_protein);
        $karbohidrat = Karbohidrat::find($request->id_karbohidrat);
        $kalori = Kalori::find($request->id_kalori);
        $natrium = Natrium::find($request->id_natrium);
        $usia   = Usia::find($request->id_usia);

        $bobotKriteriaProtein = BobotKriteria::where('kriteria', 'Protein')->first();
        $bobotKriteriaKarbohidrat = BobotKriteria::where('kriteria', 'Karbohidrat')->first();
        $bobotKriteriaKalori = BobotKriteria::where('kriteria', 'Kalori')->first();
        $bobotKriteriaNatrium = BobotKriteria::where('kriteria', 'Natrium')->first();
        $bobotKriteriaUsia = BobotKriteria::where('kriteria', 'Usia')->first();

        $nilaiBobotProtein = $bobotKriteriaProtein ? $bobotKriteriaProtein->bobot : 0.2;
        $nilaiBobotKarbohidrat = $bobotKriteriaKarbohidrat ? $bobotKriteriaKarbohidrat->bobot : 0.2;
        $nilaiBobotKalori = $bobotKriteriaKalori ? $bobotKriteriaKalori->bobot : 0.2;
        $nilaiBobotNatrium = $bobotKriteriaNatrium ? $bobotKriteriaNatrium->bobot : 0.2;
        $nilaiBobotUsia = $bobotKriteriaUsia ? $bobotKriteriaUsia->bobot : 0.2;

        $hasil = ($protein->nilai * $nilaiBobotProtein) + ($karbohidrat->nilai * $nilaiBobotKarbohidrat) + ($kalori->nilai * $nilaiBobotKalori) + ($natrium->nilai * $nilaiBobotNatrium) + ($usia->nilai * $nilaiBobotUsia);

        Perhitungan::create([
            'nama' => $request->nama,
            'id_protein' => $request->id_protein,
            'id_karbohidrat' => $request->id_karbohidrat,
            'id_kalori' => $request->id_kalori,
            'id_natrium' => $request->id_natrium,
            'id_usia' => $request->id_usia,
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
