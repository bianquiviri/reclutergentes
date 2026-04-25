<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class JobOffer extends Model
{
    protected $fillable = [
        'title',
        'description',
        'requirements',
        'status',
        'created_by',
    ];

    protected $casts = [
        'title' => 'json',
        'description' => 'json',
        'requirements' => 'json',
    ];

    /**
     * Get the translated title.
     */
    public function getTranslatedTitleAttribute()
    {
        $locale = App::getLocale();
        return $this->title[$locale] ?? $this->title[config('app.fallback_locale')] ?? '';
    }

    /**
     * Get the translated description.
     */
    public function getTranslatedDescriptionAttribute()
    {
        $locale = App::getLocale();
        return $this->description[$locale] ?? $this->description[config('app.fallback_locale')] ?? '';
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
