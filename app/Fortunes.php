<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fortunes extends Model
{
    protected $table = 'fortunes';
    protected $fillable = [
        'constellation',
        'date',
        'overall_fortune_score',
        'overall_fortune_description',
        'love_fortune_score',
        'love_fortune_description',
        'career_fortune_score',
        'career_fortune_description',
        'wealth_fortune_score',
        'wealth_fortune_description'
];
}
