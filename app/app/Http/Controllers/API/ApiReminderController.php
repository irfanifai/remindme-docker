<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Repositories\ReminderRepository;
use App\Http\Requests\IndexReminderRequest;
use App\Http\Requests\DestroyReminderRequest;
use App\Http\Requests\ShowReminderRequest;
use App\Http\Requests\StoreReminderRequest;
use App\Http\Requests\UpdateReminderRequest;

/**
 * @OA\Info(
 *      title="Reminders API",
 *      version="1.0.0",
 *      description="API for managing reminders",
 *      @OA\Contact(
 *          email="hellol@irfanrifai.com",
 *          name="irfanrifai.com"
 *      )
 * )
*/

class ApiReminderController extends Controller
{
    protected $reminderRepository;

    public function __construct(ReminderRepository $reminderRepository)
    {
        $this->reminderRepository = $reminderRepository;
    }

    /**
     * @OA\Get(
     *      path="/api/v1/reminders",
     *      operationId="getRemindersList",
     *      tags={"Reminders"},
     *      summary="Get list of reminders",
     *      security={{"sanctum": {}}},
     *      @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad request"
     *      )
     * )
     *
     * @param IndexReminderRequest $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function index(IndexReminderRequest $request)
    {
        $reminders = $this->reminderRepository->getAll($request);
        if (isset($reminders['error'])) {
            return $this->errorResponse($reminders['data']);
        }

        return $this->successResponse($reminders);
    }

    /**
     * @OA\Get(
     *      path="/api/v1/reminders/{id}",
     *      operationId="getReminderById",
     *      tags={"Reminders"},
     *      summary="Get reminder information",
     *      @OA\Parameter(
     *          name="id",
     *          description="Reminder ID",
     *          required=false,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Reminder not found"
     *      )
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function show($id)
    {
        $reminder = $this->reminderRepository->getById($id);
        if (isset($reminder['error'])) {
            return $this->errorResponse($reminder['data']);
        }

        return $this->successResponse($reminder);
    }

    /**
     * @OA\Post(
     *      path="/api/v1/reminders",
     *      operationId="storeReminder",
     *      tags={"Reminders"},
     *      summary="Store a new reminder",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Data Form",
     *          @OA\JsonContent(
     *              required={"title", "description", "remind_at", "event_at"},
     *              @OA\Property(property="title", type="string", format="text", example="Example Title"),
     *              @OA\Property(property="description", type="string", format="text", example="Example Description"),
     *              @OA\Property(property="remind_at", type="integer", format="text", example="1702787876"),
     *              @OA\Property(property="event_at", type="integer", format="text", example="1702787876"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     *  *
     * @param StoreReminderRequest $request
     * @return \Illuminate\Http\JsonResponse
    */
    public function store(StoreReminderRequest $request)
    {
        $data = $request->only(['title', 'description', 'remind_at', 'event_at']);
        $reminder = $this->reminderRepository->create($data);
        if (isset($reminder['error'])) {
            return $this->errorResponse($reminder['data']);
        }

        return $this->successResponse($reminder);
    }

    /**
     * @OA\Put(
     *      path="/api/v1/reminders/{id}",
     *      operationId="updateReminder",
     *      tags={"Reminders"},
     *      summary="Update an existing reminder",
     *      @OA\Parameter(
     *          name="id",
     *          description="Reminder ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          description="Data Form",
     *          @OA\JsonContent(
     *              required={"title", "description", "remind_at", "event_at"},
     *              @OA\Property(property="title", type="string", format="text", example="Updated Title"),
     *              @OA\Property(property="description", type="string", format="text", example="Updated Description"),
     *              @OA\Property(property="remind_at", type="integer", format="text", example="1702787876"),
     *              @OA\Property(property="event_at", type="integer", format="text", example="1702787876"),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Reminder not found"
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Validation error"
     *      )
     * )
     *
     * @param UpdateReminderRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function update(UpdateReminderRequest $request, $id)
    {
        $data = $request->only(['title', 'description', 'remind_at', 'event_at']);
        $reminder = $this->reminderRepository->update($id, $data);
        if (isset($reminder['error'])) {
            return $this->errorResponse($reminder['data']);
        }

        return $this->successResponse($reminder);
    }

    /**
     * @OA\Delete(
     *      path="/api/v1/reminders/{id}",
     *      operationId="deleteReminder",
     *      tags={"Reminders"},
     *      summary="Delete a reminder",
     *      @OA\Parameter(
     *          name="id",
     *          description="Reminder ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(type="integer")
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object", @OA\Property(property="ok", type="boolean", example=true))
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Reminder not found"
     *      )
     * )
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
    */
    public function destroy($id)
    {
        $data = $this->reminderRepository->delete($id);
        if (isset($reminder['error'])) {
            return $this->errorResponse($reminder['data']);
        }

        return response()->json(['ok' => 'true']);
    }
}