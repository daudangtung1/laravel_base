<?php

namespace App\Http\Controllers;

use App\Service\ContactService;
use App\Service\PusherService;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected $contactService;
    protected $pusherService;

    public function __construct(
        ContactService $contactService,
        PusherService $pusherService
    ) {
        $this->contactService = $contactService;
        $this->pusherService = $pusherService;
    }

    public function index()
    {
        return view('pages.contact');
    }

    public function store(Request $request)
    {
        $input = $request->only([
            'name',
            'email',
            'content',
        ]);

        $create = $this->contactService->store($input);
        if (!$create) {
            return redirect()->back();
        }
        $response = [
            'message' => "Bạn có phản hồi mới!",
        ];
        $this->pusherService->sendNotification($response, 'contact-channel', 'contact-event');
        return redirect()->back();
    }
}
