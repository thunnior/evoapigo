<?php

namespace Evoapigo;

use Evoapigo\Exception\EvoApiGoException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;

final class Client
{
    private GuzzleClient $http;
    private string $apiKey;
    private string $baseUrl;
    private ?int $lastStatusCode = null;

    public function __construct(string $baseUrl, string $apiKey, array $options = [])
    {
        try {
            $baseUrl = trim($baseUrl);
            $apiKey = trim($apiKey);

            if ($baseUrl === '' || $apiKey === '') {
                throw new EvoApiGoException('Base URL and API key are required.');
            }

            $this->baseUrl = rtrim($baseUrl, '/');
            $this->apiKey = $apiKey;

            $defaultOptions = [
                'base_uri' => $this->baseUrl . '/',
                'timeout' => 30.0,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'apikey' => $this->apiKey,
                ],
            ];

            $this->http = new GuzzleClient(array_merge($defaultOptions, $options));
        } catch (GuzzleException $e) {
            throw new EvoApiGoException('Failed to initialize HTTP client: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    public function get(string $uri, array $query = [], array $headers = []): array|string
    {
        return $this->request('GET', $uri, $query, [], $headers);
    }

    public function post(string $uri, array $payload = [], array $headers = []): array|string
    {
        return $this->request('POST', $uri, [], $payload, $headers);
    }

    public function put(string $uri, array $payload = [], array $headers = []): array|string
    {
        return $this->request('PUT', $uri, [], $payload, $headers);
    }

    public function delete(string $uri, array $payload = [], array $headers = []): array|string
    {
        return $this->request('DELETE', $uri, [], $payload, $headers);
    }

    public function request(string $method, string $uri, array $query = [], array $payload = [], array $headers = []): array|string
    {
        $options = [];

        if ($query !== []) {
            $options['query'] = $query;
        }

        if ($payload !== []) {
            $options['json'] = $payload;
        }

        if ($headers !== []) {
            $options['headers'] = $headers + ($this->http->getConfig('headers') ?? []);
        }

        try {
            $response = $this->http->request($method, ltrim($uri, '/'), $options);
            $this->lastStatusCode = $response->getStatusCode();
            $body = (string) $response->getBody();

            if ($body === '') {
                return [];
            }

            try {
                return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
            } catch (\JsonException $jsonException) {
                return $body;
            }
        } catch (GuzzleException $exception) {
            $message = $exception->getMessage();
            $response = method_exists($exception, 'getResponse') ? $exception->getResponse() : null;

            if ($response !== null) {
                $this->lastStatusCode = $response->getStatusCode();
                $responseBody = (string) $response->getBody();

                if ($responseBody !== '') {
                    $message = $responseBody;
                }
            }

            throw new EvoApiGoException($message, (int) $exception->getCode(), $exception);
        }
    }

    /**
     * Retorna o status HTTP da última requisição executada.
     *
     * @return int|null código de status HTTP ou null se nenhuma requisição foi feita.
     */
    public function getLastStatusCode(): ?int
    {
        return $this->lastStatusCode;
    }
}
