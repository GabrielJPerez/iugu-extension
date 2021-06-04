<?php

namespace gabrieljperez\Iugu;

use bubbstore\Iugu\Services\BaseRequest;

/**
 * Class Split.
 *
 * @package namespace gabrieljperez\Iugu;
 */
class Split extends BaseRequest
{
    public function __construct($http, $iugu)
    {
        parent::__construct($http, $iugu);
    }

    /**
     * Permite a criação de multi splits para uma conta. 
     * Criar um novo multi split sobrepõe o que já está configurado. 
     * Todas as faturas pagas em uma conta irão respeitar as regras de splits criadas
     *
     * @param array $params 
     * @return array 
     */
    public function create(array $params)
    {
        $this->setParams(['split_rules' => $params])->sendApiRequest('POST', 'splits');

        return $this->fetchResponse();
    }

    /**
     * Consulta a lista de splits da conta.
     *
     * @return array
     */
    public function list()
    {
        $this->sendApiRequest('GET', 'splits');

        return $this->fetchResponse();
    }

    /**
     * Consulta um splits da conta.
     *
     * @param  string $id
     * @return array
     */
    public function search($id)
    {
        $this->sendApiRequest('GET', "splits/{$id}");

        return $this->fetchResponse();
    }

    /**
     * Consulta o split atualmente cadastrado na conta.
     *
     * @return array
     */
    public function current()
    {
        $this->sendApiRequest('GET', 'splits/current');

        return $this->fetchResponse();
    }

}
