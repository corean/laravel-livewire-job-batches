<?php

namespace App\Http\Livewire;

use App\Models\TransferFile;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ManageTransfers extends Component
{
    use WithFileUploads;

    public $pendingFiles = [];

    public function initiateTransfer()
    {
        $this->validate([
            'pendingFiles.*' => ['image', 'max:5120'],
        ]);

        // This code will not execute if the validation fails
        $transfer = auth()->user()->transfers()->create();
        $transfer->files()->saveMany(
            collect($this->pendingFiles)
                ->map(function (TemporaryUploadedFile $pendingFile) {
                    return new TransferFile([
                        'disk' => $pendingFile->disk,
                        'path' => $pendingFile->getRealPath(),
                        'size' => $pendingFile->getSize(),
                    ]);
                })
        );
        $this->pendingFiles = [];

        LocalTransferCreated::dispatch($transfer);
    }

    public function render()
    {
        return view('livewire.manage-transfers');
    }
}
