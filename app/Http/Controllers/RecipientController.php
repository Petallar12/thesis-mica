<?php

namespace App\Http\Controllers;

use App\Models\Recipients;
use Illuminate\Http\Request;
use App\Mail\RecipientRegistrationConfirmation;
use Illuminate\Support\Facades\Mail;

class RecipientController extends Controller
{
    public function index()
    {
        $recipients = Recipients::where('register_outside_inside', 'Inside')->get();
        return view('recipient.index', compact('recipients'));
    }

    public function index_archive()
    {
        $archive = Recipients::where('register_outside_inside', 'Archive')->get();
        return view('recipient.index_archive', compact('archive'));
    }

public function archive(Recipients $recipient)
    {
        // Update the 'register_outside_inside' field to 'Archive'
        $recipient->update(['register_outside_inside' => 'Archive']);

        return response()->json(['success' => true]);
    }   

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'goverment_id_number' => 'required',
            'organ_needed' => 'required',
            'blood_type' => 'required',
            // add other required fields as needed
        ]);
        try {
            $recipient = new Recipients($request->all());
            $recipient->encoded_by = auth()->user()->name;
            $recipient->encoded_date = now();
            $recipient->save();

            // Send notification email if contact_information is a valid email
            if (filter_var($recipient->contact_information, FILTER_VALIDATE_EMAIL)) {
                try {
                    Mail::to($recipient->contact_information)
                        ->send(new RecipientRegistrationConfirmation($recipient));
                } catch (\Exception $e) {
                    \Log::error('Failed to send recipient email: ' . $e->getMessage());
                }
            }

            return response()->json(['success' => true, 'message' => 'Thank you for registering as a recipient!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function show($id)
    {
        try {
            $recipient = Recipients::findOrFail($id);
            return view('recipient.show', compact('recipient'))->render();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load recipient details.'], 404);
        }
    }

    public function edit($id)
    {
        try {
            $recipient = Recipients::findOrFail($id);
            return response()->json($recipient);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to load recipient details.'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $recipient = Recipients::findOrFail($id);
            $recipient->update($request->all());
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $recipient = Recipients::findOrFail($id);
            $recipient->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
} 