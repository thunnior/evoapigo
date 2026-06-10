<?php

namespace Evoapigo\Resources;

use Evoapigo\Client;

final class Chat
{
    /**
     * Inicializa o recurso de chat.
     *
     * @param Client $client Cliente HTTP configurado para a API Evolution Go.
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * Fixar um chat.
     *
     * @param array $payload dados do chat a fixar.
     * @return array|string resposta da API.
     */
    public function pin(array $payload): array|string
    {
        return $this->client->post('chat/pin', $payload);
    }

    /**
     * Desafixar um chat.
     *
     * @param array $payload dados do chat.
     * @return array|string resposta da API.
     */
    public function unpin(array $payload): array|string
    {
        return $this->client->post('chat/unpin', $payload);
    }

    /**
     * Arquiva um chat.
     *
     * @param array $payload dados do chat.
     * @return array|string resposta da API.
     */
    public function archive(array $payload): array|string
    {
        return $this->client->post('chat/archive', $payload);
    }

    /**
     * Desarquiva um chat.
     *
     * @param array $payload dados do chat.
     * @return array|string resposta da API.
     */
    public function unarchive(array $payload): array|string
    {
        return $this->client->post('chat/unarchive', $payload);
    }

    /**
     * Silencia um chat.
     *
     * @param array $payload dados do chat.
     * @return array|string resposta da API.
     */
    public function mute(array $payload): array|string
    {
        return $this->client->post('chat/mute', $payload);
    }

    /**
     * Remove silêncio de um chat.
     *
     * @param array $payload dados do chat.
     * @return array|string resposta da API.
     */
    public function unmute(array $payload): array|string
    {
        return $this->client->post('chat/unmute', $payload);
    }

    /**
     * Solicita sincronização de histórico de chat.
     *
     * @param array $payload dados do histórico a sincronizar.
     * @return array|string resposta da API.
     */
    public function historySync(array $payload): array|string
    {
        return $this->client->post('chat/history-sync', $payload);
    }
}
