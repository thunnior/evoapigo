# EvoApiGo PHP SDK

SDK simples para acessar a API Evolution GO via PHP.

## Instalação

Adicione esta biblioteca ao seu projeto ou use `composer install`

## Uso
- Observar o Arquivo Principal da Evolution GO para envio correto dos <b>Playload<b>


```php
require_once __DIR__ . '/vendor/autoload.php';

use Evoapigo\EvoApiGo;

$api = new EvoApiGo('https://api.evolution-go.example.com', 'YOUR_API_KEY');

//Retorna um Objeto da Instância da Conexão
$response = $api->instance->create( 'name' => 'Teste' );

print_r($response);
```

## Recursos

- `instance` - gerencia instâncias
- `send` - envio de texto, mídia, links, botões, listas
- `user` - informações de usuário, bloqueios e perfil
- `message` - reações, presença, leitura e edição
- `chat` - fixar, arquivar, silenciar e sincronizar histórico
- `group` - gerenciamento de grupos
- `server` - verificação de saúde do servidor

## Funções
- Instância
```php
    - create(string $name, ?array $proxy = null, ?string $token = null)
    - all()
    - fetch(string $instanceId)
    - logs(string $instanceId, array $query = [])
    - delete(string $instanceId)
    - deleteProxy(string $instanceId)
    - connect(array $payload)
    - status()
    - qr()
    - pair(string $phone)
    - disconnect()
    - reconnect()
    - logout()
    - forceReconnect(string $instanceId)
    - getAdvancedSettings(string $instanceId)
    - updateAdvancedSettings(string $instanceId, array $payload)
```
- Envio
```php
    - sendText(array $payload)
    - sendLink(array $payload)
    - sendMedia(array $payload)
    - sendPoll(array $payload)
    - sendSticker(array $payload)
    - sendLocation(array $payload)
    - sendContact(array $payload)
    - sendButton(array $payload)
    - sendList(array $payload)
    - sendCarousel(array $payload)
```
- Usuário
```php
    - info()
    - check()
    - avatar()
    - contacts()
    - privacySettings()
    - blockContact(array $payload)
    - unblockContact(array $payload)
    - blockList()
    - setProfilePicture(array $payload)
    - setProfileName(array $payload)
    - setProfileStatus(array $payload)
```
- Mensagem
```php
    - react(array $payload)
    - sendPresence(array $payload)
    - markAsRead(array $payload)
    - downloadMedia(array $payload)
    - status(array $payload)
    - delete(array $payload)
    - edit(array $payload)
```
- Chat
```php
    - pin(array $payload)
    - unpin(array $payload)
    - archive(array $payload)
    - unarchive(array $payload)
    - mute(array $payload)
    - unmute(array $payload)
    - historySync(array $payload)
```
- Grupo
```php
    - listGroups()
    - info(array $payload)
    - inviteLink(array $payload)
    - setPhoto(array $payload)
    - setName(array $payload)
    - setDescription(array $payload)
    - create(array $payload)
    - updateParticipant(array $payload)
    - myGroups()
    - join(array $payload)
    - leave(array $payload)
```
- Servidor
```php
    - health()
```

- Contato
💻 GitHub: thunnior

📧 Email: thalesjunior.moreira@gmail.com

☕ Buy me a coffee

Sponsor me
