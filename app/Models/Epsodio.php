<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epsodio extends Model
{
    protected $table = 'epsodios';

    protected $fillable = [
        'name_ep',
        'name_foto',
        'name_audio',
    ]; 
}
