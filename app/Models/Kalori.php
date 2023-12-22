<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalori extends Model
{
    use HasFactory;
    protected $fillable = [
        'kalori', 'nilai'
    ];

    public function fillTable()
    {
        $kal = [
            [
                'kalori' => '50',
                'nilai' => '5'
            ],
            [
                'kalori' => '40',
                'nilai' => '4'
            ],
            [
                'kalori' => '30',
                'nilai' => '3'
            ],[
                'kalori' => '20',
                'nilai' => '2'
            ],[
                'kalori' => '10',
                'nilai' => '1'
            ],
        ];
        return $kal;
    }
}
