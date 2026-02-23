<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Contact::create($validated);

        // Send Email Notification
        try {
            // Get Admin Email from Settings or fallback to config
            $adminEmail = \App\Models\Setting::where('key', 'contact_email')->value('value');
            
            if (!$adminEmail) {
                // Fallback to explicit default just in case
                $adminEmail = 'rainish.developer@gmail.com'; 
            }

            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactFormMail($validated));

        } catch (\Exception $e) {
            // Log error but don't fail the user request
            \Illuminate\Support\Facades\Log::error('Contact Email Failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Thank you! Your message has been sent successfully.');
    }
}
