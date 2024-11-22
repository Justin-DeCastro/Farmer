<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalamityReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'reporter_name',
        'email',
        'location',
        'description',
        'status',
        'image',
    ];
}
