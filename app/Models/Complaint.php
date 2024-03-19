<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'complainant_id',
        'suspect_id',
        'status',
        'police_in_charge_id',
        'evidence',
    ];

    protected $casts = [
        'evidence' => 'json',
    ];

    public function complainant()
    {
        return $this->belongsTo(Complainant::class);
    }

    public function suspect()
    {
        return $this->belongsTo(Suspect::class);
    }

    public function policeInCharge()
    {
        return $this->belongsTo(User::class, 'police_in_charge_id');
    }
}
