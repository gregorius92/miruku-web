<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Mailtrap\Bridge\Transport\MailtrapSdkTransport;
use Mailtrap\Config;
use Mailtrap\MailtrapClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Mail::extend('mailtrap', function (array $config) {
            $apiKey = $config['api_key'] ?? env('MAILTRAP_API_KEY');
            $inboxId = $config['inbox_id'] ?? env('MAILTRAP_INBOX_ID');
            $isSandbox = $config['is_sandbox'] ?? env('MAILTRAP_IS_SANDBOX', false);

            $apiLayer = MailtrapClient::initSendingEmails(
                apiKey: $apiKey,
                isSandbox: (bool) $isSandbox,
                inboxId: $inboxId ? (int) $inboxId : null
            );

            return new MailtrapSdkTransport($apiLayer, new Config($apiKey));
        });
    }
}
