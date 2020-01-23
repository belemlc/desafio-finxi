<?php


namespace App\Repositories\Interfaces;

use App\Models\Peca;

interface PecaRepositoryInterface
{
    /**
     * Lista  todas as pecas
     * @return mixed
     */
    public function all();

    /**
     * Busca uma peça por id
     * @param Peca $peca
     * @return mixed
     */
    public function find(Peca $peca);

    /**
     * Adiciona uma peça
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Atualiza uma peça
     * @param int $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * Exclui uma peça
     * @param int $id
     * @return mixed
     */
    public function delete(int $id);
}
