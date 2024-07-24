<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
        'date',
        'total_cost',
        'status_po',
        'po_number',
        'status_client',
        'submission_category_id',
        'request_file_1',
        'request_file_2',
        'approved_file',
        'notes',
        'user_notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function submissionCategory()
    {
        return $this->belongsTo(SubmissionCategory::class);
    }

    public function approvals()
    {
        return $this->hasMany(SubmissionApproval::class);
    }

    public function details()
    {
        return $this->hasMany(SubmissionDetail::class);
    }

    // Accessor untuk mendapatkan status persetujuan
    public function getApprovalStatusAttribute()
    {
        $accountingApproval = $this->approvals->where('approval_type', 'ACCOUNTING')->first();
        $managerApproval = $this->approvals->where('approval_type', 'MANAGER')->first();
        $executorApproval = $this->approvals->where('approval_type', 'EXECUTOR')->first();

        if ($this->submission_category_id == 1) {
            return $accountingApproval && $accountingApproval->approved_by && !$executorApproval;
        }

        if ($this->submission_category_id == 3) {
            return $managerApproval && $managerApproval->approved_by && !$executorApproval;
        }

        if ($this->submission_category_id == 2) {
            return !$executorApproval && $this->status_client == 0;
        }

        return false;
    }
}
