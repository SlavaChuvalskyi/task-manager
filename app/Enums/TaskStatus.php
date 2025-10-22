<?php

namespace App\Enums;

enum TaskStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case REVIEW = 'review';
    case COMPLETED = 'completed';
    case REJECTED = 'rejected';

    const array statuses = [
        self::NEW,
        self::IN_PROGRESS,
        self::REVIEW,
        self::COMPLETED,
        self::REJECTED,
    ];

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::IN_PROGRESS => 'In Progress',
            self::REVIEW => 'In Review',
            self::COMPLETED => 'Done',
            self::REJECTED => 'Reject',
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->label()])
            ->toArray();
    }

}
