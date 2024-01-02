<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usia extends Model
{
    use HasFactory;
    protected $fillable = [
        'usia', 'nilai'
    ];

    public function fillTable(){
        $usia = [
            [
                'usia' => '>40',
                'nilai' => '5'
            ],[
                'usia' => '30-40',
                'nilai' => '4'
            ],[
                'usia' => '20-30',
                'nilai' => '3'
            ],[
                'usia' => '10-20',
                'nilai' => '2'
            ],[
                'usia' => '6-10',
                'nilai' => '1'
            ],
        ];
        return $usia;
    }
}
