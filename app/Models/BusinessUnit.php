<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'color',
    ];

    public const COLORS = [
        'brand-1' => 'brand-1',
        'brand-2' => 'brand-2',
        'brand-3' => 'brand-3',
        'brand-4' => 'brand-4',
        'brand-5' => 'brand-5',
        'brand-6' => 'brand-6',
        'brand-7' => 'brand-7',
        'brand-8' => 'brand-8',
        'brand-9' => 'brand-9',
        'brand-10' => 'brand-10',
    ];
}
