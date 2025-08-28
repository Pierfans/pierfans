<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parceria extends Model
{
    protected $table = 'parcerias';

    protected $fillable = [
        'user_origin_id',
        'user_destiny_id',
        'active',
    ];

    public function userOrigin()
    {
        return $this->belongsTo(User::class, 'user_origin_id');
    }

    public function userDestiny()
    {
        return $this->belongsTo(User::class, 'user_destiny_id');
    }

    public function histories()
    {
        return $this->hasMany(ParceriaHistory::class, 'parceria_id');
    }
    public function mensajes()
    {
        return $this->hasMany(\App\Models\ParceriaHistory::class, 'parceria_id');
    }
}
