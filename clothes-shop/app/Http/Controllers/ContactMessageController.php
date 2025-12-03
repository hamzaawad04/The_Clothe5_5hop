<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ContactMessageController extends Controller
{
    /**
     *  Create view for the contact page
     *  
     *  @return Illuminate\View\View
     */

    public function create() {
        return view('contact');
    }


    /**
     *  Store contact data
     *  
     *  @param Illuminate\Http\Request : $request
     *  @return Illuminate\View\View
     */

    public function store(Request $request) {

        $contactMessage = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'message' => 'required|string|max:500',
            'status' => 'required|in:new,in_progress,closed'
        ]);

        // Get user id if possible
        $contactMessage['user_id'] = Auth::id();

        ContactMessage::create($contactMessage);

        //  Return back to home page
        return redirect()
        ->route('index');
    }
}
