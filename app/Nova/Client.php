<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Panel;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;

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
    public static $title = 'full_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'client_contact_full_name',
        'client_contact_email'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->onlyOnForms()->sortable(),
            BelongsTo::make('User')->onlyOnForms()->rules('required'),
            Text::make('Client Name')->sortable()->rules('required', 'string'),
            Text::make('Client Address')->hideFromIndex()->rules('required', 'string'),
            Text::make('Client City')->hideFromIndex()->sortable()->rules('required', 'string'),
            Text::make('Client State')->hideFromIndex()->sortable()->rules('required', 'string'),
            Text::make('Client Zip')->hideFromIndex()->rules('required', 'string'),
            Select::make('Status', 'client_status')->options(\App\Client::getClientStatus())->sortable()->rules('required', 'string'),

            new Panel('Contact Information', $this->contactFields()),
            new Panel('Notes', $this->notesField()),
        ];
    }

    protected function contactFields()
    {
        return [
            Text::make('Contact First Name', 'client_contact_first_name')->onlyOnForms()->rules('required', 'string'),
            Text::make('Contact Last Name', 'client_contact_last_name')->onlyOnForms()->rules('required', 'string'),
            Text::make('Contact Name', 'client_contact_full_name')->exceptOnForms()->sortable(),
            Text::make('Contact Phone', 'client_contact_phone')->rules('required', 'string'),
            Text::make('Contact Email', 'client_contact_email')->rules('required', 'email'),
        ];
    }

    protected function notesField()
    {
        return [
            Textarea::make('Client Notes')->hideFromIndex(),
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
        return [];
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
            new Filters\ClientStatus,
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
