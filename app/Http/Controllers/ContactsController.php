<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactsController extends Controller
{
    public function index()
    {
        return request()->user()->contacts;
    }

    public function store()
    {
        Contact::create($this->validateData());
    }

    public function show(Contact $contact)
    {
        return $contact;
    }

    public function update(Contact $contact)
    {
        $contact->update($this->validateData());
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
    }

    public function validateData()
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'company' => 'required',
        ]);
    }

}
