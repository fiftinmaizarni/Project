<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

class AdminActivityModel extends Model
{
    protected $table      = 'admin_activity';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'admin_id',
        'action',       // ✔ sesuai kolom database
        'module',
        'target_id',
        'description',
        'created_at'
    ];

    protected $useTimestamps = false;

    /**
     * Simpan log aktivitas admin
     */
    public function log(
        int $adminId,
        string $action,
        ?string $module = null,
        ?int $targetId = null,
        ?string $description = null
    ) {
        return $this->insert([
            'admin_id'    => $adminId,
            'action'      => $action,
            'module'      => $module,
            'target_id'   => $targetId,
            'description' => $description,
            'created_at'  => Time::now()->toDateTimeString(),
        ]);
    }

    /**
     * Ambil statistik aktivitas mingguan (4 minggu)
     */
    public function getWeeklyActivity(int $month, int $year): array
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
