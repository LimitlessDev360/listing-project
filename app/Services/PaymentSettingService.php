<?php

namespace App\Services;

use App\Models\PaymentSetting;
use Cache;

class PaymentSettingService
{
    function getSettings()
    {
        return Cache::rememberForever('payment', function () {
            return PaymentSetting::pluck('value', 'key')->toArray();
        });
    }

    function setGlobalSettings()
    {
        $settings = $this->getSettings();
        config()->set('payment', $settings);
    }

    function clearCachedSettings()
    {
        Cache::forget('payment');
    }
}
