<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    protected $fillable = ['doctor_id', 'patient_id', 'service_id',  'occlusion', 'periodontal_condition', 'oral_hygiene', 'denture_upper', 'denture_lower', 'denture_upper_since', 'denture_lower_since', 'abnormalities', 'general_condition', 'physician', 'nature_of_treatment', 'allergies', 'previous_history_bleeding', 'chronic_ailment', 'blood_pressure', 'drugs_taken'];

    public function isOneDay()
    {
        return ($this->created_at->timestamp - time()) > 8600;
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function teeths()
    {
        return $this->hasMany(ExaminationToothChart::class);
    }

    public function payments()
    {
        return $this->hasOne(Payment::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }
}
