<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalamityReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'calamity', 'farmer_type', 'rsbsa_ref_number', 'crops_or_livestocks',
        'proof_images', 'remarks', 'partial_damage_area', 'totally_damage_area',
        'total_area', 'farm_type', 'animal_type', 'age_classification',
        'no_of_heads', 'surname', 'first_name', 'middle_name', 'extension_name',
        'birthdate', 'region', 'municipality', 'province', 'barangay', 'org_name',
        'male_count', 'female_count', 'sex', 'tribe_name', 'pwd', 'arb', 'four_ps',
        'user_id','status','assistance_type','report_status'
    ];

    protected $casts = [
        'proof_images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function assistanceHistories()
    {
        return $this->hasMany(AssistanceHistory::class, 'report_id');
    }

}
