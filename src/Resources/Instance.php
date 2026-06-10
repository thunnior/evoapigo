<?php

namespace Evoapigo\Resources;

use Evoapigo\Client;
use Evoapigo\Abstrata\InstanciaAbstrata;
use Evoapigo\Exception\EvoApiGoException;
use Ramsey\Uuid\Uuid;

final class Instance
{
    /**
     * Inicializa o recurso de instância.
     *
     * @param Client $client Cliente HTTP configurado para a API Evolution Go.
     */
    public function __construct(private Client $client) {}

    /**
     * Cria uma nova instância no servidor.
     *
     * O token será gerado automaticamente usando UUID v4 se não for fornecido.
     *
     * Exemplo de proxy (opcional): {"host": "127.0.0.1", "port": 8080, "username": "user", "password": "pass"}
     *
     * @param string $name nome da instância.
     * @param array|null $proxy configuração de proxy (opcional).
     * @param string|null $token token customizado (será gerado automaticamente se omitido).
     * @return array|string resposta da API.
     */
    public function create(string $name, ?array $proxy = null, ?string $token = null): object
    {
        $token = $token ?? Uuid::uuid4()->toString();

        $payload = [
            'name' => $name,
            'token' => $token,
        ];

        if ($proxy !== null) {
            $payload['proxy'] = $proxy;
        }

        $result = $this->client->post('instance/create', $payload);

        $data = [];
        if (is_array($result) && isset($result['data']) && is_array($result['data'])) {
            $data = $result['data'];
        }

        return InstanciaAbstrata::fromArray($data);
    }

    /**
     * Retorna todas as instâncias cadastradas.
     *
     * @return array|string resposta com a lista de instâncias.
     */
    public function all(): array|string
    {
        return $this->client->get('instance/all');
    }

    /**
     * Busca os dados de uma instância e retorna um objeto InstanciaAbstrata.
     *
     * @param string $instanceId identificador da instância.
     * @return \Evoapigo\Abstrata\InstanciaAbstrata objeto com os dados da instância.
     */
    public function fetch(string $instanceId): \Evoapigo\Abstrata\InstanciaAbstrata
    {
        $result = $this->client->get(sprintf('instance/info/%s', urlencode($instanceId)));

        $data = [];
        if (is_array($result) && isset($result['data']) && is_array($result['data'])) {
            $data = $result['data'];
        }

        return InstanciaAbstrata::fromArray($data);
    }

    /**
     * Obtém logs de uma instância por ID.
     *
     * Query disponíveis:
     * - start_date: YYYY-MM-DD
     * - end_date: YYYY-MM-DD
     * - level: DEBUG,WARN,ERROR,INFO
     * - limit: número máximo de registros
     *
     * @param string $instanceId identificador da instância.
     * @param array $query parâmetros da consulta de logs.
     * @return array|string resposta de logs.
     */
    public function logs(string $instanceId, array $query = []): array|string
    {
        return $this->client->get(sprintf('instance/logs/%s', urlencode($instanceId)), $query);
    }

    /**
     * Exclui uma instância.
     *
     * @param string $instanceId identificador da instância.
     * @return bool dependendo da sucesso da exclusão.
     */
    public function delete(string $instanceId): bool
    {
        try {
            $return = $this->client->delete(sprintf('instance/delete/%s', urlencode($instanceId)));
            if ($this->client->getLastStatusCode() === 200) {
                return true;
            }
        } catch (EvoApiGoException $e) {
            // Log ou tratamento de erro pode ser feito aqui            
            return false;
        }
    }

    /**
     * Remove o proxy configurado para uma instância.
     *
     * @param string $instanceId identificador da instância.
     * @return array|string resposta da API.
     */
    public function deleteProxy(string $instanceId): array|string
    {
        return $this->client->delete(sprintf('instance/proxy/%s', urlencode($instanceId)));
    }

    /**
     * Conecta a instância com configurações de webhook / websocket / eventos.
     *
     * Payload de entrada exemplo:
     * {
     *   "subscribe": ["ALL"],
     *   "webhookUrl": "https://example.com/webhook"
     * }
     *
     * @param array $payload configuração de conexão.
     * @return array|string resposta da API.
     */
    public function connect(array $payload): array|string
    {
        return $this->client->post('instance/connect', $payload);
    }

    /**
     * Retorna o status atual da instância.
     *
     * @return array|string resposta com o status.
     */
    public function status(): array|string
    {
        return $this->client->get('instance/status');
    }

    /**
     * Retorna o QR code da instância.
     *
     * @return array|string resposta com o QR code.
     */
    public function qr(): array|string
    {
        return $this->client->get('instance/qr');
    }

    /**
     * Solicita o código de pareamento para o número informado.
     *
     * @param string $phone telefone no formato internacional.
     * @return array|string resposta da API.
     */
    public function pair(string $phone): array|string
    {
        return $this->client->post('instance/pair', ['phone' => $phone]);
    }

    /**
     * Desconecta a instância do serviço.
     *
     * @return array|string resposta da API.
     */
    public function disconnect(): array|string
    {
        return $this->client->post('instance/disconnect');
    }

    /**
     * Solicita reconexão da instância.
     *
     * @return array|string resposta da API.
     */
    public function reconnect(): array|string
    {
        return $this->client->post('instance/reconnect');
    }

    /**
     * Realiza logout da instância.
     *
     * @return array|string resposta da API.
     */
    public function logout(): array|string
    {
        return $this->client->delete('instance/logout');
    }

    /**
     * Força reconexão em uma instância específica.
     *
     * @param string $instanceId identificador da instância.
     * @return array|string resposta da API.
     */
    public function forceReconnect(string $instanceId): array|string
    {
        return $this->client->post(sprintf('instance/forcereconnect/%s', urlencode($instanceId)));
    }

    /**
     * Obtém as configurações avançadas de uma instância.
     *
     * @param string $instanceId identificador da instância.
     * @return array|string configuração avançada.
     */
    public function getAdvancedSettings(string $instanceId): array|string
    {
        return $this->client->get(sprintf('instance/%s/advanced-settings', urlencode($instanceId)));
    }

    /**
     * Atualiza as configurações avançadas de uma instância.
     *
     * Payload de entrada exemplo:
     * {
     *   "rejectCalls": false,
     *   "rejectCallMessage": "",
     *   "readMessages": false,
     *   "readStatus": false,
     *   "alwaysOnline": false
     * }
     *
     * @param string $instanceId identificador da instância.
     * @param array $payload configuração avançada.
     * @return array|string resposta da API.
     */
    public function updateAdvancedSettings(string $instanceId, array $payload): array|string
    {
        return $this->client->put(sprintf('instance/%s/advanced-settings', urlencode($instanceId)), $payload);
    }
}
