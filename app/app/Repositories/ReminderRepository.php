<?php

namespace App\Repositories;

use App\Models\Reminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ReminderRepository
{
    public function create(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {
                $reminder = Reminder::create($data);

                $data = [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'description' => $reminder->description,
                    'remind_at' => $reminder->remind_at,
                    'event_at' => $reminder->event_at,
                ];

                return $data;
            });
        } catch (Exception $e) {
            $data = ['error' => 406, 'data' => $e->getMessage()];
            return $data;  
        }
    }

    public function getAll($request)
    {
        try {
            $limit = $request->input('limit', 5); 
            $reminders = Reminder::take($limit)->get();

            $data = $reminders->map(function ($reminder) {
                return [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'description' => $reminder->description,
                    'remind_at' => $reminder->remind_at,
                    'event_at' => $reminder->event_at,
                ];
            });            
            
            $data = ['reminders' => $data, 'limit' => (int)$limit];
            return $data;
        } catch (\Illuminate\Http\Exception\HttpResponseException $e) {
            throw $e;
        } catch (Exception $e) {
            $data = ['error' => 406, 'data' => $e->getMessage()];
            return $data;        
        }
    }

    public function getById($id)
    {
        try {
            $reminder = Reminder::find($id);
            if ($reminder) {
                $data = [
                    'id' => $reminder->id,
                    'title' => $reminder->title,
                    'description' => $reminder->description,
                    'remind_at' => $reminder->remind_at,
                    'event_at' => $reminder->event_at,
                ];

                return $data;
            } else {
                $message = 'Data reminder not found';
                $data = ['error' => 404, 'data' => $message];
                return $data;
            }
        } catch (Exception $e) {
            $data = ['error' => 406, 'data' => $e->getMessage()];
            return $data;  
        }
    }

    public function update($id, array $data)
    {
        try {
            $reminder = Reminder::findOrFail($id);
            $reminder->update($data);
            $data = [
                'title' => $reminder->title,
                'description' => $reminder->description,
                'remind_at' => $reminder->remind_at,
                'event_at' => $reminder->event_at,
            ];
            return $data;
        } catch (ModelNotFoundException $e) {
            $message = 'Reminder not found';
            $data = ['error' => 404, 'data' => $message];
            return $data;
        }
    }

    public function delete($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $reminder = Reminder::findOrFail($id);
                $reminder->delete();
            });
        } catch (Exception $e) {
            $data = ['error' => 406, 'data' => $e->getMessage()];
            return $data;  
        }
    }
}
