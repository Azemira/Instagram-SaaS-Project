<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable / Disable auto save
    |--------------------------------------------------------------------------
    |
    | Auto-save every time the application shuts down
    |
     */
    'auto_save'              => false,

    /*
    |--------------------------------------------------------------------------
    | Setting driver
    |--------------------------------------------------------------------------
    |
    | Select where to store the settings.
    |
    | Supported: "database", "json"
    |
     */
    'driver'                 => 'database',

    /*
    |--------------------------------------------------------------------------
    | Database driver
    |--------------------------------------------------------------------------
    |
    | Options for database driver. Enter which connection to use, null means
    | the default connection. Set the table and column names.
    |
     */
    'database'               => [
        'connection' => null,
        'table'      => 'settings',
        'key'        => 'key',
        'value'      => 'value',
    ],

    /*
    |--------------------------------------------------------------------------
    | JSON driver
    |--------------------------------------------------------------------------
    |
    | Options for json driver. Enter the full path to the .json file.
    |
     */
    'json'                   => [
        'path' => storage_path() . '/settings.json',
    ],

    /*
    |--------------------------------------------------------------------------
    | Override application config values
    |--------------------------------------------------------------------------
    |
    | If defined, settings package will override these config values.
    |
    | Sample:
    |   "app.locale" => "settings.locale",
    |
     */
    'override'               => [
        'pilot.SITE_DESCRIPTION'         => 'SITE_DESCRIPTION',
        'pilot.SITE_KEYWORDS'            => 'SITE_KEYWORDS',
        'pilot.SITE_SKIN'                => 'SITE_SKIN',
        'pilot.SCHEDULE_TYPE'            => 'SCHEDULE_TYPE',
        'pilot.CURRENCY_CODE'            => 'CURRENCY_CODE',
        'pilot.CURRENCY_SYMBOL'          => 'CURRENCY_SYMBOL',
        'pilot.TAX_PERCENTAGE'           => 'TAX_PERCENTAGE',
        'pilot.TRIAL_DAYS'               => 'TRIAL_DAYS',
        'pilot.GOOGLE_ANALYTICS'         => 'GOOGLE_ANALYTICS',
        'pilot.SYSTEM_PROXY'             => 'SYSTEM_PROXY',
        'pilot.CUSTOM_PROXY'             => 'CUSTOM_PROXY',

        'mail.host'                      => 'MAIL_HOST',
        'mail.port'                      => 'MAIL_PORT',
        'mail.from.address'              => 'MAIL_FROM_ADDRESS',
        'mail.from.name'                 => 'MAIL_FROM_NAME',
        'mail.encryption'                => 'MAIL_ENCRYPTION',
        'mail.username'                  => 'MAIL_USERNAME',
        'mail.password'                  => 'MAIL_PASSWORD',

        'app.locale'                     => 'APP_LOCALE',
        'app.url'                        => 'APP_URL',
        'app.name'                       => 'APP_NAME',
        'app.timezone'                   => 'APP_TIMEZONE',

        'recaptcha.api_site_key'         => 'RECAPTCHA_SITE_KEY',
        'recaptcha.api_secret_key'       => 'RECAPTCHA_SECRET_KEY',

        'services.stripe.key'            => 'STRIPE_KEY',
        'services.stripe.secret'         => 'STRIPE_SECRET',
        'services.stripe.webhook.secret' => 'STRIPE_WEBHOOK_SECRET',

    ],

    /*
    |--------------------------------------------------------------------------
    | Required Extra Columns
    |--------------------------------------------------------------------------
    |
    | The list of columns required to be set up
    |
    | Sample:
    |   "user_id",
    |   "tenant_id",
    |
     */
    'required_extra_columns' => [

    ],
];
