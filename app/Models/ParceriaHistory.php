<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParceriaHistory extends Model
{
    protected $table = 'parceria_histories';

    protected $fillable = [
        'parceria_id',
        'text',
        'sender_id',
    ];

    public function parceria()
    {
        return $this->belongsTo(Parceria::class, 'parceria_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
