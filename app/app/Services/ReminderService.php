<?php

namespace App\Services;

use App\Models\Reminder;
use Illuminate\Support\Facades\DB;

class ReminderService
{
    public function createReminder(array $data)
    {
        return DB::transaction(function () use ($data) {
            $reminder = Reminder::create($data);

            return [
                'id' => $reminder->id,
                'title' => $reminder->title,
                'description' => $reminder->description,
                'remind_at' => $reminder->remind_at,
                'event_at' => $reminder->event_at,
            ];
        });
    }

    public function updateReminder($id, array $data)
    {
        $reminder = Reminder::findOrFail($id);

        $reminder->update($data);

        return [
            'id' => $reminder->id,
            'title' => $reminder->title,
            'description' => $reminder->description,
            'remind_at' => $reminder->remind_at,
            'event_at' => $reminder->event_at,
        ];
    }

    public function getReminderById($id)
    {
        $reminder = Reminder::find($id);

        if ($reminder) {
            return [
                'id' => $reminder->id,
                'title' => $reminder->title,
                'description' => $reminder->description,
                'remind_at' => $reminder->remind_at,
                'event_at' => $reminder->event_at,
            ];
        } else {
            return [
                'error' => 404,
                'data' => 'Reminder not found',
            ];
        }
    }

    public function deleteReminder($id)
    {
        $reminder = Reminder::findOrFail($id);
        $reminder->delete();
    }
}
