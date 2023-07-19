@extends('layout')

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Exclusão de contato</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja realmente excluir esse registro?
                </div>
                <div class="modal-footer">
                    <button  id="btn-yes"  class="btn btn-success" data-bs-dismiss="modal">
                        Sim
                    </button>
                    <button class="btn btn-danger" data-bs-dismiss="modal">
                        Não
                    </button>
                </div>
            </div>
        </div>
    </div>

    @if($message)
        <div class="p-2">
            <div class="alert alert-{{$message['type']}}">
                {{$message['message']}}
            </div>
        </div>
    @endif

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
                <td class=" col-2 ">
                    <div class="d-flex gap-2">

                        <a href="{{route('edit_contact', $contact['id'])}}" class="btn col-3  btn-primary actions" title="Editar contato">
                            <span class="fas fa-edit fa-xs"></span>
                        </a>

                        <button id="{{ $contact['id'] }}" class="btn col-3 btn-xs btn-danger actions btn-delete" title="Remover contato" data-bs-toggle="modal" data-bs-target="#modalDelete">
                            <span class="fas fa-trash fa-xs"></span>
                        </button>

                        <form id="frm-delete-{{$contact['id']}}" method="DELETE" action="{{ route('delete_contact', $contact['id'] ) }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>

                </td>
            </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script>
        const btnYes = document.querySelector('#btn-yes');
        const btnDeleteArr = document.querySelectorAll('.btn-delete')
        let currentId = null;

        if(btnDeleteArr){
            btnDeleteArr.forEach(el => {
                el.addEventListener( 'click',  () => {
                    const id = el.getAttribute('id')
                    currentId = id;
                })
            })
        }

        if(btnYes){
            btnYes.addEventListener('click', () => {
                const targetFrm = document.querySelector(`#frm-delete-${currentId}`)
                if(targetFrm){
                    targetFrm.submit();
                }
            })
        }


    </script>
@endpush
