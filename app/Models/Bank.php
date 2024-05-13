<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bank extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
