<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class BusinessUnit extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'color',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

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

    public static function getColorRgb(string $color): string
    {
        $colors = [
            'brand-1' => 'rgb(255, 165, 0)', // Orange
            'brand-2' => 'rgb(0, 128, 0)',   // Emerald
            'brand-3' => 'rgb(0, 128, 128)', // Teal
            'brand-4' => 'rgb(0, 255, 255)', // Cyan
            'brand-5' => 'rgb(75, 0, 130)',  // Indigo
            'brand-6' => 'rgb(238, 130, 238)', // Violet
            'brand-7' => 'rgb(128, 0, 128)', // Purple
            'brand-8' => 'rgb(255, 0, 255)', // Fuchsia
            'brand-9' => 'rgb(255, 192, 203)', // Pink
            'brand-10' => 'rgb(255, 0, 0)', // Rose
        ];

        return $colors[$color] ?? 'rgb(0, 0, 0)';
    }
}
