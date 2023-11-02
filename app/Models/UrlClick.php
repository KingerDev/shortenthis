<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

class UrlClick extends Model
{
    use HasFactory;

    protected $fillable = ['user_agent', 'type'];

    public function url(): BelongsTo
    {
        return $this->belongsTo(Url::class, 'url_id');
    }

    public function getDailyAverage($url_id)
    {
        $urlClicksDailyAverage = UrlClick::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as daily_count'))
            ->where('url_id', $url_id)
            ->groupBy('date')
            ->get();

        return $urlClicksDailyAverage->avg('daily_count');
    }

    public function getWeeklyAverage($url_id)
    {
        $urlClicksWeeklyAverage = UrlClick::select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('COUNT(*) as weekly_count'))
            ->where('url_id', $url_id)
            ->groupBy('year', 'week')
            ->get();

        return $urlClicksWeeklyAverage->avg('weekly_count');
    }

    public function getMonthlyAverage($url_id)
    {
        $urlClicksMonthlyAverage = UrlClick::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as monthly_count'))
            ->where('url_id', $url_id)
            ->groupBy('year', 'month')
            ->get();

        return $urlClicksMonthlyAverage->avg('monthly_count');
    }
}
