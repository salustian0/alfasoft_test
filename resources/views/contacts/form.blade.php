@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <form method="post" action="{{url('store')}}">
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" id="name" class="form-control" placeholder="Nome do contato">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="email"  class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="Ex: email@email.com">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="contact" class="form-label">Contato</label>
                            <input type="text" id="contact" class="form-control" placeholder="11 0 0000-0000">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Cadastrar</button>

                </form>
            </div>
        </div>

    </div>
@endsection
