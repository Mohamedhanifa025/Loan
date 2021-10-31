<?php

namespace App\Providers;

use App\Setting;
use Config;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $settingsRecord = Setting::all();
        $settings = array();
        foreach ($settingsRecord as $record) {
            $settings[$record['key']] = $record['value'];
        }
            if (isset($settings['smtp_host'])) {
                $config = array(
                    'driver'     => 'smtp',
                    'host'       => $settings['smtp_host'],
                    'port'       => $settings['smtp_port'],
                    'from'       => array('address' => env('MAIL_FROM_ADDRESS', $settings['smtp_username']), 'name' => env('MAIL_FROM_NAME','Loanzspot')),
                    'encryption' => 'tls',//$mail->encryption,
                    'username'   => $settings['smtp_username'],
                    'password'   => $settings['smtp_password'],
                    //'sendmail'   => '/usr/sbin/sendmail -bs',
                    //'pretend'    => false,
                );
                Config::set('mail', $config);
            }
    }
}
