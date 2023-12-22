<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karbohidrat extends Model
{
    use HasFactory;
    protected $fillable = [
        'karbohidrat', 'nilai'
    ];

    public function fillTable()
    {
        $karbo = [
            [
                'karbohidrat' => '30',
                'nilai' => '5'
            ],
            [
                'karbohidrat' => '25',
                'nilai' => '4'
            ],
            [
                'karbohidrat' => '20',
                'nilai' => '3'
            ],
            [
                'karbohidrat' => '15',
                'nilai' => '2'
            ],
            [
                'karbohidrat' => '13',
                'nilai' => '1'
            ],

        ];
        return $karbo;
    }
}
