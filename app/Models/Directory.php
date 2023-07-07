<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Directory extends Model
{
    use HasFactory, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | goblan variables
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        "user_id",
        'nombre',
        'surname',
        'especialidad',
        'universidad',
        'ano',
        'org',
        'website',
        'email',
        'direccion',
        'direccion1',
        'estado',
        'ciudad',
        'telefonos',
        'tel1',
        'telhome',
        'telmovil',
        'telprincipal',
        'facebook',
        'instagram',
        'twitter',
        'linkedin',
        'image',
        'vcard',
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

    public function scopeForMember(Builder $builder)
    {
        return $builder
            ->where("user_id", auth()->id())
            ->get();
    }

    public function scopeForPublic(Builder $builder)
    {
        $builder->where("status", Directory::PUBLISHED);
        return $builder->get();
    }

    protected static function boot(){

        parent::boot();

        if (!app()->runningInConsole()) {
            self::creating(function ($table) {
                $table->user_id = auth()->id();
            });
        }
    }

    public function imagePath()
    {
        return sprintf('%s/%s', '/storage/directories', $this->image);
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function user(){
        return $this->belongsTo(User::class);
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
        return self::where('nombre', 'like', "%$query%")
        ->orWhere('email', 'like', "%$query%")
        ->orWhere('surname', 'like', "%$query%")
        ->get();
    }
}
