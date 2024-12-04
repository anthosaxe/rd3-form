<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * Display a listing of the channels.
     */
    public function index()
    {
        $channels = Channel::all();
        return response()->json($channels);
    }

    /**
     * Store a newly created channel in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $channel = Channel::create($validatedData);

        return response()->json($channel, 201);
    }

    /**
     * Display the specified channel.
     */
    public function show(Channel $channel)
    {
        return response()->json($channel);
    }

    /**
     * Update the specified channel in storage.
     */
    public function update(Request $request, Channel $channel)
    {
        $validatedData = $request->validate([
            'nom' => 'sometimes|string|max:255',
        ]);

        $channel->update($validatedData);

        return response()->json($channel);
    }

    /**
     * Remove the specified channel from storage.
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();

        return response()->json(null, 204);
    }
}

