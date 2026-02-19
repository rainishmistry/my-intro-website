<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Handle redirect from PostTooLargeException (where session wasn't available)
        // Only flash error if NO success message exists (prevent duplicate messages after successful retry)
        if ($request->has('upload_error') && !session()->has('success')) {
            session()->flash('error', 'The uploaded file is too large. Please upload a smaller file or increase server configuration.');
        }

        $settings = \App\Models\Setting::all()->pluck('value', 'key')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // DEBUG: Log everything to identify why large uploads fail silently
        // \Illuminate\Support\Facades\Log::info('--- Settings Upload Debug Start ---');
        // \Illuminate\Support\Facades\Log::info('Content-Length: ' . $request->server('CONTENT_LENGTH'));
        // \Illuminate\Support\Facades\Log::info('Post Max Size (ini): ' . ini_get('post_max_size'));
        // \Illuminate\Support\Facades\Log::info('Upload Max Size (ini): ' . ini_get('upload_max_filesize'));
        // \Illuminate\Support\Facades\Log::info('Request All Count: ' . count($request->all()));
        // \Illuminate\Support\Facades\Log::info('Files Count: ' . count($request->allFiles()));
        
        // 1. Check for Post Max Size Violation (Classic silent fail cause)
        if (empty($request->all()) && $request->server('CONTENT_LENGTH') > 0) {
            $maxPostSize = ini_get('post_max_size');
            // \Illuminate\Support\Facades\Log::error('CRITICAL: POST limit exceeded.');
            return back()->with('error', "CRITICAL: The upload exceeds the server's post_max_size limit ($maxPostSize). If you increased the limit, ensure you restarted the server.");
        }

        try {
            // 2. Separate Text and File Data
            $textSettings = $request->except(['_token', 'profile_image_path', 'about_image_path', 'resume_path']);
            
            // Save Text Settings
            foreach ($textSettings as $key => $value) {
                \App\Models\Setting::updateOrCreate(['key' => $key], ['value' => $value]);
            }

            // 3. Handle Files Explicitly
            $fileKeys = ['profile_image_path', 'about_image_path', 'resume_path'];
            
            foreach ($fileKeys as $key) {
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    
                    // Validate
                    if (!$file->isValid()) {
                        $error = $file->getError();
                        $serverLimit = ini_get('upload_max_filesize');
                        
                        if ($error == UPLOAD_ERR_INI_SIZE) {
                            return back()->with('error', "Error: File too large. Server Limit is $serverLimit. You uploaded a larger file. Please edit php.ini.");
                        }
                        if ($error == UPLOAD_ERR_FORM_SIZE) {
                             return back()->with('error', "Error: File exceeds form MAX_FILE_SIZE.");
                        }
                        return back()->with('error', "Upload Exception: " . $file->getErrorMessage());
                    }

                    // Strict Type Check
                    $allowedMimes = [
                        'image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml',
                        'application/pdf', 
                        'application/msword', // .doc
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document' // .docx
                    ];
                    
                    if (!in_array($file->getMimeType(), $allowedMimes)) {
                        return back()->with('error', "Invalid File Type for $key: " . $file->getMimeType());
                    }

                    // Save File
                    $filename = time() . '_' . $key . '_' . $file->getClientOriginalName(); // Added key to filename to avoid collisions
                    
                    if (!file_exists(public_path('uploads'))) {
                        @mkdir(public_path('uploads'), 0777, true);
                    }

                    $file->move(public_path('uploads'), $filename);
                    $storagePath = 'uploads/' . $filename;
                    
                    // Update DB with Image Path
                    \App\Models\Setting::updateOrCreate(
                        ['key' => $key],
                        ['value' => $storagePath]
                    );
                }
            }

            return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'System Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
