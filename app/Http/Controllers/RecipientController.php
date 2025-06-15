<?php

namespace App\Http\Controllers;

use App\Models\Recipients;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    public function index()
    {
        $recipients = Recipients::all();
        return view('recipient.index', compact('recipients'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'goverment_id_number' => 'required|unique:recipients',
                'blood_type' => 'required',
                'age' => 'required|numeric',
                'organ_needed' => 'required',
                'medical_history' => 'required',
                'waiting_time' => 'required|numeric',
                'contact_information' => 'required|email',
                'contact_number' => 'required',
                'status' => 'required'
            ]);

            $recipient = new Recipients($request->all());
            $recipient->encoded_by = auth()->user()->name;
            $recipient->encoded_date = now();
            $recipient->save();

            return response()->json(['success' => true]);
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
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'gender' => 'required',
                'goverment_id_number' => 'required|unique:recipients,goverment_id_number,'.$id,
                'blood_type' => 'required',
                'age' => 'required|numeric',
                'organ_needed' => 'required',
                'medical_history' => 'required',
                'waiting_time' => 'required|numeric',
                'contact_information' => 'required|email',
                'contact_number' => 'required',
                'status' => 'required'
            ]);

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