<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perhitungan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'id_protein',
        'id_karbohidrat',
        'id_kalori',
        'id_natrium',
        'id_usia',
        'hasil'
    ];

    public function protein()
    {
        return $this->belongsTo(ProteinKriteria::class, 'id_protein', 'id');
    }

    public function karbohidrat()
    {
        return $this->belongsTo(Karbohidrat::class, 'id_karbohidrat', 'id');
    }

    public function kalori()
    {
        return $this->belongsTo(Kalori::class, 'id_kalori', 'id');
    }

    public function natrium()
    {
        return $this->belongsTo(Natrium::class, 'id_natrium', 'id');
    }

    public function usia()
    {
        return $this->belongsTo(Usia::class, 'id_usia', 'id');
    }

    // public function fillTable()
    // {
    //     $hitung = [
    //         [
    //             'nama' => 'Nasi, Ayam, Telur',
    //             'id_protein' => '1',
    //             'id_karbohidrat' => '1',
    //             'hasil' => ''
    //         ],
    //     ];
    //     return $hitung;
    // }
}
