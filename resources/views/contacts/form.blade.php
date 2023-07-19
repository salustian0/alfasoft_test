@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 m-auto">
                <form method="{{$method}}" action="{{$action}}">
                    @csrf
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input name="name" type="text" id="name" class="form-control  @if($errors->has('name')) is-invalid @endif" placeholder="Nome do contato" value="{{ old('name', isset($contact) ? $contact['name'] : '') }}">
                            @if($errors->has('name'))
                                <div  class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>
                        <div class="col-6 mb-3">
                            <label for="email"  class="form-label">Email</label>
                            <input name="email" type="email" id="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="Ex: email@email.com" value="{{ old('email' , isset($contact) ? $contact['email'] : '') }}">
                            @if($errors->has('email'))
                                <div  class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="contact" class="form-label">Contato</label>
                            <input name="contact"  maxlength="9" type="text" id="contact" class="form-control  @if($errors->has('contact')) is-invalid @endif" placeholder="11 0 0000-0000" value="{{ old('contact', isset($contact) ? $contact['contact'] : '') }}">
                            @if($errors->has('contact'))
                                <div  class="invalid-feedback">
                                    {{ $errors->first('contact') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        @if(isset($id))
                            Atualizar
                        @else
                            Cadastrar
                        @endif
                    </button>

                </form>
            </div>
        </div>

    </div>
@endsection
