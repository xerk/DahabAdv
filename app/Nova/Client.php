<?php

namespace App\Nova;

use App\Nova\Order;
use App\Nova\Payment;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\MorphMany;
use App\Nova\Lenses\ClientsAccounts;
use Laravel\Nova\Http\Requests\NovaRequest;

class Client extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Client';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->name;
    }

    /**
     * Get the search result subtitle for the resource.
     *
     * @return string
     */
    public function subtitle()
    {
        return $this->phone;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'email',
        'phone',
    ];

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Clients');
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Client');
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
            ID::make()->sortable(),
            
            Gravatar::make('Avatar', 'email'),

            Text::make(__('Name'), 'name')->sortable()
                ->rules('required'),

            Text::make(__('Email'), 'email')->sortable(),
                // ->rules('email', 'max:50')
                // ->creationRules('unique:clients,email')
                // ->updateRules('unique:clients,email,{{resourceId}}'),

            Text::make(__('Company'), 'company')->sortable(),

            Text::make(__('Phone'), 'phone')
                ->rules('max:12')
                ->creationRules('unique:clients,phone')
                ->updateRules('unique:clients,phone,{{resourceId}}'),

            Place::make(__('Address'), 'address')->hideFromIndex(),
            
            HasMany::make(__('Orders'), 'orders', Order::class),
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
            (new Metrics\NewClient)->width('1/2'),
            (new Metrics\TotalRevenue)->width('1/2'),
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
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
