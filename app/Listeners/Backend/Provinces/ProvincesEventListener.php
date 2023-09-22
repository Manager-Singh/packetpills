<?php

namespace App\Listeners\Backend\Provinces;

/**
 * Class ProvincesEventListener.
 */
class ProvincesEventListener
{
    /**
     * @var string
     */
    private $history_slug = 'Provinces';

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        history()->withType($this->history_slug)
            ->withEntity($event->province->id)
            ->withText('trans("history.backend.provinces.created") <strong>'.$event->province->name.'</strong>')
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
            ->withEntity($event->province->id)
            ->withText('trans("history.backend.provinces.updated") <strong>'.$event->province->name.'</strong>')
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
            ->withEntity($event->provinces->id)
            ->withText('trans("history.backend.provinces.deleted") <strong>'.$event->province->name.'</strong>')
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
            \App\Events\Backend\Provinces\ProvincesCreated::class,
            'App\Listeners\Backend\Provinces\ProvincesEventListener@onCreated'
        );

        $events->listen(
            \App\Events\Backend\Provinces\ProvincesUpdated::class,
            'App\Listeners\Backend\Provinces\ProvincesEventListener@onUpdated'
        );

        $events->listen(
            \App\Events\Backend\Provinces\ProvincesDeleted::class,
            'App\Listeners\Backend\Provinces\ProvincesEventListener@onDeleted'
        );
    }
}
