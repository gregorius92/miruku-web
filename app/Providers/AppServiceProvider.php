<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Mail;
use Mailtrap\Bridge\Transport\MailtrapSdkTransport;
use Mailtrap\Config;
use Mailtrap\MailtrapClient;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Component\HttpClient\Psr18Client;

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

            /**
             * Force NativeHttpClient to avoid curl_multi_exec which is disabled on InfinityFree
             */
            $httpClient = new Psr18Client(new NativeHttpClient());
            $mailtrapConfig = (new Config($apiKey))->setHttpClient($httpClient);
            $client = new MailtrapClient($mailtrapConfig);

            $apiLayer = $isSandbox
                ? $client->sandbox()->emails($inboxId ? (int) $inboxId : null)
                : $client->sending()->emails();

            return new MailtrapSdkTransport($apiLayer, $mailtrapConfig);
        });
    }
}
