<?php


namespace App\Services;


use App\Repositories\Interfaces\PecaRepositoryInterface;
use Illuminate\Http\Request;

class PecaService
{
    protected $pecaRepository;

    public function __construct(PecaRepositoryInterface $pecaRepository)
    {
        $this->pecaRepository = $pecaRepository;
    }

    public function all()
    {
        return $this->pecaRepository->all();
    }

    public function find($id)
    {
        return $this->pecaRepository->find($id);
    }

    public function create(Request $request)
    {
        $pecas = $request->except(['query_string']);
        return $this->pecaRepository->create($pecas);
    }

    public function update(Request $request, $id)
    {
        $peca = $request->except(['query_string']);
        return $this->pecaRepository->update($id, $peca);
    }

    public function delete($id)
    {
        return $this->pecaRepository->delete($id);
    }
}
