<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;
        
    protected $fillable = [
        'title',
        'description',
        'salary',
        'location',
        'category',
        'experience',
        'status',
        'work_modes',
        'company_name',
        'expires_at',
        'views',
        'applications',
    ];

    protected $casts = [
        'salary' => 'integer',
        'experience' => 'string'
    ];

    public static array $categories = [
        'general', 
        'it', 
        'hr', 
        'finance', 
        'marketing'
    ];
    public static array $work_modes = [
        'remote', 
        'onsite', 
        'hybrid'
    ];

    public static array $experience = [
        'entry', 
        'intermediate', 
        'senior'
    ];
    public static array $status = [
        'open', 
        'closed'
    ];
}
