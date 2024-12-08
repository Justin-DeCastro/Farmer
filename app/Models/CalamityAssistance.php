<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalamityAssistance extends Model
{
    use HasFactory;

    protected $fillable = ['assistance_title', 'assistance_date', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
