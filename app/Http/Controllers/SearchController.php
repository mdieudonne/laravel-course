<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Resources\Contact as ResourceContact;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate([
            'searchTerm' => 'required',
        ]);

        $contacts = Contact::search($data['searchTerm'])
            ->where('user_id', $request->user()->id)
            ->get();

        return ResourceContact::collection($contacts);
    }
}
