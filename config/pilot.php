<?php

return [
    'version'                    => '2.0.1',
    'debug'                      => false,
    'truncatedDebug'             => false,
    'storageConfig'              => [
        'storage'    => 'file',
        'basefolder' => storage_path('instagram'),
    ],

    'PATH_FFPROBE'               => base_path('vendor/ivoglent/ffmpeg-composer-bin/bin/ffprobe', null),
    'PATH_FFMPEG'                => base_path('vendor/ivoglent/ffmpeg-composer-bin/bin/ffmpeg', null),

    'SLEEP_MIN'                  => 7,
    'SLEEP_MAX'                  => 10,

    'FOLLOWER_TYPE_FOLLOWERS'    => 1,
    'FOLLOWER_TYPE_FOLLOWING'    => 2,

    'ACTION_FOLLOWERS_FOLLOW'    => 1,
    'ACTION_FOLLOWERS_UN_FOLLOW' => 2,
    'ACTION_FOLLOWING_FOLLOW'    => 3,
    'ACTION_FOLLOWING_UN_FOLLOW' => 4,

    'AUDIENCE_FOLLOWERS'         => 1,
    'AUDIENCE_FOLLOWING'         => 2,
    'AUDIENCE_USERS_LIST'        => 3,
    'AUDIENCE_DM_LIST'           => 4,

    'JOB_STATUS_ON_QUEUE'        => 1,
    'JOB_STATUS_SUCCESS'         => 2,
    'JOB_STATUS_FAILED'          => 3,

    // Settings
    'SITE_DESCRIPTION'           => 'Most wanted automation tool for Instagram Direct Message.',
    'SITE_KEYWORDS'              => 'automation tool, web direct messenger, dm pilot, instagram direct messenger, instagram messaging tool',
    'SITE_SKIN'                  => 'default',
    'SCHEDULE_TYPE'              => 'cron',
    'CURRENCY_CODE'              => 'USD',
    'CURRENCY_SYMBOL'            => '$',
    'TAX_PERCENTAGE'             => 18,
    'TRIAL_DAYS'                 => 3,
    'GOOGLE_ANALYTICS'           => '',
    'SYSTEM_PROXY'               => false,
    'CUSTOM_PROXY'               => true,

];
