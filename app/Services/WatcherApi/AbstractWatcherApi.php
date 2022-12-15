<?php

namespace App\Services\WatcherApi;

use App\Exceptions\Watcher\WatcherApiError;
use GuzzleHttp\Middleware;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractWatcherApi
{
    private string $apiKey;

    public function setApiKey(string $token): static
    {
        $this->apiKey = $token;
        return $this;
    }

    protected function getApiKey(): string
    {
        return $this->apiKey;
    }

    protected function getRequestBuilder(): PendingRequest
    {
        $request = Http::baseUrl(config('watcher.api_base_url'));
        $request->withMiddleware(
            Middleware::mapResponse(function (ResponseInterface $response) {
                $this->handleError(new Response($response));

                return $response;
            })
        );

        $headers = [
            'Accept' => 'application/json',
        ];
        if ($this->getApiKey()) {
            $headers['apikey'] = $this->getApiKey();
        }

        $request->withHeaders($headers);

        return $request;
    }

    /**
     * @throws WatcherApiError
     */
    protected function handleError(Response $response)
    {
        if (!$response->successful()) {
            $message = isset($response->json()['errors'])
                ? implode(' ', $response->json()['errors'])
                : 'Watcher error: ' . $response->status();
            throw new WatcherApiError($message, $response->status());
        }
    }
}
