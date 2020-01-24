@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Anuncios de Droids</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Anunciante</th>
                            <th>Descrição</th>
                            <th>Email</th>
                            <th>Endereço</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @isset($pecas)
                            @foreach($pecas as $peca)
                            <tr>
                                <td>{{ $peca->anunciante->name }}</td>
                                <td>{{ $peca->descricao  }}</td>
                                <td>{{ $peca->contatos->email }}</td>
                                <td>{{ $peca->endereco->logradouro  }}</td>
                                <td>
                                    <span class="{{ $peca->status === 'aberto' ? 'status-aberto' : 'status-finalizado' }}"></span>
                                </td>
                            </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
