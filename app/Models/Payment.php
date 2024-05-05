<?php

namespace App\Models;

use App\Jobs\PaymentRegisterJob;
use App\Mail\NewPaymentRegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */
    protected $fillable = [

        'referencia',
        'metodo',
        'bank_name',
        'monto',
        'validacion',
        'currency_id',
        'nombre',
        'email',
        'user_id',
        'plan_id',
        'image',
        'status'
    ];

    const APPROVED = 'APPROVED';
    const PENDING = 'PENDING';
    const REJECTED = 'REJECTED';

    /*
    |--------------------------------------------------------------------------
    | functions
    |--------------------------------------------------------------------------
    */

    protected static function boot(){

        parent::boot();

        static::created(function($payment){

            // PaymentRegisterJob::dispatch(
            //     $user
            // )->onQueue("high");

        Mail::to('soporte@svcbmf.org')->send(new NewPaymentRegisterMail($payment));

        });


    }

    public static function statusTypes()
    {
        return [
            self::APPROVED, self::PENDING, self::REJECTED
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function currencies()
    {
        return $this->hasMany(Currency::class, 'currency_id');
    }

    public function plans()
    {
        return $this->hasMany(Plan::class, 'plan_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Search
    |--------------------------------------------------------------------------
    */

    public static function search($query = ''){
        if(!$query){
            return self::all();
        }
        return self::where('referencia', 'like', "%$query%")
        ->orWhere('monto', 'like', "%$query%")
        ->orWhere('metodo', 'like', "%$query%")
        ->orWhere('email', 'like', "%$query%")
        ->orWhere('nombre', 'like', "%$query%")
        ->get();
    }
}
