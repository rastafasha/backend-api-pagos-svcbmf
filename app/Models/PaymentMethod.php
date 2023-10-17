<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name', 
        'image',
    ];

}
