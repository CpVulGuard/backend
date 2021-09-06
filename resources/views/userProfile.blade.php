<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    
        <div class="w-full h-96 flex items-center justify-center">
            <div class="xl:w-1/4 sm:w-1/2 w-full 2xl:w-1/3 flex flex-col  items-center py-16 md:py-12 bg-gradient-to-r from-indigo-500 to-gray-600 rounded-lg">
                <div class="w-full flex items-center justify-center">
                    <div class="flex flex-col items-center">
                        <p tabindex="0" class="focus:outline-none mt-2 text-5xl  font-semibold text-center text-white transition duration-500 ease-in-out  transform hover:-translate-y-1 hover:scale-110">{{ $user->name }}</p>
                    </div>
                </div>
                <div class="flex items-center mt-7">
                    <div class="">
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-300">ID</p>
                        <p tabindex="0" class="focus:outline-none mt-2 text-base sm:text-lg md:text-xl 2xl:text-2xl text-gray-50">{{ $user->id }}</p>
                    </div>
                     @if($user['role'] == 0)
                        <div class="ml-12">
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-300">Role</p>
                        <p tabindex="0" class="focus:outline-none mt-2 text-base sm:text-lg md:text-xl 2xl:text-2xl text-gray-50">Admin</p>
                    </div>
                    @elseif($user['role'] == 1)
                        <div class="ml-12">
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-300">Role</p>
                        <p tabindex="0" class="focus:outline-none mt-2 text-base sm:text-lg md:text-xl 2xl:text-2xl text-gray-50">User</p>
                    </div>
                    @endif
                    
                    <div class="ml-12">
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-300">Email</p>
                        <p tabindex="0" class="focus:outline-none mt-2 text-base sm:text-base md:text-base 2xl:text-base text-gray-50">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="flex items-center mt-7">
                    <div class="">
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-300">angenommene Posts</p>
                        <p tabindex="0" class="focus:outline-none mt-2 text-base sm:text-lg md:text-xl 2xl:text-2xl text-gray-50">{{ $user->accepted }}</p>
                    </div>
                
                    <div class="ml-12">
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-300">abgelehnte Posts</p>
                        <p tabindex="0" class="focus:outline-none mt-2 text-base sm:text-lg md:text-xl 2xl:text-2xl text-gray-50">{{ $user->rejected}}</p>
                    </div>
                    <div class="ml-12">
                        <p tabindex="0" class="focus:outline-none text-xs text-gray-300">ausstehende Posts</p>
                        <p tabindex="0" class="focus:outline-none mt-2 text-base sm:text-lg md:text-xl 2xl:text-2xl text-gray-50">{{ $user->pending }}</p>
                    </div>
                </div>
            </div>
        </div>
    

</x-app-layout>
