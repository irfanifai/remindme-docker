<?php

use App\Models\Reminder;
use App\Services\ReminderService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReminderServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateReminder()
    {
        $service = new ReminderService();
        $data = [
            'title' => 'Meeting with Bob',
            'description' => 'Discuss about a new project related to a new system',
            'remind_at' => now()->addDay()->timestamp,
            'event_at' => now()->addWeek()->timestamp,
        ];

        $result = $service->createReminder($data);

        $this->assertDatabaseHas('reminders', $data);

        $expected = [
            'id' => 1,
            'title' => $data['title'],
            'description' => $data['description'],
            'remind_at' => $data['remind_at'],
            'event_at' => $data['event_at'],
        ];

        $this->assertEquals($expected, $result);
    }

    public function testUpdateReminder()
    {
        $reminder = Reminder::factory()->create();
        $service = new ReminderService();
        $data = [
            'title' => 'Updated Meeting',
            'description' => 'Updated description',
            'remind_at' => now()->addDay()->timestamp,
            'event_at' => now()->addWeek()->timestamp,
        ];

        $result = $service->updateReminder($reminder->id, $data);

        $this->assertDatabaseHas('reminders', $data);

        $expected = [
            'id' => $reminder->id,
            'title' => $data['title'],
            'description' => $data['description'],
            'remind_at' => $data['remind_at'],
            'event_at' => $data['event_at'],
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetReminderById()
    {
        $reminder = Reminder::factory()->create();
        $service = new ReminderService();

        $result = $service->getReminderById($reminder->id);

        $expected = [
            'id' => $reminder->id,
            'title' => $reminder->title,
            'description' => $reminder->description,
            'remind_at' => $reminder->remind_at,
            'event_at' => $reminder->event_at,
        ];

        $this->assertEquals($expected, $result);
    }

    public function testGetReminderByIdNotFound()
    {
        $service = new ReminderService();

        $result = $service->getReminderById(999);

        $expected = [
            'error' => 404,
            'data' => 'Reminder not found',
        ];

        $this->assertEquals($expected, $result);
    }

    public function testDeleteReminder()
    {
        $reminder = Reminder::factory()->create();
        $service = new ReminderService();

        $service->deleteReminder($reminder->id);

        $this->assertDatabaseMissing('reminders', ['id' => $reminder->id]);
    }
}
