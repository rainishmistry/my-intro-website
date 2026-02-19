<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Message Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('admin.contacts.index') }}" class="text-indigo-600 hover:text-indigo-900">&larr; Back to Messages</a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-bold mb-4">Sender Info</h3>
                            <p><strong>Name:</strong> {{ $contact->name }}</p>
                            <p><strong>Email:</strong> {{ $contact->email }}</p>
                            <p><strong>Date:</strong> {{ $contact->created_at->format('M d, Y h:i A') }}</p>
                            
                            <h3 class="text-lg font-bold mt-6 mb-2">Message</h3>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                {{ $contact->message }}
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold mb-4">Reply</h3>
                            @if(session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            @if($contact->admin_reply)
                                <div class="bg-green-50 dark:bg-green-900 p-4 rounded-lg border border-green-200 dark:border-green-700">
                                    <p class="font-bold text-green-800 dark:text-green-200">Replied on {{ $contact->updated_at->format('M d, Y') }}:</p>
                                    <p class="mt-2 text-gray-800 dark:text-gray-200">{{ $contact->admin_reply }}</p>
                                </div>
                            @else
                                <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <textarea name="reply" rows="5" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-700 dark:border-gray-600" placeholder="Type your reply here..." required></textarea>
                                    </div>
                                    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                        Send Reply
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
