<?php

namespace App\Models;

use App\Jobs\NewCurrencyRegisterJob;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory, SoftDeletes;

     /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'name',
        'product_id'
    ];

     /*
    |--------------------------------------------------------------------------
    | functions
    |--------------------------------------------------------------------------
    */

    protected static function boot(){

        parent::boot();

        static::created(function($currency){

            NewCurrencyRegisterJob::dispatch(
                $currency
            )->onQueue("high");
        });

    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
