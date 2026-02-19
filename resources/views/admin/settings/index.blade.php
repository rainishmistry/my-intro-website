<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Site Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold">Settings</h3>
                            <button type="submit" style="background-color: #6366f1; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer;">
                                Save Settings
                            </button>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="text-lg font-bold mb-2">Hero Section</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Greeting Title</label>
                                    <input type="text" name="hero_greeting" value="{{ $settings['hero_greeting'] ?? "Hi! I'm John Doe" }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Main Headline</label>
                                    <input type="text" name="hero_headline" value="{{ $settings['hero_headline'] ?? 'Senior Web Developer based in New York.' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                                    <textarea name="hero_description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">{{ $settings['hero_description'] ?? '' }}</textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Hero Image / Profile Picture</label>
                                    @if(isset($settings['profile_image_path']))
                                        <div class="mb-2">
                                            <img src="{{ asset($settings['profile_image_path']) }}" alt="Current Profile" class="h-20 w-20 object-cover rounded-full">
                                        </div>
                                    @endif
                                    <input type="file" name="profile_image_path" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Resume File (PDF, DOC, JPG)</label>
                                    @if(isset($settings['resume_path']))
                                        <div class="mb-2">
                                            <a href="{{ asset($settings['resume_path']) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 underline">View Current Resume</a>
                                        </div>
                                    @endif
                                    <input type="file" name="resume_path" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 border-t pt-4 dark:border-gray-700">
                            <h3 class="text-lg font-bold mb-2">About Section</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">About Title</label>
                                    <input type="text" name="about_title" value="{{ $settings['about_title'] ?? 'About Me' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">About Content</label>
                                    <textarea name="about_content" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">{{ $settings['about_content'] ?? '' }}</textarea>
                                </div>
                                
                                <div class="grid grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Experience (e.g. 10+)</label>
                                        <input type="text" name="about_experience_years" value="{{ $settings['about_experience_years'] ?? '10+' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Projects (e.g. 50+)</label>
                                        <input type="text" name="about_projects_completed" value="{{ $settings['about_projects_completed'] ?? '50+' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Clients (e.g. 20+)</label>
                                        <input type="text" name="about_clients_satisfied" value="{{ $settings['about_clients_satisfied'] ?? '20+' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">About Image</label>
                                    @if(isset($settings['about_image_path']))
                                        <div class="mb-2">
                                            <img src="{{ asset($settings['about_image_path']) }}" alt="Current About Image" class="h-20 w-auto object-cover rounded">
                                        </div>
                                    @endif
                                    <input type="file" name="about_image_path" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4 border-t pt-4 dark:border-gray-700">
                            <h3 class="text-lg font-bold mb-2">Contact Details</h3>
                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                    <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? 'contact@johndoe.com' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Phone Number</label>
                                    <input type="text" name="contact_phone" value="{{ $settings['contact_phone'] ?? '+1 (555) 123-4567' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address/Location</label>
                                    <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? 'New York, USA' }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600">
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6 pb-2">
                           <button type="submit" style="background-color: #6366f1; color: white; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer;">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
