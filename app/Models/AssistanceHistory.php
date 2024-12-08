<?php

// app/Models/AssistanceHistory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistanceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'assistance_type',
        'date_provided',
        'remarks',
    ];

    // Relationship with CalamityReport
    public function calamityReport()
    {
        return $this->belongsTo(CalamityReport::class, 'report_id');
    }
}

