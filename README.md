# Iugu-extension

Biblioteca base utilizada [bubbstore/iugu-php-sdk](https://github.com/bubbstore/iugu-php-sdk)

Biblioteca que realiza integração com a API da [Iugu](http://www.iugu.com)

[![StyleCI](https://styleci.io/repos/140902040/shield?branch=master)](https://styleci.io/repos/140902040)

## Instalação via composer

```bash
$ composer require gabrieljperez/iugu-extension
```

## Serviços

Este SDK extende os seguintes serviços:

- [Marketplace/Ações da Conta Mestre](https://dev.iugu.com/reference#criar-subconta)
- [Split](https://dev.iugu.com/reference#criar-split-1)
- [Relatórios](hhttps://dev.iugu.com/reference#extrato-financeiro)

[Referência da API](https://dev.iugu.com/reference)  
[Documentação bubbstore/iugu-php-sdk](https://github.com/bubbstore/iugu-php-sdk)

### Configuração

Para utilizar este SDK, será necessário inserir em seu .env

```php
IUGU_API_KEY=CHAVE_API_IUGU
IUGU_API_TEST_KEY=CHAVE_DE_TEST_API_IUGU
IUGU_ACCOUNT_ID=ID_DA_CONTA_MASTER
```

Ao realizar use das classes, será necessario fazer o seguinte e instaciar a classe iugu

```php
use gabrieljperez\Iugu\Iugu;
use bubbstore\Iugu\Exceptions\IuguException;
use bubbstore\Iugu\Exceptions\IuguValidationException;

$iugu = new Iugu;
// Também possivel setar apitoken na chamada da classe
$iugu = new Iugu('apiKey');
```

### MarketPlace

#### Listar subcontas

```php
$response = $iugu->marketplace()->list();

// Imprime uma lista de subcontas
echo $response;
```

#### Criar MarketPlace

- [parametros](https://dev.iugu.com/reference#criar-subconta)

```php
$response = $iugu->marketplace()->create([
    'parametros'
]);

// Imprime o ID da subconta
dd($response);
```

#### Editar MarketPlace

- [parametros](https://dev.iugu.com/reference#atualizar-subconta)

```php
$response = $iugu->marketplace()->update('SUBCONTA_ID',[
    'parametros'
]);

// Imprime a subconta atualizada
dd($response);
```

#### Enviar verificação de subconta
- [parametros](https://dev.iugu.com/reference#enviar-verificacao-de-conta)
```php
$response = $iugu->marketplace()->requestVerification('SUBCONTA_ID',[
    'parametros'
]);

dd($response);
```

#### Ver subconta

- [parametros](https://dev.iugu.com/reference#atualizar-subconta)

```php
$response = $iugu->marketplace()->show('SUBCONTA_ID');

dd($response);
```

#### Pedido de saque

```php
$response = $iugu->marketplace()->requestWithdraw('SUBCONTA_ID');

dd($response);

```

### Master


### Multi Split
:warning: Criar um novo multi split sobrepõe o que já está configurado. Todas as faturas pagas em uma conta irão respeitar as regras de splits criadas.
#### Criar split
- [parametros](https://dev.iugu.com/reference#criar-split-1)
```php
$response = $iugu->split()->create(['parametros']);

dd($response);
```

#### Listar splits

```php
$response = $iugu->split()->list();

dd($response);
```

#### Visualizar split

```php
$response = $iugu->split()->search('split_id');

dd($response);
```

#### Consultar splits

```php
$response = $iugu->split()->current('split_id');

dd($response);
```

## Faturas

#### Criar fatura

```php
$invoice = $iugu->invoice()->create([
    'order_id' => uniqid(),
    'email' => 'lucas@bubb.com.br',
    'due_date' => '2018-07-14',
    'notification_url' => 'https://webhook.site/08703bf2-d408-4f4c-b91c-0bc8e14352b2',
    'fines' => false,
    'per_day_interest' => false,
    'discount_cents' => 500,
    'ignore_due_email' => true,
    'payable_with' => 'bank_slip',
    'items' => [
        [
            'description' => 'Item 1',
            'quantity' => 1,
            'price_cents' => 1000
        ],
        [
            'description' => 'Item 2',
            'quantity' => 2,
            'price_cents' => 2000
        ],
        [
            'description' => 'Frete',
            'quantity' => 1,
            'price_cents' => 1000
        ],
    ],
    'payer' => [
        'cpf_cnpj' => '65634052076',
        'name' => 'Lucas Colette',
        'phone_prefix' => '11',
        'phone' => '11111111',
        'email' => 'lucas@bubb.com.br',
        'address' => [
            'street' => 'Foo Bar',
            'number' => '123',
            'district' => 'Foo',
            'city' => 'Foo',
            'state' => 'SP',
            'zip_code' => '14940000',
        ],
    ],
]);

// Imprime o ID da fatura
echo $invoice['id'];
```

#### Capturar fatura

```php
$iugu->invoice()->capture('ID_FATURA');
```

#### Buscar fatura

```php
$iugu->invoice()->find('ID_FATURA');
```

#### Reembolsar fatura

```php
$iugu->invoice()->refund('ID_FATURA');
```

#### Cancelar fatura

```php
$iugu->invoice()->cancel('ID_FATURA');
```

## Métodos de pagamento

#### Criar método de pagamento

```php
$payment = $iugu->paymentMethod()->create('ID_CLIENTE', [
    'description' => 'Cartão de Crédito',
    'token' => '123456',
]);

// Imprime o ID do pagamento
echo $payment['id'];
```

#### Atualizar método de pagamento

```php
$iugu->paymentMethod()->update('ID_CLIENTE', 'ID_METODO_PAGAMENTO', [
    'description' => 'Outra description',
]);
```

#### Buscar método de pagamento

```php
$iugu->paymentMethod()->find('ID_CLIENTE', 'ID_METODO_PAGAMENTO');
```

#### Excluir método de pagamento

```php
$iugu->paymentMethod()->delete('ID_CLIENTE', 'ID_METODO_PAGAMENTO');
```

## Testando

```bash
$ composer test
```

## Change log

Consulte [CHANGELOG](.github/CHANGELOG.md) para obter mais informações sobre o que mudou recentemente.

## Contribuindo

Consulte [CONTRIBUTING](.github/CONTRIBUTING.md) para obter mais detalhes.

## Segurança

Se você descobrir quaisquer problemas relacionados à segurança, envie um e-mail para contato@bubbstore.com.br em vez de usar as issues.