<?php

namespace App\Listeners\Backend\PreciptionTypes;

/**
 * Class PreciptionTypesEventListener.
 */
class PreciptionTypesEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'PreciptionTypes';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->preciption_type->id)
            ->withText('trans("history.backend.preciption-types.created") <strong>'.$event->preciption_type->title.'</strong>')
            ->withIcon('plus')
            ->withClass('bg-green')
            ->log();
    }

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->preciptionType->id)
            ->withText('trans("history.backend.preciption-types.updated") <strong>'.$event->preciptionType->preciption_type.'</strong>')
            ->withIcon('save')
            ->withClass('bg-aqua')
            ->log();
    }

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->preciptionType->id)
            ->withText('trans("history.backend.preciption-types.deleted") <strong>'.$event->preciptionType->preciption_type.'</strong>')
            ->withIcon('trash')
            ->withClass('bg-maroon')
            ->log();
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            \App\Events\Backend\PreciptionTypes\PreciptionTypesCreated::class,
            'App\Listeners\Backend\PreciptionTypes\PreciptionTypesEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\PreciptionTypes\PreciptionTypesUpdated::class,
            'App\Listeners\Backend\PreciptionTypes\PreciptionTypesEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\PreciptionTypes\PreciptionTypesDeleted::class,
            'App\Listeners\Backend\PreciptionTypes\PreciptionTypesEventListener@onDeleted'
        );
    }
}
