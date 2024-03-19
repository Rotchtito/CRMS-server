<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Complainant;
use App\Models\Suspect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComplaintController extends Controller
{
    


public function update(Request $request, Complaint $complaint)
{
    try {
        // Validate incoming request data
        $validatedData = $request->validate([
            'status' => 'required', // Assuming 'status' is the only field to be updated
        ]);

        // Update the complaint status
        $complaint->update($validatedData);

        // Fetch complainant email directly from the complaint
        $complainantEmail = $complaint->complainant->email;

        // Check if complainant email is valid
        if (!empty($complainantEmail)) {
            // Send email to the complainant
            Mail::raw('Your complaint status has been updated.', function ($message) use ($complainantEmail) {
                $message->to($complainantEmail)
                        ->subject('Complaint Status Updated');
            });
        } else {
            \Log::warning('Complainant email is empty or null', ['complaint_id' => $complaint->id]);
        }

        // Return success response
        return response()->json(['message' => 'Complaint status updated successfully', 'complaint' => $complaint]);
    } catch (\Exception $e) {
        // Log the error
        \Log::error('Failed to update complaint status', ['error' => $e->getMessage()]);

        // Handle any errors that occur during the process
        return response()->json(['error' => 'Failed to update complaint status'], 500);
    }
}

    
    public function index()
    {
        try {
            // Retrieve all complaints with their associated complainants, suspects, and police in charge
            $cases = Complaint::with([
                'complainant:id,name,email,phone', 
                'suspect:id,name', 
                'policeInCharge:id,first_name'
            ])->get();
            
            // Return JSON response with the cases
            return response()->json($cases);
        } catch (\Exception $e) {
            // Handle any errors that occur during the process
            return response()->json(['error' => 'Failed to retrieve cases'], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'complainantName' => 'required|string',
            'complainantEmail' => 'required|email',
            'complainantPhone' => 'required|string',
            'complainantAddress' => 'required|string',
            'suspectName' => 'required|string',
            'suspectAge' => 'nullable|integer',
            'suspectDescription' => 'nullable|string',
            'police_in_charge_id'=>'required',
            'suspectAddress' => 'nullable|string',
            'evidence' => 'array', // Assuming evidence is an array
            'evidence.*' => 'string' // Assuming each evidence item is a string
        ]);

        // Create complainant
        $complainant = Complainant::create([
            'name' => $validatedData['complainantName'],
            'email' => $validatedData['complainantEmail'],
            'phone' => $validatedData['complainantPhone'],
            'address' => $validatedData['complainantAddress'],
        ]);

        // Create suspect
        $suspect = Suspect::create([
            'name' => $validatedData['suspectName'],
            'age' => $validatedData['suspectAge'],
            'description' => $validatedData['suspectDescription'],
            'address' => $validatedData['suspectAddress'],
        ]);

        // Create a new complaint instance
        $complaint = new Complaint([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'complainant_id' => $complainant->id,
            'suspect_id' => $suspect->id,
            'police_in_charge_id' => $validatedData['police_in_charge_id'],
            'evidence' => $validatedData['evidence']
        ]);

        // Save the complaint
        $complaint->save();

        // Return a success response
        return response()->json(['message' => 'Complaint created successfully', 'complaint' => $complaint], 201);
    }

    // Other methods as per your requirements
}
