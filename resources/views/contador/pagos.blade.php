<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contador Pagos') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-2 lg:px-4 bg-gray-50 dark:bg-zinc-600">
            <div class="overflow-hidden shadow sm:rounded-lg">
                <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-600">
                        <div class="flex justify-center">
                            <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Subida de pagos generados por el banco') }}</h1>
                        </div>
                </div>
                <div class="flex justify-center shadow p-6 bg-gray-50 dark:bg-zinc-600">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" accept=".csv, .xlsx">
                        <button type="submit">Importar</button>
                    </form>
            </div>
            </div>
        </div>

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

</script>
@endsection
</x-app-layout>
