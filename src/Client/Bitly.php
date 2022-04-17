<?php

namespace Elmsellem\Bitly\Client;

use Elmsellem\Bitly\Exceptions\BitlyBadResponseException;
use Elmsellem\Bitly\Exceptions\BitlyForbiddenException;
use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class Bitly
{
    private string $url = 'https://api-ssl.bitly.com/v4/shorten';
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /** @throws Exception */
    public function getShortenUrl(string $long_url, ?string $domain = null, ?string $group_guid = null): string
    {
        $data = array_filter([
            'long_url' => $long_url,
            'domain' => $domain,
            'group_guid' => $group_guid
        ]);
        $response = Http::withToken($this->token)->post($this->url, $data);
        return $this->getLinkFromResponse($response);
    }

    /** @throws Exception */
    private function getLinkFromResponse(Response $response): string
    {
        try {
            $response->throw();
        } catch (RequestException $exception) {
            if ($response->forbidden()) {
                throw new BitlyForbiddenException('Invalid access token.', $exception->getCode(), $exception);
            }
            throw new BitlyBadResponseException($exception->getMessage(), $exception->getCode(), $exception);
        }

        if (!$link = $response->json('link')) {
            throw new BitlyBadResponseException('Invalid response. content: ' . $response->body());
        }
        return $link;
    }
}
