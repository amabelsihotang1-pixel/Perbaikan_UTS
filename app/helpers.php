<?php
declare(strict_types=1);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function rupiah(float $amount): string
{
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

function category_icon(string $category): string
{
    return match ($category) {
        'Sport' => '🏍',
        'Bebek' => '🛵',
        'Trail' => '🏁',
        'Cruiser' => '🛣',
        'Listrik' => '⚡',
        default => '🛵',
    };
}

function category_tone(string $category): string
{
    return match ($category) {
        'Sport' => 'tone-peach',
        'Bebek' => 'tone-yellow',
        'Trail' => 'tone-sage',
        'Cruiser' => 'tone-lilac',
        'Listrik' => 'tone-electric',
        default => 'tone-sage',
    };
}
