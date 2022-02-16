<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Szalamik extends Model
{
    use HasFactory;

    protected $fillable =[
        "termeknev",
        "ar",
        "alapanyag",
        "gyartasi_ido"

    ];
}