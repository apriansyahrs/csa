<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id', 'item_id', 'qty_submission', 'qty_approved', 'description'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
