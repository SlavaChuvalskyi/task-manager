<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Database\Factories\TaskFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'status', 'description', 'project_id', 'assign_user_id'];

    // Cast attributes to Enum
    protected $casts = [
        'status' => TaskStatus::class,
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assign_user_id', 'id');
    }

    protected static function newFactory(): TaskFactory
    {
        return TaskFactory::new();
    }
}
