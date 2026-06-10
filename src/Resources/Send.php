<?php

namespace Evoapigo\Resources;

use Evoapigo\Client;

final class Send
{
    /**
     * Inicializa o recurso de envio de mensagens.
     *
     * @param Client $client Cliente HTTP configurado para a API Evolution Go.
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * Envia texto simples para um número.
     *
     * Exemplo de payload: {"number":"5511999999999","text":"mensagem","delay":1000}
     *
     * @param array $payload dados do texto.
     * @return array|string resposta da API.
     */
    public function sendText(array $payload): array|string
    {
        return $this->client->post('send/text', $payload);
    }

    /**
     * Envia um link como mensagem.
     *
     * @param array $payload dados do link.
     * @return array|string resposta da API.
     */
    public function sendLink(array $payload): array|string
    {
        return $this->client->post('send/link', $payload);
    }

    /**
     * Envia mídia via URL ou base64.
     *
     * Exemplo de payload: {"number":"5511999999999","url":"https://...","type":"document","caption":"..."}
     *
     * @param array $payload dados do arquivo.
     * @return array|string resposta da API.
     */
    public function sendMedia(array $payload): array|string
    {
        return $this->client->post('send/media', $payload);
    }

    /**
     * Envia uma enquete/poll para o número.
     *
     * @param array $payload dados da enquete.
     * @return array|string resposta da API.
     */
    public function sendPoll(array $payload): array|string
    {
        return $this->client->post('send/poll', $payload);
    }

    /**
     * Envia um sticker para o número.
     *
     * @param array $payload dados do sticker.
     * @return array|string resposta da API.
     */
    public function sendSticker(array $payload): array|string
    {
        return $this->client->post('send/sticker', $payload);
    }

    /**
     * Envia localizacao para o número.
     *
     * @param array $payload dados da localização.
     * @return array|string resposta da API.
     */
    public function sendLocation(array $payload): array|string
    {
        return $this->client->post('send/location', $payload);
    }

    /**
     * Envia contato no formato vcard.
     *
     * @param array $payload dados do contato.
     * @return array|string resposta da API.
     */
    public function sendContact(array $payload): array|string
    {
        return $this->client->post('send/contact', $payload);
    }

    /**
     * Envia mensagem com botões.
     *
     * @param array $payload dados dos botões.
     * @return array|string resposta da API.
     */
    public function sendButton(array $payload): array|string
    {
        return $this->client->post('send/button', $payload);
    }

    /**
     * Envia mensagem com lista de opções.
     *
     * @param array $payload dados da lista.
     * @return array|string resposta da API.
     */
    public function sendList(array $payload): array|string
    {
        return $this->client->post('send/list', $payload);
    }

    /**
     * Envia um carrossel de cards.
     *
     * @param array $payload dados do carrossel.
     * @return array|string resposta da API.
     */
    public function sendCarousel(array $payload): array|string
    {
        return $this->client->post('send/carousel', $payload);
    }
}
