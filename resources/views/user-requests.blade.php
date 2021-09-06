<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                        <tr class="bg-gray-800">
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Typ</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300 whitespace-nowrap">StackOverFlow ID</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Grund</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">Annehmen/Ablehnen</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                        @foreach($userRequests as $userRequest)
                            <tr class="bg-white border-4 border-gray-200">
                                <td>
                            @if($userRequest['type'] == 'add')
                                    <span class="text-center bg-green-500 ml-2 font-semibold">Hinzufügen</span>
                            @elseif($userRequest['type'] == 'delete')
                                    <span class="text-center bg-red-500 ml-2 font-semibold">Löschen</span>
                            @endif
                                </td>
                                <td class="px-16 py-2">
                                    <span class="text-center ml-2 font-semibold">{{$userRequest['soPostId']}}</span>
                                </td>
                                <td class="px-16 py-2">
                                    <span class="text-center ml-2 font-semibold">{{$userRequest['reason']}}</span>
                                </td>
                                <td class="px-16 py-2">
                                    <div class="flex justify-center align-middle">
                                        <a href="{{ url('/request/accept/' . $userRequest['id']) }}" class="bg-gray-300 hover:bg-gray-400 text-green-500 font-bold py-2 px-4 rounded-l">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                        </a>
                                        <a href="{{ url('/request/reject/' . $userRequest['id']) }}" class="bg-gray-300 hover:bg-gray-400 text-red-500 font-bold py-2 px-4 rounded-r">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
