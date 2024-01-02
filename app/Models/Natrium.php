<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Natrium extends Model
{
    use HasFactory;
    protected $fillable = [
        'natrium', 'nilai'
    ];

    public function fillTable(){
        $natrium = [
            [
                'natrium' => '14',
                'nilai' => '5'
            ],[
                'natrium' => '13',
                'nilai' => '4'
            ],[
                'natrium' => '12',
                'nilai' => '3'
            ],[
                'natrium' => '11',
                'nilai' => '2'
            ],[
                'natrium' => '10',
                'nilai' => '1'
            ],
        ];
        return $natrium;
    }
}
