<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubmissionCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id'
    ];

    public function division (): BelongsTo
    {
       return $this->belongsTo(Division::class);
    }

}