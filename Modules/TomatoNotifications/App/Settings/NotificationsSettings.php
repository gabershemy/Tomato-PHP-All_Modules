<?php

namespace Modules\TomatoNotifications\App\Settings;

use Spatie\LaravelSettings\Settings;

class NotificationsSettings extends Settings
{
    public bool $notifications_allow = true;
    public string $fcm_apiKey = '';
    public string $fcm_authDomain = '';
    public string $fcm_projectId = '';
    public string $fcm_storageBucket = '';
    public string $fcm_messagingSenderId = '';
    public string $fcm_appId = '';
    public string $fcm_measurementId = '';

    public static function group(): string
    {
        return 'notifications';
    }
}
