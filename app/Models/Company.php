<?php

namespace App\Models;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $hidden = ['id', 'address_id', 'created_at', 'updated_at'];

    /**
     * @return BelongsTo
     */
    public function user_profile()
    {
        return $this->belongsTo(UserProfile::class);
    }
}
