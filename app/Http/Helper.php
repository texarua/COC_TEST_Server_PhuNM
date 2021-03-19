<?php // Code within app\Helpers\Helper.php

namespace App\Http;

use App\Models\Duration;
use App\Models\StartTime;
use App\Enums\DurationEnum;
use App\Models\LearningHour;
use Carbon\Carbon;

class Helper
{
    public static function calculateDurationTime($param)
    {
        $duration = Duration::where('id', $param['duration'])->first();
        $start_time = StartTime::where('id', $param['start_time'])->first();
        $learning_hour = LearningHour::where('id', $param['learning_hour'])->first();
        $temp_learning = explode(':', $learning_hour['time']);
        $end_date_time = null;
        switch ($duration['type']) {
            case DurationEnum::getValue('MINUTE'):
                $end_date_time = Carbon::parse($param['start_date'] . ' ' . $start_time['time'])
                            ->addMinutes($duration['time'] + $temp_learning[0] * 60 + $temp_learning[1]);
                break;
            case DurationEnum::getValue('HOUR'):
                $end_date_time = Carbon::parse($param['start_date'] . ' ' . $start_time['time'])
                            ->addMinutes($duration['time'] * 60 + $temp_learning[0] * 60 + $temp_learning[1]);
                break;
            case DurationEnum::getValue('MONTH'):
                $end_date_time = Carbon::parse($param['start_date'] . ' ' . $start_time['time'])
                            ->addMonths($duration['time'])
                            ->addMinutes($temp_learning[0] * 60 + $temp_learning[1]);
                break;
            case DurationEnum::getValue('YEAR'):
                $end_date_time = Carbon::parse($param['start_date'] . ' ' . $start_time['time'])
                            ->addYears($duration['time'])
                            ->addMinutes($temp_learning[0] * 60 + $temp_learning[1]);
                break;
            
            default:
                return [];
                break;
        }

        return [
            'end_date' => $end_date_time->format('Y/m/d'),
            'end_time' => $end_date_time->format('H:i')
        ];
    }
}