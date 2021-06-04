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
     *
     * @param array $params
     * @return array
     */
    public function createPaymentToken(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'payment_token');

        return $this->fetchResponse();
    }

    /**
     * Simula a criação do Token é uma representação do meio de pagamento do cliente
     *
     * @param  array $params
     * @return array
     */
    public function createPaymentTokenSimulation(array $param) 
    {
        $params['test'] = true;
        return $this->createPaymentToken($params);
    }

    /**
     * Cria ou simula a criação de um token de pagamento filtrando
     * pelo debug do projeto (dev || prod)
     *
     * @param  array $params
     * @return array
     */
    public function createPaymentTokenDebug(array $params) 
    {
        if (config('app.debug')) {
            return createPaymentTokenSimulation($params);
        } else {
            return createPaymentToken($params);
        }
    }

}
