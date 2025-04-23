<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationController extends Controller
{
    /**
     * Display a listing of the notifications.
     */
    public function index()
    {
        $notifications = Notification::all();
        return response()->json($notifications, Response::HTTP_OK);
    }

    /**
     * Store a newly created notification in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:utilisateurs,id',
            'read_at' => 'nullable|date',
        ]);

        $notification = Notification::create($validatedData);

        return response()->json($notification, Response::HTTP_CREATED);
    }

    /**
     * Display the specified notification.
     */
    public function show($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($notification, Response::HTTP_OK);
    }

    /**
     * Update the specified notification in storage.
     */
    public function update(Request $request, $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'titre' => 'sometimes|required|string|max:255',
            'message' => 'sometimes|required|string',
            'type' => 'sometimes|required|string|max:255',
            'user_id' => 'sometimes|required|integer|exists:utilisateurs,id',
            'read_at' => 'nullable|date',
        ]);

        $notification->update($validatedData);

        return response()->json($notification, Response::HTTP_OK);
    }

    /**
     * Remove the specified notification from storage.
     */
    public function destroy($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], Response::HTTP_NOT_FOUND);
        }

        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully'], Response::HTTP_OK);
    }
}
