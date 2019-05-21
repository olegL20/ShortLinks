<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ShortLink
 * @package App\Models
 * @property integer $id
 * @property string $original_url
 * @property string $short_url
 * @property Carbon $expired_at
 */
class ShortLink extends Model
{
    protected $guarded = ['id'];
    protected $dates = [
        'expired_at',
        'created_at',
        'updated_at'
    ];

    public function getId(): int
    {
        return $this->id;
    }

    public function getRouteKeyName(): string
    {
        return 'short_url';
    }

    public function isExpired(): bool
    {
       return !$this->expired_at->isFuture();
    }
}
