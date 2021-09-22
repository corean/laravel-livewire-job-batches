<?php

namespace App\Jobs;

use App\Events\FileTransferedToCloud;
use App\Models\TransferFile;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Log;
use Storage;

class TransferLocalFileToCloud implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    private $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(TransferFile $file)
    {
        $this->file = $file;
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info($localPath = $this->file->path);
        sleep(5);
        Storage::delete(explode('/app/', $localPath)[1]);

        FileTransferedToCloud::dispatch($this->file);
    }
}
