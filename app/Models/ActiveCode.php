<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'code',
        'expired_at'
        ];

    public $timestamps = false;
    /**
     * @var mixed
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePhoneVerify($query, $code, $user)
    {
        return !! $user->ActiveCode()->whereCode($code)->where('expired_at', '>', now())->first();
    }

    public function scopeGenerateCode($query, $user)
    {
        /*if($code = $this->getAliveCode($user))
        {
            $code = $code->code;
        }
        else {}*/

        $user->activeCode()->delete();

        do{
            $code = mt_rand(100000, 999999);
        } while($this->checkCodeIsUnique($user, $code));

        $user->ActiveCode()->create([
            'code' => $code,
            'expired_at' => now()->addMinutes(10)
        ]);

        return $code;
    }

    private function getAliveCode($user)
    {
        return $user->ActiveCode()->where('expired_at', '>', now())->first();
    }

    private function checkCodeIsUnique($user, $code)
    {
        return !! $user->ActiveCode()->whereCode($code)->first();
    }
}
