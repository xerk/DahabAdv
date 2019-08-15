<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use App\Nova\Filters\DailyOrders;
use Illuminate\Support\Facades\DB;
use App\Nova\Filters\DailyOrdersLens;
use Laravel\Nova\Http\Requests\LensRequest;

class ClientsAccounts extends Lens
{

    /**
     * Get the displayable name of the lens.
     *
     * @return string
     */
    public function name()
    {
        return __('Clients Acctions');
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->select(self::columns())
                  ->leftjoin('payments', 'orders.id', '=', 'payments.order_id')
                  ->join('clients', 'clients.id', '=', 'orders.client_id')
                  ->orderBy('revenue', 'desc')
                  ->groupBy('orders.id')
        ));

    }

    /**
     * Get the columns that should be selected.
     *
     * @return array
     */
    protected static function columns()
    {
        return [
            'orders.name_file',
            'orders.id',
            'clients.name',
            'orders.received',
            'orders.total',
            'orders.created_at',
            DB::raw('sum(payments.pay) as revenue'),
            DB::raw('orders.total - sum(payments.pay) as remaining')
        ];
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('ID', 'id')->sortable(),
            Text::make(__('Name'), 'name'),
            Text::make(__('File Name'), 'name_file'),
            
            Number::make(__('Total Cost'), 'total'),
            
            Number::make(__('Revenue'), 'revenue'),
            Number::make(__('Total Remaining'), 'remaining', function ($value) {
                return number_format($value, 2) . ' ج.م';
            }),

            Boolean::make(__('Received'), 'received'),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new DailyOrdersLens,
        ];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'clients-accounts';
    }
}
