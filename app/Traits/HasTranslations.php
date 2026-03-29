<?php

namespace App\Traits;

use Illuminate\Support\Facades\App;

trait HasTranslations
{
    /**
     * Get a translatable attribute.
     * 
     * @param string $key
     * @return mixed
     */
    protected function getTranslatedAttribute($key)
    {
        $locale = App::getLocale();
        $translatedKey = "{$key}_{$locale}";

        if ($locale !== 'id' && !empty($this->{$translatedKey})) {
            return $this->{$translatedKey};
        }

        return $this->getAttributeValue($key);
    }

    /**
     * Override getAttribute to support auto-translation.
     */
    public function getAttribute($key)
    {
        $translatable = $this->translatable ?? [];

        if (in_array($key, $translatable)) {
            return $this->getTranslatedAttribute($key);
        }

        return parent::getAttribute($key);
    }
}
