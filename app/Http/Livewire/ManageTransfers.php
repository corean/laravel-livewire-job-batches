<?php

namespace App\Http\Livewire;

use App\Events\LocalTransferCreated;
use App\Models\TransferFile;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class ManageTransfers extends Component
{
    use WithFileUploads;

    public $pendingFiles = [];

    public function getListeners()
    {
        $userId = auth()->id();

        return [
            "echo-private:notifications.{$userId},FileTransferredToCloud" => '$refresh',
            "echo-private:notifications.{$userId},TransferCompleted" => 'fireConfettiCannon',
        ];
    }

    public function fireConfettiCannon()
    {
        $this->emit('confetti');
    }

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
        return view('livewire.manage-transfers', [
            // 'transfers' => auth()->user()->transfers()->with('jobBatch', 'files')->get(),
            'transfers' => auth()->user()->transfers()->with('jobBatch')
                ->withSum('files', 'size')->get(),
        ]);
    }
}
