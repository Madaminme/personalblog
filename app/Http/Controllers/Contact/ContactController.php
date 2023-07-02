<?php

namespace App\Http\Controllers\Contact;

use App\Constants\ResponseConstants\ContactResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return $this->execute(function (){
            $contact = Contact::all();
            return ContactResource::collection($contact);
        }, ContactResponseEnum::CONTACT_LIST);
    }

    public function store(ContactRequest $request)
    {
        return $this->execute(function () use ($request){
            $validated = $request->validated();
            $contact = Contact::query()->create($validated);
            return ContactResource::make($contact);
        }, ContactResponseEnum::CONTACT_CREATE);
    }
}
