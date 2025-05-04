<?php

return [
    'disable_task_handler' => !env('CLOUD_SCHEDULER_ENABLED', false),
    'disable_token_verification' => !env('CLOUD_SCHEDULER_VERIFY', true),
    'app_url' => env('CLOUD_SCHEDULER_VERIFY_URL'),
    'service_account' => env('CLOUD_SCHEDULER_VERIFY_SERVICE_ACCOUNT'),
];
