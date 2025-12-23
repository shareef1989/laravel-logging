<?php

namespace Shareef_Morad\Logging\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logging extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'logging';

    /**
     * The attributes that aren't mass assignable.
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'after'  => 'object',
        'before' => 'object',
    ];

    /**
     * Get the user that performed the action.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('db-logging.user.model'), 'user_id');
    }
}
