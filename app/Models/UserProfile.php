<?php

namespace App\Models;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];
    protected $with = ['hair', 'company', 'bank', 'crypto'];

    /**
     * Retrieve the user model
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Retrieve the user model
     *
     * @return HasMany
     */
    public function address()
    {
        return $this->hasMany(Address::class);
    }

    /**
     * @return HasOne
     */
    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    /**
     * @return HasMany
     */
    public function bank()
    {
        return $this->hasMany(Bank::class, 'id', 'bank_id');
    }

    /**
     * @return HasOne
     */
    public function crypto()
    {
        return $this->hasOne(Crypto::class, 'id', 'crypto_id');
    }

    /**
     * @return HasOne
     */
    public function hair()
    {
        return $this->hasOne(Hair::class, 'id', 'hair_id');
    }
}
