<?php

namespace App\Http\Repositories;

use App\Appointment;
use App\CloseDay;
use Carbon\Carbon;

final class AppointmentRepository
{
    public const MAX_HOURS_OF_APPOINTMENT = 6;

    public function availables($date, $duration, $appointments)
    {
        [$month, $day, $year] = explode('-', $date);

        $date = Carbon::parse($year.$month.$day.'08:00');
        $morning = $this->generateTimePeriod($date, $duration, 'morning');

        $date = Carbon::parse($year.$month.$day.'13:00');
        $afternoon = $this->generateTimePeriod($date, $duration, 'afternoon');

        $timePeriods = $this->getAvailables(array_merge($morning, $afternoon), $appointments);

        return array_values(array_unique($this->filterByTimeClose($timePeriods, $month, $day)));
    }

    /**
     * Filters the given time periods based on the close day information for the given month and day.
     *
     * @param  array  $timePeriods An array of time periods in the format "start_date|end_date".
     * @param  int  $month       The month (1-12) for which to check the close day information.
     * @param  int  $day         The day of the month (1-31) for which to check the close day information.
     * @return array An array of time periods that are open during the close time for the given month and day.
     */
    private function filterByTimeClose(array $timePeriods, int $month, int $day): array
    {
        $timeClose = CloseDay::getBy($month, $day);

        $filteredPeriods = array_filter($timePeriods, function ($result) use ($timeClose) {
            [$startDate, $endDate] = explode('|', $result);
            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);

            return $this->isPeriodOpenDuringCloseTime($start, $end, $timeClose);
        });

        return array_values($filteredPeriods);
    }

    private function isPeriodOpenDuringCloseTime($start, $end, $timeClose)
    {
        foreach ($timeClose as $time) {
            if ($start->between($time->start, $time->end) && $end->between($time->start, $time->end)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns the available time periods by comparing with the appointments.
     *
     * @param  array  $results An array of time periods in "Y-m-d H:00|Y-m-d H:00" format
     * @param  array  $appointments An array of appointments
     * @return array An array of available time periods
     */
    private function getAvailables(array $results, $appointments): array
    {
        $exists = [];

        foreach ($results as $result) {
            [$createdStart, $createdEnd] = explode('|', $result);
            $startGenerated = Carbon::parse($createdStart);
            $endGenerated = Carbon::parse($createdEnd);

            foreach ($appointments as $appointment) {
                $start = Carbon::parse($appointment->start_date);
                $end = Carbon::parse($appointment->end_date);

                if (
                    $startGenerated->between($start, $end) && $endGenerated->between($start, $end)
                    || $start->between($startGenerated, $endGenerated) && $end->between($startGenerated, $endGenerated)
                ) {
                    $exists[] = $startGenerated.'|'.$endGenerated.'|exists';
                    $index = array_search($result, $results);
                    unset($results[$index]);
                }
            }
        }

        return array_values(array_merge($results, $exists));
    }

    /**
     * Generate time periods based on given date and increment, limited by max hours of appointment.
     *
     * @param  Carbon  $date The starting date for generating time periods.
     * @param  int  $increment The time increment in hours for each time period.
     * @param  string  $greet The greeting string, either "morning" or "afternoon".
     * @return array An array of time periods in the format of "Y-m-d H:i|Y-m-d H:i".
     */
    private function generateTimePeriod(Carbon $date, int $increment, string $greet): array
    {
        $results = [];
        // $end = ($greet === 'morning') ? 13 : 20;
        $noOfIteration = (int) floor(self::MAX_HOURS_OF_APPOINTMENT / $increment);

        $index = 1;
        while ($index <= $noOfIteration) {
            $startTime = $date->format('H:00');
            $endTime = $date->addHour($increment)->format('H:00');
            // if ($endTime >= $end) {
            //     break;
            // }
            $results[] = $date->format('Y-m-d ').$startTime.'|'.$date->format('Y-m-d ').$endTime;
            $index++;
        }

        return $results;
    }
}
