<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\BaseRequest;

/**
 * Class Report.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Report extends BaseRequest
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Retorna a lista de todas as transferências bancárias.
     *
     * @return array
     */
    public function listWithdrawRequests()
    {
        $this->sendApiRequest('GET', 'withdraw_requests');

        return $this->fetchResponse();
    }

    /**
     * Retorna as informações de uma transferência bancária.
     *
     * @param  int $id
     * @return array
     */
    public function getWithdrawRequests($id)
    {
        $this->sendApiRequest('GET', sprintf('withdraw_requests/$s', $id));

        return $this->fetchResponse();
    }

    /**
     * Retorna o extrato financeiro de uma conta.
     *
     * @param  array $params
     * @return array
     */
    public function financialStatement(array $params = [])
    {
        $this->setParams($params)->sendApiRequest('GET', 'accounts/financial');

        return $this->fetchResponse();
    }

    /**
     * Retorna o extrato de faturas de uma conta.
     *
     * @param  array $params
     * @return array
     */
    public function invoicesStatement(array $params = [])
    {
        $this->setParams($params)->sendApiRequest('GET', 'accounts/invoices');

        return $this->fetchResponse();
    }

    /**
     * Retorna todos os pedidos de saques criados em ambiente de produção (LIVE) 
     * que tenham um determinado status e tenham sido atualizados em determinado período (entre frome to).
     * No caso de marketplaces ou parceiros de negócios, 
     * retorna também os pedidos de saques de subcontas que atendam a esses critérios.
     *
     * @param  int  $start 
     * @param  int  $limit 
     * @return array 
     */
    public function withdrawConciliations($start, $limit)
    {
        $this->sendApiRequest('GET', "withdraw_conciliations?start={$start}&limit={$limit}");

        return $this->fetchResponse();
    }

    /**
     * Listar pagamentos
     *
     * @return array
     */
    public function paymentRequests()
    {
        $this->sendApiRequest('GET', 'payment_requests');

        return $this->fetchResponse();
    }

    /**
     * Buscar pagamento
     *
     * @param  string $id 
     * @return array 
     */
    public function searchPayment($id)
    {
        $this->sendApiRequest('GET', "payment_requests/{$id}");

        return $this->fetchResponse();
    }
}