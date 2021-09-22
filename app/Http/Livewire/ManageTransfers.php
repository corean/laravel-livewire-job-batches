<?php

namespace App\Http\Livewire;

use Livewire\Component;
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
    }

    public function render()
    {
        return view('livewire.manage-transfers');
    }
}
