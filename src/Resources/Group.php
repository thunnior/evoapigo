<?php

namespace Evoapigo\Resources;

use Evoapigo\Client;

final class Group
{
    /**
     * Inicializa o recurso de grupos.
     *
     * @param Client $client Cliente HTTP configurado para a API Evolution Go.
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * Lista todos os grupos disponíveis.
     *
     * @return array|string resposta da API com os grupos.
     */
    public function listGroups(): array|string
    {
        return $this->client->get('group/list');
    }

    /**
     * Retorna informações de um grupo.
     *
     * @param array $payload dados do grupo (por exemplo, groupJid).
     * @return array|string resposta da API.
     */
    public function info(array $payload): array|string
    {
        return $this->client->post('group/info', $payload);
    }

    /**
     * Obtém o link de convite para um grupo.
     *
     * @param array $payload dados do grupo (por exemplo, groupJid).
     * @return array|string resposta da API.
     */
    public function inviteLink(array $payload): array|string
    {
        return $this->client->post('group/invitelink', $payload);
    }

    /**
     * Altera a foto do grupo.
     *
     * @param array $payload dados da foto do grupo.
     * @return array|string resposta da API.
     */
    public function setPhoto(array $payload): array|string
    {
        return $this->client->post('group/photo', $payload);
    }

    /**
     * Altera o nome do grupo.
     *
     * @param array $payload dados do nome do grupo.
     * @return array|string resposta da API.
     */
    public function setName(array $payload): array|string
    {
        return $this->client->post('group/name', $payload);
    }

    /**
     * Altera a descrição do grupo.
     *
     * @param array $payload dados da descrição do grupo.
     * @return array|string resposta da API.
     */
    public function setDescription(array $payload): array|string
    {
        return $this->client->post('group/description', $payload);
    }

    /**
     * Cria um novo grupo.
     *
     * @param array $payload dados da criação de grupo.
     * @return array|string resposta da API.
     */
    public function create(array $payload): array|string
    {
        return $this->client->post('group/create', $payload);
    }

    /**
     * Atualiza participantes do grupo (add, remove, promote, demote).
     *
     * @param array $payload dados de participantes.
     * @return array|string resposta da API.
     */
    public function updateParticipant(array $payload): array|string
    {
        return $this->client->post('group/participant', $payload);
    }

    /**
     * Retorna todos os grupos do usuário.
     *
     * @return array|string resposta da API.
     */
    public function myGroups(): array|string
    {
        return $this->client->get('group/myall');
    }

    /**
     * Entra em um grupo usando link ou código.
     *
     * @param array $payload dados para entrar no grupo.
     * @return array|string resposta da API.
     */
    public function join(array $payload): array|string
    {
        return $this->client->post('group/join', $payload);
    }

    /**
     * Sai de um grupo.
     *
     * @param array $payload dados do grupo para sair.
     * @return array|string resposta da API.
     */
    public function leave(array $payload): array|string
    {
        return $this->client->post('group/leave', $payload);
    }
}
