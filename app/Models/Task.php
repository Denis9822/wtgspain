<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public const STATUS = [
        'pending' => 'pending',
        'completed' => 'completed',
        'failed' => 'failed',
    ];

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeFilterByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeOrderByCreatedAt($query, $direction = 'desc')
    {
        return $query->orderBy('created_at', $direction);
    }

    public function scopeOrderByUpdatedAt($query, $direction = 'desc')
    {
        return $query->orderBy('updated_at', $direction);
    }
}
