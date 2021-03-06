<?php

namespace App\Slack;

use App\Exceptions\SlackApiError;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


/**
 * This is a simple client for the Slack API. Authentication is
 * based on a single bearer token in the env as SLACK_BOT_USER_TOKEN
 * More info about bot token auth: https://api.slack.com/authentication/basics#scopes
 *
 * Add methods to this class as needed for your app. Make sure you've added
 * the correct scopes for each method in your app's OAuth settings.
 * See the full method listing: https://api.slack.com/methods
 */
class SlackClient
{
    const BASE = 'https://slack.com/api/';

    private $token;

    public function __construct()
    {
        $this->token = config('services.slack.bot_user_token');
    }

    public function apiTest($error = null, $foo = null)
    {
        $endpoint = static::BASE . 'api.test';
        $args = [];

        if ($error) {
            $args['error'] = $error;
        }

        if ($foo) {
            $args['foo'] = $foo;
        }

        return $this->callMethod($endpoint, $args);
    }

    public function conversationsHistory($channel, $args = [])
    {
        $endpoint = static::BASE . 'conversations.history';

        $args = array_merge([
            'channel' => $channel,
        ], Arr::wrap($args));

        return $this->callMethod($endpoint, $args);
    }

    public function usersList($args = [])
    {
        $endpoint = static::BASE . 'users.list';

        return $this->callMethod($endpoint, $args);
    }

    public function callMethod($endpoint, $args)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->token,
        ])
        ->asForm()
        ->post($endpoint, $args);

        if (! $response->ok() || Arr::get($response, 'ok') != true) {
            throw new SlackApiError(
                "Error calling {$endpoint}",
                Arr::get($response, 'error'),
                $args,
                $response->json()
            );
        }
        // Log::debug($response->json());
        return $response->json();
    }
}
