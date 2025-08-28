<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Highlight extends Model
{
    protected $fillable = [
        'user_id',
        'order',
        'active'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function getActiveHighlights()
    {

        $highlights = self::with('user')
            ->where('active', true)
            ->orderBy('order')
            ->limit(5)
            ->get()
            ->map(function($highlight) {
                if ($highlight->user) {
                    return [
                        'avatar' => $highlight->user->avatar,
                        'username' => $highlight->user->username
                    ];
                } 
                return null;
            })
            ->filter()
            ->values();

        if ($highlights->isEmpty()) {
            return collect([
                [
                    'avatar' => 'public/img/highlights/creators/',
                    'username' => 'jujuferrari',
                ],
                [
                    'avatar' => 'public/img/highlights/creators/2.jpg',
                    'username' => 'anasantos',
                ],
                [
                    'avatar' => 'public/img/highlights/creators/3.jpg',
                    'username' => 'mariasantos',
                ],
                [
                    'avatar' => 'public/img/highlights/creators/4.jpg',
                    'username' => 'andressaalves',
                ],
                [
                    'avatar' => 'public/img/highlights/creators/5.jpg',
                    'username' => 'aninhapereira',
                ],
            ]);
        }

        return $highlights;
    }
}
