<?php

namespace App\Http\Controllers;

use App\Services\PecaService;
use Illuminate\Http\Request;

class PecaController extends Controller
{
    protected $pecaService;

    public function __construct(PecaService $pecaService)
    {
        $this->pecaService = $pecaService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pecas = $this->pecaService->all();
        return response()->json($pecas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $created = $this->pecaService->create($request);
        if (!$created) {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível criar o anuncio.'
            ],500);
        }
        return response()->json([
            'success' => true,
            'Anuncio criado com sucesso',
            'data' => $created
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peca = $this->pecaService->find($id);
        return response()->json($peca);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $updated = $this->pecaService->update($request, $id);
        if (!$updated) {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível atualizar o anuncio.'
            ],500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Anuncio atualizado com sucesso.'
        ],201);
    }

    /**
     * Finaliza um anuncio
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function finaliza(Request $request, $id)
    {
        $request->merge(['status' => 'finalizado']);
        return $this->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->pecaService->delete($id);
        if (!$deleted) {
            return response()->json([
                'success' => false,
                'message' => 'Não foi possível excluir o anuncio.'
            ],500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Anuncio excluido com sucesso.'
        ],201);
    }
}
