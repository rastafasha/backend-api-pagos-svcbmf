<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plan extends Model
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */
    protected $fillable = [
        'name',
        'price',
        'currency_id',
        'image',
        'status',
    ];


    const PUBLISHED = 'PUBLISHED';
    const PENDING = 'PENDING';
    const REJECTED = 'REJECTED';

    /*
    |--------------------------------------------------------------------------
    | functions
    |--------------------------------------------------------------------------
    */
    public function imagePath()
    {
        return sprintf('%s/%s', '/storage/plans', $this->image);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function payment(){
        return $this->belongsTo(Payment::class, 'producto_id');
    }
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function currency() {
        return $this->hasOne(Currency::class);
    }


}
