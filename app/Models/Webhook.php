<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Webhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'name',
        'description',
        'requests_count',
        'last_request_at',
    ];

    protected $casts = [
        'last_request_at' => 'datetime',
    ];

    public function requests(): HasMany
    {
        return $this->hasMany(WebhookRequest::class);
    }

    public function incrementRequestCount(): void
    {
        $this->increment('requests_count');
        $this->update(['last_request_at' => now()]);
    }
} 