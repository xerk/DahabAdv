<?php

namespace App\Nova\Actions;

use App\Mail\PrintedMail;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PrintedAction extends Action 
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Printed Action');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            if ($model->printed == 0) {
                Mail::to($model->client)->send(new PrintedMail($model));
                $model->printed = 1;
                $model->save();
            } else {
                $model->printed = 0;
                $model->save();;
            }
        }
        sleep(5);
        return Action::message('Order has been updated');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
