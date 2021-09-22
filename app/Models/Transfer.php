<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'batch_id',
    ];

    public function jobBatch(): BelongsTo
    {
        return $this->belongsTo(JobBatch::class, 'batch_id');
    }

    public function files() : HasMany
    {
        return $this->hasMany(TransferFile::class);
    }
}
