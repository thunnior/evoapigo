<?php

namespace Evoapigo\Resources;

use Evoapigo\Client;

final class User
{
    /**
     * Inicializa o recurso de usuário.
     *
     * @param Client $client Cliente HTTP configurado para a API Evolution Go.
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * Retorna informações do usuário conectado.
     *
     * @return array|string resposta da API.
     */
    public function info(): array|string
    {
        return $this->client->get('user/info');
    }

    /**
     * Verifica se o usuário está ativo.
     *
     * @return array|string resposta da API.
     */
    public function check(): array|string
    {
        return $this->client->get('user/check');
    }

    /**
     * Recupera o avatar do usuário.
     *
     * @return array|string resposta da API.
     */
    public function avatar(): array|string
    {
        return $this->client->get('user/avatar');
    }

    /**
     * Lista os contatos do usuário.
     *
     * @return array|string resposta da API.
     */
    public function contacts(): array|string
    {
        return $this->client->get('user/contacts');
    }

    /**
     * Busca as configurações de privacidade do usuário.
     *
     * @return array|string resposta da API.
     */
    public function privacySettings(): array|string
    {
        return $this->client->get('user/privacy');
    }

    /**
     * Bloqueia um contato.
     *
     * @param array $payload dados do contato a ser bloqueado.
     * @return array|string resposta da API.
     */
    public function blockContact(array $payload): array|string
    {
        return $this->client->post('user/block', $payload);
    }

    /**
     * Desbloqueia um contato.
     *
     * @param array $payload dados do contato a ser desbloqueado.
     * @return array|string resposta da API.
     */
    public function unblockContact(array $payload): array|string
    {
        return $this->client->post('user/unblock', $payload);
    }

    /**
     * Retorna a lista de contatos bloqueados.
     *
     * @return array|string resposta da API.
     */
    public function blockList(): array|string
    {
        return $this->client->get('user/block-list');
    }

    /**
     * Atualiza a foto de perfil do usuário.
     *
     * @param array $payload dados da nova foto de perfil.
     * @return array|string resposta da API.
     */
    public function setProfilePicture(array $payload): array|string
    {
        return $this->client->post('user/profile-picture', $payload);
    }

    /**
     * Atualiza o nome de perfil do usuário.
     *
     * @param array $payload dados do novo nome.
     * @return array|string resposta da API.
     */
    public function setProfileName(array $payload): array|string
    {
        return $this->client->post('user/profile-name', $payload);
    }

    /**
     * Atualiza o status de perfil do usuário.
     *
     * @param array $payload dados do novo status.
     * @return array|string resposta da API.
     */
    public function setProfileStatus(array $payload): array|string
    {
        return $this->client->post('user/profile-status', $payload);
    }
}
