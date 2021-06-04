<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\BaseRequest;

/**
 * Class Plan.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Plan extends BaseRequest
{
    
    /**
     * Plan constructor
     *
     * @param string $http
     * @param string $iugu
     */
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Retorna uma lista com todos os planos em sua conta ordenadas pela data de Criação, 
     * sendo o primeiro o criado mais recentemente. O campo totalItems contém sempre a quantidade de planos cadastrados,
     * independente dos parâmetros de pesquisa utilizados e o resultado da pesquisa fica sempre dentro de items.
     *
     * @return array
     */
    public function list()
    {
        $this->sendApiRequest('GET', 'plans');

        return $this->fetchResponse();
    }

    /**
     * Cria um plano.
     *
     * @param array $params 
     * @return array 
     */
    public function create(array $params)
    {
        $this->setParams($params)->sendApiRequest('POST', 'plans');

        return $this->fetchResponse();
    }

    /**
     * Altera os dados de um Plano, 
     * quaisquer parâmetros não informados não serão alterados. 
     * As alterações não irão mudar as Assinaturas que já utilizam o Plano, mas só as novas.
     *
     * @param  int   $id
     * @param  array $params
     * @return array
     */
    public function update($id, array $params)
    {
        $this->setParams($params)->sendApiRequest('PUT', "plans/{$id}");

        return $this->fetchResponse();
    }

    /**
     * Retorna os dados de um Plano.
     *
     * @param  int   $id
     * @return array
     */
    public function get($id)
    {
        $this->sendApiRequest('GET', "plans/{$id}");

        return $this->fetchResponse();
    }
    
    /**
     * Retorna os dados de um Plano.
     *
     * @param  int   $identifier
     * @return array
     */
    public function getByIdentifier($identifier)
    {
        $this->sendApiRequest('GET', "plans/identifier/{$identifier}");

        return $this->fetchResponse();
    }

    /**
     * Remove os dados de um Plano
     *
     * @param  int   $id
     * @return array
     */
    public function destroy($id)
    {
        $this->sendApiRequest('DELETE', "plans/{$id}");

        return $this->fetchResponse();
    }

}
