<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                        <tr class="bg-gray-800">
                            <th class="px-5 py-2">
                                <span class="text-gray-300">ID</span>
                            </th>
                            <th class="px-5 py-2">
                                <span class="text-gray-300">Email</span>
                            </th>
                            <th class="px-5 py-2">
                                <span class="text-gray-300">Role</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-gray-200">
                        @foreach($users as $user)
                            <tr class="bg-white border-4 border-gray-200">
                                <td>
                                    <span class="text-center ml-5 font-semibold">{{$user['id']}}</span>
                                </td>
                                <td class="px-16 py-2">
                                    <span class="text-center ml-5 font-semibold">{{$user['email']}}</span>
                                </td>
                                <td class="px-16 py-2">
                                @if($user['role'] == 0)
                                    <a href="{{ url('/users/noadmin/' . $user['id']) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-500 font-bold py-2 px-4 rounded-r" >
                                        Make User
                                    </a>
                                @elseif($user['role'] == 1)
                                    <a href="{{ url('/users/admin/' . $user['id']) }}" class="bg-gray-300 hover:bg-gray-400 text-red-500 font-bold py-2 px-4 rounded-r" >
                                        Make Admin
                                    </a>
                                @endif
                                    
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
