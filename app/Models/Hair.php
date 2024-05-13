<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hair extends Model
{
    use HasFactory;

    /**
     * @return BelongsTo
     */
    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
