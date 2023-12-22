<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProteinKriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'protein', 'nilai'
    ];

    public function perhitungans()
    {
        return $this->hasMany(Perhitungan::class, 'id_protein', 'id');
    }

    public function bobotKriteria()
    {
        return $this->hasOne(BobotKriteria::class, 'nama', 'protein');
    }

    public function fillTable()
    {
        $protein = [
            [
                'protein' => '25',
                'nilai' => '5'
            ],
            [
                'protein' => '20',
                'nilai' => '4'
            ],
            [
                'protein' => '18',
                'nilai' => '3'
            ],
            [
                'protein' => '12',
                'nilai' => '2'
            ],
            [
                'protein' => '<12',
                'nilai' => '1'
            ],
        ];
        return $protein;
    }
}
