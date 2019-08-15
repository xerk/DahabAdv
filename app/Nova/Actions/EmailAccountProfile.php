<?php

namespace App\Nova\Actions;

use App\User;
use App\Mail\WelcomeMail;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAccountProfile extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The name of the queue the job should be sent to.
     *
     * @var string|null
     */

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
            Mail::to($model)->send(new WelcomeMail);
        }
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
