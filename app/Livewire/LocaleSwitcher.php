<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleSwitcher extends Component
{
    public $currentLocale;

    public function mount()
    {
        $this->currentLocale = App::getLocale();
    }

    public function switchLocale($locale)
    {
        if (in_array($locale, config('localization.supported_locales'))) {
            Session::put('locale', $locale);
            App::setLocale($locale);
            $this->currentLocale = $locale;
            
            // Redirect to refresh the page with the new locale
            return redirect(request()->header('Referer'));
        }
    }

    public function render()
    {
        return view('livewire.locale-switcher');
    }
}
