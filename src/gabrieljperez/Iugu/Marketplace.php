<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\BaseRequest;

/**
 * Class Marketplace.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Marketplace extends BaseRequest
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Listar subcontas
     * 
     * Lista as contas de um marketplace ou parceiro de negócios
     *
     * @return array
     */
    public function list()
    {
        $this->sendApiRequest('GET', 'marketplace');

        return $this->fetchResponse();
    }

    /**
     * create
     *
     * Cria um novo marketplace.
     *
     * @param array $params
     * @return array
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'marketplace/create_account');

        return $this->fetchResponse();
    }

    /**
     * Update
     *
     * Atualiza uma subconta.
     *
     * @param  int $id
     * @param  array $params 
     * @return array
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', "accounts/{$id}");

        return $this->fetchResponse();
    }

    /**
     * Envia uma verificação de subconta
     *
     * @param  int $id
     * @param  array $params 
     * @return array
     */
    public function requestVerification($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', "accounts/{$id}/request_verification");

        return $this->fetchResponse();
    }

    /**
     * Show
     *
     * Retorna os dados da subconta
     *
     * @param  int $id
     * @return array
     */
    public function show($id)
    {
        $this->sendApiRequest('GET', "accounts/{$id}");

        return $this->fetchResponse();
    }

    /**
     * requestWithdraw
     *
     * Faz um pedido de Saque de um valor.
     *
     * @param  int $id 
     * @param  array $params 
     * @return array
     */
    public function requestWithdraw($id, array $params)
    {
        $this->sendApiRequest('POST', "accounts/{$id}/request_withdraw");

        return $this->fetchResponse();
    }
}
