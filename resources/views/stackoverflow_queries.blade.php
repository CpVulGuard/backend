<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Queries') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($isAdmin)
                        <form action="{{ route('stackoverflow_queries') }}" method="post" class="flex space-x-2 justify-center items-center py-2">
                            @csrf
                            <label class="flex-initial w-40" for="newQuery">Create a new query:</label>
                            <input id="newQuery" name="newQuery" class="flex-auto w-1/2 h-10 text-sm font-mono" type="text" placeholder="Regular expression" required>
                            <input id="newQueryReason" name="newQueryReason" class="flex-auto w-1/6 h-10" type="text" placeholder="Reason" required>
                            <button type="submit" class="flex-initial w-32 h-10 bg-green-600 hover:bg-green-400 font-bold rounded-r">Submit</button>
                        </form>
                    @endif
                    @if($queries->isNotEmpty())
                        <table class="min-w-full table-fixed">
                            <thead class="justify-between">
                            <tr class="bg-gray-800">
                                <th class="px-5 py-2">
                                    <span class="text-gray-300">ID</span>
                                </th>
                                <th class="w-1/2 px-5 py-2">
                                    <span class="text-gray-300">RegEx</span>
                                </th>
                                <th class="w-1/4 px-5 py-2">
                                    <span class="text-gray-300">Reason</span>
                                </th>
                                @if($isAdmin)
                                    <th class="px-5 py-2">
                                        <span class="text-gray-300">Creator</span>
                                    </th>
                                    <th class="px-5 py-2">
                                        <span class="text-gray-300">Actions</span>
                                    </th>
                                @endif
                            </tr>
                            </thead>
                            <tbody class="bg-gray-200">
                            @foreach($queries as $query)
                                <tr class="bg-white border-4 border-gray-200">
                                    <td>
                                        <span class="text-center ml-5 font-semibold">{{$query['id']}}</span>
                                    </td>
                                    <td class="px-16 py-2">
                                        <p class="text-left break-all text-xs font-mono">{{$query['regex']}}</p>
                                    </td>
                                    <td class="px-16 py-2">
                                        <p class="text-center ml-5 font-semibold">{{$query['reason']}}</p>
                                    </td>
                                    @if($isAdmin)
                                        <td class="px-16 py-2">
                                            <span class="text-center ml-5 font-semibold">{{$query['email']}}</span>
                                        </td>
                                        <td class="px-16 py-2 space-x-1 whitespace-nowrap">
                                            @if($query['active'])
                                                <a href="{{ url('/queries/disable/' . $query['id']) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r" >
                                                    Disable
                                                </a>
                                            @else
                                                <a href="{{ url('/queries/enable/' . $query['id']) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r" >
                                                    Enable
                                                </a>
                                            @endif
                                            <a href="{{ url('/queries/delete/' . $query['id']) }}" class="bg-gray-300 hover:bg-gray-400 text-red-500 font-bold py-2 px-4 rounded-r" >
                                                Delete
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
