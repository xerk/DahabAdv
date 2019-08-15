<?php

namespace App\Nova;

use App\Nova\User;
use App\Nova\Order;
use App\Nova\Client;
use App\Nova\Payment;
use App\Nova\Material;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\PrintedAction;
use App\Nova\Actions\ReceivedAction;
use Vyuldashev\NovaMoneyField\Money;
use Laravel\Nova\Http\Requests\NovaRequest;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Order';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->name_file;
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function subtitle()
    {
        return $this->client->name;
    }

    public static $with = ['client'];

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name_file',
    ];


    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Orders');
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Order');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()->hideFromIndex(),

            BelongsTo::make(__('Client'), 'client', Client::class)->searchable(),

            BelongsTo::make(__('Material'), 'material', Material::class),

            Text::make(__('File Name'),'name_file'),

            Select::make(__('Print Type'), 'print_type')->options([
                '1' => 'Outdoor',
                '2' => 'Indoor',
                '3' => 'Digital',
            ])->displayUsingLabels()->hideFromIndex()
                ->rules('required'),

            Number::make(__('Width'), 'width')
                ->rules('max:10'),

            Number::make(__('Height'), 'height')
                ->rules('max:10'),

            Number::make(__('Amount'), 'amount')
                ->rules('required', 'max:10'),

            Money::make(__('Price Unit'),'EGP', 'price_unit')
                ->rules('required')->hideFromIndex(),

            File::make(__('Image or File'), 'file'),

            Boolean::make(__('Printed'), 'printed'),

            Boolean::make(__('Received'), 'received'),

            BelongsTo::make(__('Designer'), 'user', User::class),

            Text::make(__('Total'), 'total')->hideWhenCreating()->hideWhenUpdating(),
            
            HasMany::make(__('Payments'), 'payments', Payment::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new Metrics\TotalCosts)->width('1/2'),
            (new Metrics\NewOrder)->width('1/2'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\DailyOrders,
            new Filters\Printed,
            new Filters\Received,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new Lenses\ClientsAccounts
        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new PrintedAction,
            new ReceivedAction,
        ];
    }
}
