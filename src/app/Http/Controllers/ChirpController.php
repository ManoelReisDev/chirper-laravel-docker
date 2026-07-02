<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps = Chirp::with('user')
            ->latest()
            ->take(50)
            ->get();

        return view('home', compact('chirps'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'message' => 'required|string|max:255',
            ],
            [
                'message.required' => 'Please write something to chirp!',
                'message.max' => 'Chirps must be 255 characters or less.',
            ],
        );

        \App\Models\Chirp::create([
            'message' => $validated['message'],
            'user_id' => null,
        ]);


        return redirect('/')->with('success', 'Chirp created!');
    }
}
