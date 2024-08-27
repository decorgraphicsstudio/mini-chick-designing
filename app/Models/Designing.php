<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designing extends Model
{
    use HasFactory;

    protected $table = 'designing';

    protected $fillable = [
        'lot_num',
        'des_name',
        'des_img',
        'papers',
        'rate',
        'amount',
    ];
}
