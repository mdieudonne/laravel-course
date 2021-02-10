<?php

namespace App\Http\Controllers;

use App\Models\Contact;

class ContactsController extends Controller
{

    public function store()
    {
        Contact::create([
            'name' => request('name'),
        ]);
    }
}
