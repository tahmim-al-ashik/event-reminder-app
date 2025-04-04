<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', auth()->id())
            ->orderBy('event_time', 'asc')
            ->get();

        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_time' => 'required|date',
            'email' => 'nullable|email',
        ]);

        Event::create([
            'event_id' => 'EVT-' . strtoupper(Str::random(6)),
            'title' => $request->title,
            'description' => $request->description,
            'event_time' => $request->event_time,
            'email' => $request->email,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function syncOffline(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_time' => 'required|date',
            'email' => 'nullable|email',
        ]);

        $data['event_id'] = 'EVT-' . strtoupper(Str::random(6));
        $data['user_id'] = auth()->id() ?? 1; // Use 1 for guest if not logged in

        Event::create($data);

        return response()->json(['message' => 'Event synced successfully.'], 201);
    }


    public function edit($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_time' => 'required|date',
            'email' => 'nullable|email',
        ]);

        $event = Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $event->update($request->only(['title', 'description', 'event_time', 'email']));

        return redirect()->route('events.index')->with('success', 'Event updated.');
    }

    public function destroy($id)
    {
        $event = Event::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted.');
    }

    public function upcoming()
    {
        $events = Event::where('user_id', auth()->id())
            ->where('event_time', '>=', now())
            ->orderBy('event_time', 'asc')
            ->get();

        return view('events.upcoming', compact('events'));
    }

    public function completed()
    {
        $events = Event::where('user_id', auth()->id())
            ->where('event_time', '<', now())
            ->orderBy('event_time', 'desc')
            ->get();

        return view('events.completed', compact('events'));
    }

    public function inviteForm($id)
    {
        $event = Event::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('events.invite', compact('event'));
    }

    public function sendInvite(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $event = Event::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // Send email
        \Mail::to($request->email)->send(new \App\Mail\EventInvitationMail($event));

        return redirect()->route('events.index')->with('success', 'Invitation sent!');
    }
}
