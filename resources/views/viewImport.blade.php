<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('import-finish') }}" method="GET">
                        <div class="flex justify-center mb-3">
                            <a href="{{route('start-import')}}" class="bg-red-600 hover:bg-red-400 font-bold py-2 px-4 rounded-r mr-3">Discard Import</a>
                            <button class="bg-green-600 hover:bg-green-400 font-bold py-2 px-4 rounded-r">Finish Import</button>
                        </div>
                        <table class="min-w-full table-auto">
                            <thead class="justify-between">
                            <tr class="bg-gray-800">
                                <th class="px-16 py-2">
                                    <span class="text-gray-300">ID</span>
                                </th>
                                <th class="px-16 py-2">
                                    <span class="text-gray-300 whitespace-nowrap">StackOverFlow ID</span>
                                </th>
                                <th class="px-16 py-2">
                                    <span class="text-gray-300">Grund</span>
                                </th>
                                 <th class="px-16 py-2">
                                    <span class="text-gray-300">imported</span>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-gray-200">
                            @foreach($posts as $post)
                                <tr class="bg-white border-4 border-gray-200">
                                    <td>
                                        <span class="text-center ml-2 font-semibold">{{$post['id']}}</span>
                                    </td>
                                    <td class="px-16 py-2">
                                        <a class="text-center ml-2 font-semibold" href="https://stackoverflow.com/questions/{{$post['soPostId']}}">{{$post['soPostId']}}</a>
                                    </td>
                                    <td class="px-16 py-2">
                                        <span class="text-center ml-2 font-semibold">{{$post['reason']}}</span>
                                    </td>
                                    <td class="px-16 py-2">
                                    @if($post['imported'] == 0)
                                         <span class="text-center ml-2 font-semibold">Nein</span>
                                    @elseif($post['imported'] == 1)
                                        <span class="text-center ml-2 font-semibold">Ja</span>
                                    @endif

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="flex justify-center mt-3">
                            <a href="{{route('start-import')}}" class="bg-red-600 hover:bg-red-400 font-bold py-2 px-4 rounded-r mr-3">Discard Import</a>
                            <button class="bg-green-600 hover:bg-green-400 font-bold py-2 px-4 rounded-r">Finish Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
