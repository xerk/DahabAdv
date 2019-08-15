<?php

namespace App\Nova\Metrics;

use App\Order;
use App\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;
use Illuminate\Support\Facades\DB;

class TotalRemaining extends Value
{

    /**
     * Get the displayable name of the metric.
     *
     * @return string
     */
    public function name()
    {
        return __('Total Remaining');
    }

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function calculate(Request $request)
    {
        $remaining = Order::where('created_at', '>', Carbon::now()->subDays($request->range))->sum(DB::raw('round((price_unit * amount * width * height) / 10000)')) - Payment::where('created_at', '>', Carbon::now()->subDays($request->range))->sum('pay');
        return [
            'previous' => 0 ,
            'previousLabel' => null,
            'prefix' => "$",
            'suffix' => null,
            'value' => $remaining,
        ];
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            1 => __('Today'),
            2 => __('2 Days'),
            7 => __('7 Days'),
            30 => __('30 Days'),
            60 => __('60 Days'),
            'MTD' => __('Month To Date'),
            'QTD' => __('Quarter To Date'),
            'YTD' => __('Year To Date'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'total-remaining';
    }
}
