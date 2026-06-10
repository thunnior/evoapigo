<?php

namespace Evoapigo\Resources;

use Evoapigo\Client;

final class Server
{
    /**
     * Inicializa o recurso de servidor.
     *
     * @param Client $client Cliente HTTP configurado para a API Evolution Go.
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * Verifica a saúde do servidor Evolution Go.
     *
     * @return array|string resposta da API com o status de health.
     */
    public function health(): array|string
    {
        return $this->client->get('server/health');
    }
}
