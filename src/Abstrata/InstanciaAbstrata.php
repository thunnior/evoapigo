<?php

namespace Evoapigo\Abstrata;

final class InstanciaAbstrata
{
    /**
     * Identificador único da instância.
     *
     * @var string|null
     */
    private ?string $id = null;

    /**
     * Nome da instância.
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * Token associado à instância.
     *
     * @var string|null
     */
    private ?string $token = null;

    /**
     * URL de webhook configurada na instância.
     *
     * @var string|null
     */
    private ?string $webhook = null;

    /**
     * Habilita RabbitMQ.
     *
     * @var mixed
     */
    private $rabbitmqEnable = null;

    /**
     * Habilita WebSocket.
     *
     * @var mixed
     */
    private $websocketEnable = null;

    /**
     * Habilita NATS.
     *
     * @var mixed
     */
    private $natsEnable = null;

    /**
     * JID associado à instância.
     *
     * @var string|null
     */
    private ?string $jid = null;

    /**
     * Código QR da instância.
     *
     * @var mixed
     */
    private $qrcode = null;

    /**
     * Indica se a instância está conectada.
     *
     * @var bool|null
     */
    private ?bool $connected = null;

    /**
     * Tempo de expiração da instância.
     *
     * @var mixed
     */
    private $expiration = null;

    /**
     * Motivo do logout/desconexão.
     *
     * @var string|null
     */
    private ?string $disconnect_reason = null;

    /**
     * Nome do sistema operacional.
     *
     * @var string|null
     */
    private ?string $os_name = null;

    /**
     * Configuração de proxy da instância.
     *
     * @var mixed
     */
    private $proxy = null;

    /**
     * Nome do cliente associado à instância.
     *
     * @var mixed
     */
    private $client_name = null;

    /**
     * Data de criação da instância.
     *
     * @var mixed
     */
    private $createdAt = null;

    // Config
    /**
     * Indica se a instância está sempre online.
     *
     * @var bool
     */
    private bool $alwaysOnline = false;

    /**
     * Indica se chamadas devem ser rejeitadas.
     *
     * @var bool
     */
    private bool $rejectCall = false;

    /**
     * Mensagem de rejeição de chamada.
     *
     * @var mixed
     */
    private $msgRejectCall = null;

    /**
     * Indica se mensagens devem ser lidas automaticamente.
     *
     * @var bool
     */
    private bool $readMessages = false;

    /**
     * Indica se grupos devem ser ignorados.
     *
     * @var bool
     */
    private bool $ignoreGroups = false;

    /**
     * Indica se status devem ser ignorados.
     *
     * @var bool
     */
    private bool $ignoreStatus = false;

    // Proxy
    /**
     * URL do proxy.
     *
     * @var mixed
     */
    private $proxyUrl = null;

    /**
     * Porta do proxy.
     *
     * @var mixed
     */
    private $proxyPort = null;

    /**
     * Nome de usuário do proxy.
     *
     * @var mixed
     */
    private $proxyUsername = null;

    /**
     * Senha do proxy.
     *
     * @var mixed
     */
    private $proxyPassword = null;

    // WebHook
    /**
     * URL do webhook adicional.
     *
     * @var mixed
     */
    private $webhookUrl = null;

    /**
     * Cria uma instância de InstanciaAbstrata a partir dos dados retornados pela API.
     *
     * @param array $data dados da instância retornados em data.
     * @return self objeto preenchido com os valores da instância.
     */
    public static function fromArray(array $data): self
    {
        $instance = new self();

        $instance->id = $data['id'] ?? null;
        $instance->name = $data['name'] ?? null;
        $instance->token = $data['token'] ?? null;
        $instance->webhook = $data['webhook'] ?? null;
        $instance->rabbitmqEnable = $data['rabbitmqEnable'] ?? null;
        $instance->websocketEnable = $data['websocketEnable'] ?? null;
        $instance->natsEnable = $data['natsEnable'] ?? null;
        $instance->jid = $data['jid'] ?? null;
        $instance->qrcode = $data['qrcode'] ?? null;
        $instance->connected = isset($data['connected']) ? (bool) $data['connected'] : null;
        $instance->expiration = $data['expiration'] ?? null;
        $instance->disconnect_reason = $data['disconnect_reason'] ?? null;
        $instance->os_name = $data['os_name'] ?? null;
        $instance->proxy = $data['proxy'] ?? null;
        $instance->client_name = $data['client_name'] ?? null;
        $instance->createdAt = $data['createdAt'] ?? null;

        $instance->alwaysOnline = isset($data['alwaysOnline']) ? (bool) $data['alwaysOnline'] : false;
        $instance->rejectCall = isset($data['rejectCall']) ? (bool) $data['rejectCall'] : false;
        $instance->msgRejectCall = $data['msgRejectCall'] ?? null;
        $instance->readMessages = isset($data['readMessages']) ? (bool) $data['readMessages'] : false;
        $instance->ignoreGroups = isset($data['ignoreGroups']) ? (bool) $data['ignoreGroups'] : false;
        $instance->ignoreStatus = isset($data['ignoreStatus']) ? (bool) $data['ignoreStatus'] : false;

        return $instance;
    }

    /**
     * Retorna os dados da instância em formato de array.
     *
     * @return array dados da instância.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'token' => $this->token,
            'webhook' => $this->webhook,
            'rabbitmqEnable' => $this->rabbitmqEnable,
            'websocketEnable' => $this->websocketEnable,
            'natsEnable' => $this->natsEnable,
            'jid' => $this->jid,
            'qrcode' => $this->qrcode,
            'connected' => $this->connected,
            'expiration' => $this->expiration,
            'disconnect_reason' => $this->disconnect_reason,
            'os_name' => $this->os_name,
            'proxy' => $this->proxy,
            'client_name' => $this->client_name,
            'createdAt' => $this->createdAt,
            'alwaysOnline' => $this->alwaysOnline,
            'rejectCall' => $this->rejectCall,
            'msgRejectCall' => $this->msgRejectCall,
            'readMessages' => $this->readMessages,
            'ignoreGroups' => $this->ignoreGroups,
            'ignoreStatus' => $this->ignoreStatus,
        ];
    }

    /**
     * Retorna uma propriedade pública da instância quando acessada dinamicamente.
     *
     * @param string $property nome da propriedade.
     * @return mixed valor da propriedade ou null se inexistente.
     */
    public function get(string $property): mixed
    {
        if (!property_exists($this, $property)) {
            return null;
        }

        return $this->{$property};
    }

    /**
     * Permite acessar propriedades magicamente.
     *
     * @param string $name nome da propriedade.
     * @return mixed valor da propriedade.
     */
    public function __get(string $name): mixed
    {
        return $this->get($name);
    }
}
