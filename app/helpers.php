<?php

use App\Models\Doctor;

if(!function_exists('isDoctorActive'))
{
    function isDoctorActive($email) : bool
    {   
        $doctor = Doctor::whereEmail($email)->IsActive()->exists();

        if($doctor)
        {
            return true;
        }
        return false;
    }
}

function differenceBetweenTwoDate($date1, $date2) : int
{
    $ts1 = strtotime($date1);
    $ts2 = strtotime($date2);

    $year1 = date('Y', $ts1);
    $year2 = date('Y', $ts2);

    $month1 = date('m', $ts1);
    $month2 = date('m', $ts2);

    $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

    return $diff;
}
