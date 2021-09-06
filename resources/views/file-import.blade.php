<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import') }}
        </h2>
    </x-slot>

    <div class="container mt-5 text-center">
        <h2 class="mb-4">
            Import file with stackoverflow post ids which contain vulnerabilities
        </h2>

        @if (isset($errors) && $errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-4" style="max-width: 500px; margin: 0 auto;">
                <div class="custom-file text-left">
                    <input type="file" name="file" class="custom-file-input" id="customFile">
                    <label class="custom-file-label" for="customFile" id="customLabel">Choose file</label>
                </div>
            </div>
            <button class="bg-green-600 hover:bg-green-400 font-bold mt-3 py-2 px-4 rounded-r">Preload data</button>
        </form>
    </div>
    <script>
        document.getElementById('customFile').addEventListener('change', (event) => {
            document.getElementById('customLabel').innerHTML = event.target.value.replace(/.*[\/\\]/, '');
        });
    </script>
</x-app-layout>
