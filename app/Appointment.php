<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['service_id', 'doctor_id', 'start_date', 'end_date', 'status'];

    public $timestamps = false;

    public $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public $appends = [
        'start',
        'end',
    ];

    public function patients()
    {
        return $this->belongsToMany('App\Patient', 'patient_appointment', 'appointment_id', 'patient_id')->withTimestamps();
    }

    public function getStartAttribute()
    {
        return Carbon::parse($this->start_date)->format('F d, Y h:i A');
    }

    public function getEndAttribute()
    {
        return Carbon::parse($this->end_date)->format('F d, Y h:i A');
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Doctor');
    }
}
