<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'office_address' => 'required|string|max:255',
            'phone_1' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'email_1' => 'required|email|max:100',
            'email_2' => 'nullable|email|max:100',
            'monday_friday_hours' => 'required|string|max:50',
            'saturday_hours' => 'required|string|max:50',
            'facebook_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Deactivate all other contacts if this one is being activated
        if ($request->is_active) {
            Contact::query()->update(['is_active' => false]);
        }

        Contact::create($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validator = Validator::make($request->all(), [
            'office_address' => 'required|string|max:255',
            'phone_1' => 'required|string|max:20',
            'phone_2' => 'nullable|string|max:20',
            'email_1' => 'required|email|max:100',
            'email_2' => 'nullable|email|max:100',
            'monday_friday_hours' => 'required|string|max:50',
            'saturday_hours' => 'required|string|max:50',
            'facebook_url' => 'nullable|url|max:255',
            'whatsapp_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'youtube_url' => 'nullable|url|max:255',
            'is_active' => 'boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Deactivate all other contacts if this one is being activated
        if ($request->is_active) {
            Contact::where('id', '!=', $contact->id)->update(['is_active' => false]);
        }

        $contact->update($request->all());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contacts.index')
            ->with('success', 'Contact deleted successfully.');
    }

    /**
     * Get active contact information (API endpoint)
     */
    public function getActiveContact()
    {
        $contact = Contact::getActiveContact();

        if (!$contact) {
            return response()->json([
                'success' => false,
                'message' => 'No active contact found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'contact' => $contact,
                'social_media' => $contact->social_media_links
            ]
        ]);
    }

    /**
     * Toggle active status of a contact
     */
    public function toggleActive(Contact $contact)
    {
        if ($contact->is_active) {
            $contact->update(['is_active' => false]);
            $message = 'Contact deactivated successfully.';
        } else {
            // Deactivate all other contacts first
            Contact::where('id', '!=', $contact->id)->update(['is_active' => false]);
            $contact->update(['is_active' => true]);
            $message = 'Contact activated successfully.';
        }

        return redirect()->back()->with('success', $message);
    }
}
