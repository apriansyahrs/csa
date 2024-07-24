<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionApproval extends Model
{
    use HasFactory;

    protected $fillable = [
        'submission_id', 'approval_type', 'approved_by', 'approved_at'
    ];

    public function submission()
    {
        return $this->belongsTo(Submission::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
