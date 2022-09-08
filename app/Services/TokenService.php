<?php

namespace App\Services;


use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class TokenService
{
    /**
     * @return mixed
     */
    public function create(): mixed
    {
        $token = Hash::make(Str::random(25));
        $expirationTime = Carbon::now()->addHour();

        return Token::create([
            'token' => $token,
            'expiration_time' => $expirationTime,
        ]);
    }

    /**
     * @param Token $token
     * @return Token
     */
    public function writeOffToken(Token $token): Token
    {
        $token->update([
            'used' => 1
        ]);
        return $token;
    }

    /**
     * @param string $tokenFromRequest
     * @return string|Token
     */
    public function checkToken(string $tokenFromRequest): string | Token
    {
        $token = Token::where('token', $tokenFromRequest)->first();

        if ($token === null) {
            return 'incorrect token';
        }

        if ($token->used === 1) {
            return 'token already used';
        }

        if ($token->expiration_time < Carbon::now()) {
            return 'time expired from this token';
        }

        return $token;
    }
}
