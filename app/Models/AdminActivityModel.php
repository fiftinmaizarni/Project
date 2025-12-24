<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class AdminActivityModel extends Model
{
    protected $table = 'admin_activity';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'admin_id',
        'activity',
        'module',
        'target_id',
        'description',
        'created_at'
    ];

    public function log($adminId, $activity, $module = null, $targetId = null, $description = null)
    {
        return $this->insert([
            'admin_id'   => $adminId,
            'activity'   => $activity,
            'module'     => $module,
            'target_id'  => $targetId,
            'description'=> $description,
            'created_at' => Time::now()->toDateTimeString(),
        ]);
    }

    public function getWeeklyActivity($month, $year)
    {
        $result = [];
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for ($week = 1; $week <= 4; $week++) {
            $startDay = ($week - 1) * 7 + 1;
            $endDay   = min($week * 7, $daysInMonth);

            $startDate = Time::create($year, $month, $startDay, 0, 0, 0)->toDateTimeString();
            $endDate   = Time::create($year, $month, $endDay, 23, 59, 59)->toDateTimeString();

            $count = $this->where('created_at >=', $startDate)
                          ->where('created_at <=', $endDate)
                          ->countAllResults();

            $result[] = [
                'week'  => $week,
                'count' => $count
            ];
        }

        return $result;
    }
}
