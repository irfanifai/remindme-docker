<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reminder;
use Carbon\Carbon;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reminders = Reminder::orderBy('created_at', 'desc')->paginate(10);
        return view('reminder.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reminder.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'remind_at' => 'required',
            'event_at' => 'required',
        ]);

        $data = $request->all();
        $data['remind_at'] = Carbon::parse($data['remind_at'])->timestamp;
        $data['event_at'] = Carbon::parse($data['event_at'])->timestamp;

        $reminder = Reminder::create($data);

        return redirect()->route('reminder.index')->with('status', 'User successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reminder = Reminder::findOrFail($id);

        return view('reminder.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'remind_at' => 'required',
            'event_at' => 'required',
        ]);

        $reminder = Reminder::findOrFail($id);
        $reminder->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'remind_at' => Carbon::parse($request->input('remind_at'))->timestamp,
            'event_at' => Carbon::parse($request->input('event_at'))->timestamp,
        ]);

        $reminder->save();

        return redirect()->route('reminder.index')->with('status', 'Reminder successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reminder = Reminder::findOrFail($id);

        $reminder->delete();

        return redirect()->route('reminder.index')->with('status', 'Reminder successfully deleted');
    }
}
