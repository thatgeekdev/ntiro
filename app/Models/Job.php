<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        //to improve
        // 'status',
        // 'work_modes',
        // 'company_name',
        // 'expires_at',
        // 'views',
        // 'applications',
    ];

    protected $casts = [
        'salary' => 'integer',
        'experience' => 'string'
    ];

    public static array $category = [
        'General', 
        'IT', 
        'HR', 
        'Finance', 
        'Marketing'
    ];
    public static array $work_modes = [
        'remote',
        'hybrid', 
        'onsite' 
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

    public function employer(): BelongsTo
    {
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications(): HasMany
    {
        return $this->hasMany(JobApplication::class);
    }
    
    public function hasUserApplied(Authenticatable | User | int $user): bool
    {
        // return $this->jobApplications()->where('user_id', $user->id)->exists(); 
        return $this->where('id', $this->id)
            ->whereHas('jobApplications',
            fn($query) => $query->where('user_id','=', $user->id ?? $user)
            )->exists();
    }

    // local query scopes
    public function scopeFilter(Builder | QueryBuilder $query, array $filters): Builder|QueryBuilder
    {
        return $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('employer', function ($query) use ($search) {
                        $query->where('company_name', 'like', '%' . $search . '%');
                    });
            });
        })->when($filters['min_salary'] ?? null, function ($query, $minSalary) {
            $query->where('salary', '>=', $minSalary);
        })->when($filters['max_salary'] ?? null, function ($query, $maxSalary) {
            $query->where('salary', '<=', $maxSalary);
        })->when($filters['experience'] ?? null, function ($query, $experience) {
            $query->where('experience', $experience);
        })->when($filters['category'] ?? null, function ($query, $category) {
            $query->where('category', $category);
        });
    }
    
}
