<?php

namespace App\Services;

use App\Exceptions\ValidationError;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ContactService
{

    private $messages = [
        'email.required' => 'O campo email é obrigatório.',
        'name.required' => 'O campo nome é obrigatório.',
        'contact.required' => 'O campo contato é obrigatório.',
        'contact.numeric' => 'O campo contato precisa ser númérico',
        'contact.regex' => 'O campo contato precisa ser númérico',
        'contact.size' => 'O campo contato precisa ter 9 digitos',
        'email.email' => 'O email fornecido não é válido.',
    ];


    /**
     * Get all contacts
     * @return Contact[]|\Illuminate\Database\Eloquent\Collection
     */
    function getContacts()
    {
        return Contact::all();
    }

    /**
     * Create Contact
     * @param array $fields
     * @return void
     */
    public function create(array $fields)
    {

        $errors = $this->validateCreate($fields);

        if(!empty($errors)){
            throw new ValidationError('Erro na validação', $errors, '400');
        }

        return Contact::create($fields);
    }


    /**
     * @param array $fields
     * @return \Illuminate\Contracts\Validation\Validator|null
     */
    private function validateCreate(array $fields) {
        $validator = Validator::make($fields, [
            'email' => 'required|email',
            'name' => 'required',
            'contact' => ['required', 'regex:/^[0-9]+$/','size:9']
        ], $this->messages);

        if($validator->fails()){
            return $validator;
        }

        return null;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $contact = Contact::find($id);

        if(!$id || !$contact){
            throw new \Exception("Contato não encontrado.", 404);
        }

        return $contact->delete();
    }

    public function update(array $fields, $id)
    {

        $errors = $this->validateCreate($fields);

        if(!empty($errors)){
            throw new ValidationError('Erro na validação', $errors, '400');
        }

        $user = Contact::find($id);

        $user->name= $fields['name'];
        $user->email = $fields['email'];
        $user->contact = $fields['contact'];

        return $user->save();
    }
}
