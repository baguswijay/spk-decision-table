<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BobotKriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria',
        'bobot',
    ];

    public function fillTable()
    {
        $bobotKriteria = [
            [
                'kriteria' => 'Protein',
                'bobot' => '0.6'
            ],
            [
                'kriteria' => 'Karbohidrat',
                'bobot' => '0.2'
            ],
            [
                'kriteria' => 'Kalori',
                'bobot' => '0.2'
            ],
        ];
        return $bobotKriteria;
    }
}
