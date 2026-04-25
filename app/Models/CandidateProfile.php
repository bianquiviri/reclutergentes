<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class CandidateProfile extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'email_blind_index',
        'parsed_content',
        'preferred_locale',
        'english_level',
    ];

    protected $casts = [
        'name' => 'encrypted',
        'email' => 'encrypted',
        'phone' => 'encrypted',
        'address' => 'encrypted',
        'parsed_content' => 'encrypted:json',
    ];

    /**
     * Boot the model to handle blind indexing.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if ($model->email) {
                $model->email_blind_index = self::generateBlindIndex($model->email);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('email')) {
                $model->email_blind_index = self::generateBlindIndex($model->email);
            }
        });
    }

    /**
     * Generate a blind index (HMAC) for a value.
     */
    public static function generateBlindIndex($value)
    {
        return hash_hmac('sha256', strtolower($value), config('app.blind_index_key'));
    }

    /**
     * Scope a query to find a candidate by email using the blind index.
     */
    public function scopeWhereEmail($query, $email)
    {
        return $query->where('email_blind_index', self::generateBlindIndex($email));
    }

    /**
     * Get the candidate's full name (alias for name).
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
