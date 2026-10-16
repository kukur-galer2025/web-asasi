<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'masa_berlaku_sampai' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}