@extends('layout')

@section('content')
    <div class="container p-2">
        <div class="d-flex justify-content-end">
            <a href="{{ url('/new') }}" class="btn btn-success actions" title="Novo contato">
                <span class="fas fa-plus"></span>
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Contato</th>
                <th>Email</th>
                <th></th>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
            <tr class=" align-middle">
                <td>{{ $contact['id'] }}</td>
                <td>{{ $contact['name'] }}</td>
                <td>{{ $contact['contact'] }}</td>
                <td>{{ $contact['email'] }}</td>
                <td class="col-2">
                    <a class="btn btn-primary actions" title="Editar contato">
                        <span class="fas fa-edit"></span>
                    </a>
                    <a class="btn btn-danger actions" title="Remover contato">
                        <span class="fas fa-trash"></span>
                    </a>
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
