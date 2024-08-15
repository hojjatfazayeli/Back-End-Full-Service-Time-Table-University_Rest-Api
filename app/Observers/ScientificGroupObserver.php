<?php

namespace App\Observers;

use App\Models\ScientificGroup;
use Illuminate\Support\Facades\Auth;

class ScientificGroupObserver
{
    public function creating(ScientificGroup $scientificGroup):void
    {
        $scientificGroup->uuid = \Webpatser\Uuid\Uuid::generate()->string;
        $scientificGroup->admin_id = Auth::user()->id;
    }
    /**
     * Handle the ScientificGroup "created" event.
     */
    public function created(ScientificGroup $scientificGroup): void
    {
        //
    }

    /**
     * Handle the ScientificGroup "updated" event.
     */
    public function updated(ScientificGroup $scientificGroup): void
    {
        //
    }

    /**
     * Handle the ScientificGroup "deleted" event.
     */
    public function deleted(ScientificGroup $scientificGroup): void
    {
        //
    }

    /**
     * Handle the ScientificGroup "restored" event.
     */
    public function restored(ScientificGroup $scientificGroup): void
    {
        //
    }

    /**
     * Handle the ScientificGroup "force deleted" event.
     */
    public function forceDeleted(ScientificGroup $scientificGroup): void
    {
        //
    }
}
