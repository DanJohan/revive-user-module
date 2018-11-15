<?php

define('MAIL_HOST',getenv('MAIL_HOST'));
define('MAIL_USERNAME',getenv('MAIL_USERNAME'));
define('MAIL_PASSWORD',getenv('MAIL_PASSWORD'));
define('MAIL_PORT',getenv('MAIL_PORT'));


define('FB_APP_ID', getenv('FB_APP_ID'));
define('FB_SECRET_KEY',getenv('FB_SECRET_KEY'));
define('FB_VERSION',getenv('FB_VERSION'));

define('GMAIL_CLIENT_ID',getenv('GMAIL_CLIENT_ID'));
define('GMAIL_CLIENT_SECRET',getenv('GMAIL_CLIENT_SECRET'));
define('GMAIL_API_KEY',getenv('GMAIL_API_KEY'));

define('CRM_BASE_URL',getenv('CRM_BASE_URL'));
define('CRM_BASE_PATH', getenv('CRM_BASE_PATH'));

define('PUSHER_APP_ID',getenv('PUSHER_APP_ID'));
define('PUSHER_KEY',getenv('PUSHER_KEY'));
define('PUSHER_SECRET',getenv('PUSHER_SECRET'));
define('PUSHER_CLUSTER',getenv('PUSHER_CLUSTER'));

define('TWILIO_SID', getenv('TWILIO_SID'));
define('TWILIO_TOKEN', getenv('TWILIO_TOKEN'));
define('TWILIO_NUMBER', getenv('TWILIO_NUMBER'));
?>
