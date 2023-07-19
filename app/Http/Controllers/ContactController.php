<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationError;
use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @var ContactService
     */

    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->contactService = $contactService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vars = array();

        $contacts = $this->contactService->getContacts();

        $vars['contacts'] = $contacts;

        $vars['message'] = null;
        $message = session('message');
        if ($message) {
            $vars['message'] = $message;
        }


        return view('contacts.listing', $vars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vars = array();
        $vars['title'] = 'Novo contato';
        $vars['action'] = route('store');
        $vars['method'] = 'post';

        return view('contacts.form', $vars);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->only(['name', 'email', 'contact']);

        try {
            $this->contactService->create($fields);

            return redirect()->route('index')
                ->with('message', array(
                    'type' => 'success',
                    'message' => 'Novo contato cadastrado com sucesso'
                ));

        } catch (\Exception $ex) {
            if ($ex instanceof ValidationError) {
                $validator = $ex->getValidator();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vars = array();
        $vars['id'] = $id;
        $vars['action'] = route('update_contact', $id);
        $vars['method'] = 'put';

        $contact = Contact::find($id);
        $vars['contact'] = $contact;

        return view('contacts.form', $vars);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fields = $request->only(['name', 'contact', 'email']);

        try {
            $this->contactService->update($fields, $id);
            return redirect()->route('index')
                ->with('message', array(
                    'type' => 'success',
                    'message' => 'Usuario modificado com sucesso.'
                ));

        } catch (\Exception $ex) {
            if ($ex instanceof ValidationError) {
                $validator = $ex->getValidator();
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                return redirect()->route('index')
                    ->with('message', array(
                        'type' => 'danger',
                        'message' => $ex->getMessage()
                    ));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->contactService->delete($id);
            return redirect()->route('index')->with('message', array(
                'type' => 'success',
                'message' => 'Cadastro excluido com sucesso.'
            ));
        } catch (\Exception $ex) {
            return redirect()->route('index')
                ->with('message', array(
                    'type' => 'danger',
                    'message' => $ex->getMessage()
                ));
        }

    }
}
