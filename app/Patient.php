<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Patient extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_number', 'firstname', 'middlename', 'lastname', 'username', 'password', 'mobile_no', 'profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function (Patient $patient) {
            $patientCount = Patient::count();
            $patientCount += 1;
            $patientNumber = 'PN-'.date('Y').'-'.str_pad($patientCount, 4, '0', STR_PAD_LEFT);
            $patient->patient_number = $patientNumber;

            return true;
        });
    }

    public function setPasswordAttribute($value)
    {
        return $this->attributes['password'] = bcrypt($value);
    }

    public function appointments()
    {
        return $this->belongsToMany(Appointment::class, 'patient_appointment', 'patient_id', 'appointment_id')->withTimestamps();
    }

    public function info()
    {
        return $this->hasOne(PatientInformation::class);
    }

    public function examinations()
    {
        return $this->hasMany(Examination::class);
    }

    public static function getAppointments(int $patientId)
    {
        return Patient::with(['appointments' => function ($query) {
            $query->whereDay('start_date', '>=', date('d'))
                ->whereYear('start_date', date('Y'))
                ->whereMonth('start_date', '>=', date('m'))
                ->where('status', '!=', 'cancelled');
            // ->whereTime('start_date', '<=', date('H:i:s'))
            // ->whereTime('end_date', '>=', date('H:i:s'));
        }, 'appointments.service', 'appointments.doctor'])->find($patientId);
    }
}
