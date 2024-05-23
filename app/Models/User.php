<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'first_name',
        'last_name',
        'document',
        'email',
        'phone_number',
        'birth_date',
        'pwd_hash',
        'created_at',
        'updated_at'
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
