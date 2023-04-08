<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CloseDay extends Model
{
    public const MAX_HOURS_PER_DAY = 8;

    protected $fillable = ['start', 'end', 'all_day'];

    public $dates = ['start', 'end'];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    public $appends = [
        'schedule',
        'close_for',
        'date_start_string',
        'date_end_string',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function (CloseDay $close) {
            $close->all_day = $close->isAllDay($close->start, $close->end);

            return true;
        });

        self::updating(function (CloseDay $close) {
            $close->all_day = $close->isAllDay($close->start, $close->end);

            return true;
        });
    }

    public function isAllDay(Carbon $start, Carbon $end)
    {
        return ($end->diffInHours($start) - 1) >= self::MAX_HOURS_PER_DAY ? 1 : 0;
    }

    public static function allDay()
    {
        return self::where(['all_day' => 1])
            ->whereYear('start', date('Y'))
            ->get(['start']);
    }

    public static function getBy($month, $day)
    {
        return self::whereYear('start', date('Y'))
            ->whereMonth('start', $month)
            ->whereDay('start', $day)
            ->get(['start', 'end']);
    }

    public static function byTime($month, $day)
    {
        return self::where(['all_day' => 0])
            ->whereYear('start', date('Y'))
            ->whereMonth('start', $month)
            ->whereDay('start', $day)
            ->get(['start', 'end']);
    }

    public function getScheduleAttribute()
    {
        return $this->start->format('F Y jS g:i A').' to '.$this->end->format('F Y jS g:i A');
    }

    public function getCloseForAttribute()
    {
        return $this->start->diffInHours($this->end);
    }

    public function getDateStartStringAttribute()
    {
        return $this->start->format('Y-m-d');
    }

    public function getDateEndStringAttribute()
    {
        return $this->end->format('Y-m-d');
    }
}
