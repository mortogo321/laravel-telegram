# Laravel - Telegram

A Laravel application demonstrating sending notifications to a Telegram chat via a bot, using `laravel-notification-channels/telegram`.

## What's inside

- `GET /notify/{message?}` — looks up the latest chat that messaged the configured Telegram bot, then sends it a formatted HTML message (falls back to a sample message if none is provided)
- Telegram bot token configured through `services.telegram-bot-api.token`

## Tech stack

- Laravel 12, PHP 8.2+
- `laravel-notification-channels/telegram`
- Laravel Sanctum (scaffolded, for API auth)

## Quickstart

```bash
composer install
cp .env.example .env
php artisan key:generate

# add your bot token, e.g. in .env:
# TELEGRAM_BOT_TOKEN=xxxxx

php artisan serve
```

Trigger a notification: `GET /notify/{message}`
