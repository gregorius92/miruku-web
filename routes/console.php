<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('mail:test-mailtrap', function () {
    $this->info('Sending test email via Mailtrap API...');
    
    try {
        Mail::mailer('mailtrap')->raw('This is a test email from Miruku web.', function ($message) {
            $message->to('gregorius.septian@gmail.com')
                    ->subject('Mailtrap API Test');
        });
        
        $this->info('Success! Check your Mailtrap inbox.');
    } catch (\Exception $e) {
        $this->error('Failed: ' . $e->getMessage());
    }
})->purpose('Test Mailtrap API sending');
