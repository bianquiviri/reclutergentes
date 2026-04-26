<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class JobOffer extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = [
        'title',
        'description',
        'requirements',
        'location',
        'salary_range',
        'status',
        'created_by',
    ];

    protected $casts = [
        'title' => 'json',
        'description' => 'json',
        'requirements' => 'json',
    ];

    /**
     * Get translation for a JSON field.
     */
    public function getTranslation($field, $locale = null)
    {
        $locale = $locale ?: App::getLocale();
        $translations = $this->getAttribute($field);

        if (!is_array($translations)) {
            return $translations;
        }

        return $translations[$locale] ?? $translations[config('app.fallback_locale')] ?? '';
    }

    /**
     * Get the translated title.
     */
    public function getTranslatedTitleAttribute()
    {
        return $this->getTranslation('title');
    }

    /**
     * Get the translated description.
     */
    public function getTranslatedDescriptionAttribute()
    {
        return $this->getTranslation('description');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
