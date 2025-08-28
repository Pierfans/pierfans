<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [
        'updates_id',
        'user_id',
        'type',
        'image',
        'width',
        'height',
        'video',
        'video_poster',
        'video_embed',
        'music',
        'file',
        'file_name',
        'file_size',
        'bytes',
        'mime',
        'img_type',
        'token',
        'status',
        'created_at'
    ];
    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        if ($this->image) {
            return asset('files/storage/' . $this->updates_id . '/' . $this->image);
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updates()
    {
        return $this->belongsTo(Updates::class);
    }
}
