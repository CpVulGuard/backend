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
                    <form class="flex justify-center items-baseline" method="GET">
                        <div class="form-group mb-2">
                            <label for="filter" class="col-sm-2 col-form-label mr-2">Filter:</label>
                            <input type="text" class="form-control" id="filter" name="filter" placeholder="StackOverFlow ID or Reason..." value="{{$filter}}">
                        </div>
                        <button type="submit" class="bg-gray-300 hover:bg-gray-400 font-bold ml-4 py-2 px-4 h-10 rounded-l rounded-r">Filter</button>
                        @if(isset($filter))
                            <a href="{{ route('dashboard') }}" class="bg-gray-300 hover:bg-gray-400 font-bold ml-4 py-2 px-4 h-10 rounded-l rounded-r">Reset</a>
                        @else
                            <a class="bg-gray-300 opacity-50 font-bold ml-4 py-2 px-4 h-10 rounded-l rounded-r cursor-not-allowed">Reset</a>
                        @endif
                    </form>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center mb-3">
                        {!! $posts->links() !!}
                    </div>
                    <table class="min-w-full table-auto">
                        <thead class="justify-between">
                        <tr class="bg-gray-800">
                            <th class="px-16 py-2">
                                <span class="text-gray-300">@sortablelink('id', 'ID')</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300 whitespace-nowrap">@sortablelink('soPostId', 'Stack Overflow ID')</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-gray-300">@sortablelink('reason', 'Reason')</span>
                            </th>
                             <th class="px-16 py-2">
                                <span class="text-gray-300">@sortablelink('imported', 'Imported')</span>
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
                                     <span class="text-center ml-2 font-semibold">No</span>
                                @elseif($post['imported'] == 1)
                                    <span class="text-center ml-2 font-semibold">Yes</span>
                                @endif
                                   
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                     {{-- Pagination --}}
                    <div class="d-flex justify-content-center mt-3">
                        {!! $posts->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
