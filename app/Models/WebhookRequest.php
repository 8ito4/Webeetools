<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WebhookRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'webhook_id',
        'method',
        'headers',
        'query_parameters',
        'body',
        'ip_address',
    ];

    protected $casts = [
        'headers' => 'array',
        'query_parameters' => 'array',
        'body' => 'array',
    ];

    public function webhook(): BelongsTo
    {
        return $this->belongsTo(Webhook::class);
    }
} 