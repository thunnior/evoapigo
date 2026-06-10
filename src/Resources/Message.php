<?php

namespace Evoapigo\Resources;

use Evoapigo\Client;

final class Message
{
    /**
     * Inicializa o recurso de mensagem.
     *
     * @param Client $client Cliente HTTP configurado para a API Evolution Go.
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * Reage a uma mensagem com emoji ou reação customizada.
     *
     * @param array $payload dados de reação (por exemplo, messageId, reaction).
     * @return array|string resposta da API.
     */
    public function react(array $payload): array|string
    {
        return $this->client->post('message/react', $payload);
    }

    /**
     * Envia presença para o chat, como composing ou paused.
     *
     * Exemplo de payload: {"number":"5511999999999","state":"composing","isAudio":true}
     *
     * @param array $payload dados de presença.
     * @return array|string resposta da API.
     */
    public function sendPresence(array $payload): array|string
    {
        return $this->client->post('message/presence', $payload);
    }

    /**
     * Marca uma ou mais mensagens como lidas.
     *
     * Exemplo de payload: {"number":"5511999999999","id":["messageId1","messageId2"]}
     *
     * @param array $payload dados para marcar como lido.
     * @return array|string resposta da API.
     */
    public function markAsRead(array $payload): array|string
    {
        return $this->client->post('message/markread', $payload);
    }

    /**
     * Faz download de mídia usando dados de mensagem.
     *
     * Payload de entrada exemplo: objeto message com imageMessage e URL.
     *
     * @param array $payload dados para download de mídia.
     * @return array|string resposta da API.
     */
    public function downloadMedia(array $payload): array|string
    {
        return $this->client->post('message/downloadmedia', $payload);
    }

    /**
     * Verifica o status de uma mensagem.
     *
     * @param array $payload dados da mensagem (por exemplo, id).
     * @return array|string resposta da API.
     */
    public function status(array $payload): array|string
    {
        return $this->client->post('message/status', $payload);
    }

    /**
     * Exclui uma mensagem de um chat.
     *
     * Payload de entrada exemplo: {"chat":"5511999999999@s.whatsapp.net","messageId":"..."}
     *
     * @param array $payload dados da mensagem a excluir.
     * @return array|string resposta da API.
     */
    public function delete(array $payload): array|string
    {
        return $this->client->post('message/delete', $payload);
    }

    /**
     * Edita o conteúdo de uma mensagem enviada.
     *
     * Exemplo de payload: {"chat":"5511999999999@s.whatsapp.net","messageId":"...","message":"texto editado"}
     *
     * @param array $payload dados para editar a mensagem.
     * @return array|string resposta da API.
     */
    public function edit(array $payload): array|string
    {
        return $this->client->post('message/edit', $payload);
    }
}
