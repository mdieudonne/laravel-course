<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        return request()->user()->contacts;
    }

    public function store()
    {
        $this->authorize('create', Contact::class);
        request()->user()->contacts()->create($this->validateData());
    }

    public function validateData()
    {
        return request()->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'birthday' => 'required',
                'company' => 'required',
            ]
        );
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return $contact;
    }

    public function update(Contact $contact)
    {
        $this->authorize('update', $contact);
        $contact->update($this->validateData());
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $contact->delete();
    }

}
