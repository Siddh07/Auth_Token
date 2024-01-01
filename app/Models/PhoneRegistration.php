<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'verification_token',
        'token_expires_at',
        // Add other fillable attributes here
    ];

    public function generateToken()
    {
        $this->token = mt_rand(100000, 999999);
        $this->save();
    }

    protected $dates = [
        'token_expires_at',
    ];

}
