<?php

namespace App\Http\Controllers;

use App\Http\Resources\Contact as ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactsController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Contact::class);

        return ContactResource::collection($request->user()->contacts);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Contact::class);

        $contact = $request->user()->contacts()->create($this->validateData($request));

        return (new ContactResource($contact))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function validateData(Request $request)
    {
        return $request->validate(
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

        return new ContactResource($contact);
    }

    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($this->validateData($request));

        return (new ContactResource($contact))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $contact->delete();

        return response([], Response::HTTP_NO_CONTENT);
    }

}
