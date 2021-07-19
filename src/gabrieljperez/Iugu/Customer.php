<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\Customer as BaseCustomer;

/**
 * Class Customer.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Customer extends BaseCustomer
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Cria uma o Token que é uma representação do meio de pagamento do cliente
     * passando $test = true simula a criação do Token é uma representação do meio de pagamento do cliente
     *
     * @param  array   $params
     * @param  boolean $test
     * @return array
     */
    public function createPaymentToken(array $params, $test = false)
    {
        if ($test) {
            $params['test'] = true;
        }

        $this->setParams($params)->sendApiRequest('POST', 'payment_token');

        return $this->fetchResponse();
    }

    /**
     * Retorna os dados de uma Forma de Pagamento de um Cliente.
     *
     * @param  string $customer_id
     * @param  string $payment_method_id
     * @return void
     */
    public function searchPaymentMethod($customer_id, $payment_method_id)
    {
        $this->sendApiRequest('GET', "customers/{$customer_id}/payment_methods/{$payment_method_id}");

        return $this->fetchResponse();
    }

    /**
     * Retorna uma lista com todas as formas de pagamento de determinado Cliente.
     *
     * @param  string $customer_id
     * @return void
     */
    public function listPaymentMethods($customer_id)
    {
        $this->sendApiRequest('GET', "customers/{$customer_id}/payment_methods");

        return $this->fetchResponse();
    }
}
