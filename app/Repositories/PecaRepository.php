<?php


namespace App\Repositories;


use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Peca;
use App\Repositories\Interfaces\PecaRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PecaRepository implements PecaRepositoryInterface
{
    private $peca;
    private $endereco;
    private $contato;
    public const ADMIN = 1;

    public function __construct(Peca $peca, Endereco $endereco, Contato $contato)
    {
        $this->peca = $peca;
        $this->endereco = $endereco;
        $this->contato = $contato;
    }

    /**
     * Verifica se o tipo de usuário é um administrador
     * @return bool
     */
    private function checkIsAdmin()
    {
        $user = Auth::user();
        $role = $user->role->id;
        if ($role === self::ADMIN) {
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function all()
    {
        $pecas = $this->peca::with(['anunciante', 'contatos', 'endereco']);
        if (!$this->checkIsAdmin()) {
            $pecas->where(['anunciante_id' => Auth::id()]);
        }
        return $pecas->get();
    }

    /**
     * @inheritDoc
     */
    public function find($id)
    {
        $peca = $this->peca::with(['anunciante', 'contatos', 'endereco']);
        if (!$this->checkIsAdmin()) {
            $peca->where(['anunciante_id' => Auth::id()]);
        }
        return $peca->first();
    }

    /**
     * @inheritDoc
     */
    public function create(array $attribute)
    {
        try {
            if ($this->checkIsAdmin()) {
                throw new \PDOException('Somente anunciante pode criar um anuncio');
            }
            DB::beginTransaction();
            $endereco = $this->endereco->create($attribute['endereco']);
            $contato = $this->contato->create($attribute['contato']);
            $data = [
                'descricao' => $attribute['descricao'],
                'status' => 'aberto',
                'endereco_id' => $endereco->id,
                'contato_id' => $contato->id,
                'anunciante_id' => Auth::id()
            ];
            $peca = $this->peca->create($data);
            DB::commit();
            return $peca;
        } catch (\PDOException $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return false;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, array $attributes)
    {
        try {
            DB::beginTransaction();
            $peca = $this->peca->where(['id' => $id, 'anunciante_id' => Auth::id()])->first();
            if (isset($attributes['endereco'])) {
                $peca->endereco->update($attributes['endereco']);
            }
            if (isset($attributes['contato'])) {
                $peca->contatos->update($attributes['contato']);
            }
            unset($attributes['contato']);
            unset($attributes['endereco']);
            $peca->update($attributes);
            DB::commit();
            return $peca;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id)
    {
        try {
            $peca = $this->peca->where(['id' => $id, 'anunciante_id' => Auth::id()])->first();
            $peca->endereco->delete();
            $peca->contatos->delete();
            $peca->delete();
            return true;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
