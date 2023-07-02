<?php

namespace App\Http\Controllers\Newsletter;

use App\Constants\ResponseConstants\NewsletterResponseEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Newsletter\NewsletterRequest;
use App\Http\Resources\NewsletterResource;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->execute(function () {
            $newsletters = Newsletter::all();
            return NewsletterResource::collection($newsletters);
        }, NewsletterResponseEnum::NEWSLETTER_LIST);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->execute(function () use ($request){
            $news = Newsletter::query()->create([
                'name' => $request->name,
                'email' => $request->email
            ]);
            return NewsletterResource::make($news);
        }, NewsletterResponseEnum::NEWSLETTER_CREATE);
    }

}
