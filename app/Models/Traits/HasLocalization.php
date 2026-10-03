<?php

namespace App\Models\Traits;

trait HasLocalization
{
    /**
     * Get the localized value for a given field based on the current app locale.
     * Falls back to English then Arabic if the localized value is null.
     */
    public function localized(string $field): ?string
    {
        $locale = app()->getLocale();

        return $this->{$field . '_' . $locale}
            ?? $this->{$field . '_en'}
            ?? $this->{$field . '_ar'};
    }
}
