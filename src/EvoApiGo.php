<?php

/**
 * EvoApiGo - SDK para integração com a API Evolution Go.
 *
 * @link https://github.com/thunnior/evoapigo
 * @package Evoapigo
 * 
 * @author Thunnior <thalesjunior.moreira@gmail.com>
 */

namespace Evoapigo;

use Evoapigo\Resources\Chat;
use Evoapigo\Resources\Group;
use Evoapigo\Resources\Instance;
use Evoapigo\Resources\Message;
use Evoapigo\Resources\Server;
use Evoapigo\Resources\Send;
use Evoapigo\Resources\User;

/**
 * Classe principal do SDK EvoApiGo.
 *
 * Esta classe é responsável por inicializar o cliente HTTP e fornecer acesso aos recursos da API Evolution Go.
 */
final class EvoApiGo
{
    public readonly Client $client;
    public readonly Instance $instance;
    public readonly Send $send;
    public readonly User $user;
    public readonly Message $message;
    public readonly Chat $chat;
    public readonly Group $group;
    public readonly Server $server;

    /**
     * Inicializa o SDK Evolution Go.
     *
     * @param string $baseUrl URL base da API Evolution Go.
     * @param string $tokenApi chave de autenticação (apikey).
     * @param array $options opções adicionais para o cliente HTTP.
     */
    public function __construct(string $baseUrl, string $tokenApi, array $options = [])
    {
        $this->client = new Client($baseUrl, $tokenApi, $options);

        $this->instance = new Instance($this->client);
        $this->send = new Send($this->client);
        $this->user = new User($this->client);
        $this->message = new Message($this->client);
        $this->chat = new Chat($this->client);
        $this->group = new Group($this->client);
        $this->server = new Server($this->client);
    }
}
