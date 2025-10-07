<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model 
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'status','start_date','deadline', 'user_id', 'created_by', 'priority'
    ];

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * User yang ditugaskan untuk task ini
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Alternative nama untuk assignee (sesuai dengan view yang ada)
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * User yang membuat task ini
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Files yang terkait dengan task
     */
    public function files()
    {
        return $this->hasMany(TaskFile::class);
    }

    /**
     * Comments untuk task
     */
    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter berdasarkan priority
     */
    public function scopeByPriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    /**
     * Accessor untuk mendapatkan status dalam format yang readable
     */
    public function getStatusLabelAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }

    /**
     * Accessor untuk mendapatkan priority label dengan warna
     */
    public function getPriorityColorAttribute()
    {
        return match($this->priority) {
            'high' => 'text-red-600 bg-red-100',
            'medium' => 'text-yellow-600 bg-yellow-100',
            'low' => 'text-green-600 bg-green-100',
            default => 'text-gray-600 bg-gray-100'
        };
    }
}