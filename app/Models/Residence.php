<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Residence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'userId',
        'address',
        'city',
        'postalCode',
        'country',
    ];
}
