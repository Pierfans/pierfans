<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Updates;

class InitialPost extends Model
{
    protected $table = 'initial_posts';

    protected $fillable = [
        'update_id',
        'order',
    ];

    public function updateRelation()
    {
        return $this->belongsTo(Updates::class, 'update_id');
    }
}
