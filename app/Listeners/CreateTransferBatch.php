<?php

namespace App\Listeners;

use App\Events\LocalTransferCreated;
use App\Events\TransferCompleted;
use App\Jobs\TransferLocalFileToCloud;
use Bus;
use Illuminate\Bus\Batch;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Throwable;

class CreateTransferBatch
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LocalTransferCreated  $event
     * @return void
     */
    public function handle(LocalTransferCreated $event): void
    {
        $transfer = $event->getTransfer();
        $jobs = $transfer->files->mapInto(TransferLocalFileToCloud::class);

        $batch = Bus::batch($jobs)
            ->finally(function () use ($transfer) {
                TransferCompleted::dispatch($transfer);
            })->dispatch();

        $transfer->update([
            'batch_id' => $batch->id,
        ]);
    }
}
