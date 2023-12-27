
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>

    </x-slot>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" overflow-hidden shadow sm:rounded-lg">
                <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-800">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Tabla Usuarios') }}</h1>
                        <a href="{{ route('admin.users.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Crear usuario</a>
                    </div>
                    <br>
                    <form action="{{ route('admin.users.index') }}" method="GET" div class="grid grid-cols-8 gap-8">
                        <div class="col-span-8 lg:col-span-6 sm:col-span-4">
                            <input type="text" name="search" class="flex justify-between block w-full py-2 px-3 border border-gray-300 bg-white dark:bg-zinc-800 dark:text-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Ingresa un nombre o correo de usuario"
                             value="{{ old('search') }}">
                        </div>
                        <div class="col-span-8 lg:col-span-2 sm:col-span-4 flex">
                            <input type="submit" class="ml-2  bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-5 rounded" value="Buscar">

                            <a type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-5 rounded" href="{{ route('admin.users.index') }}"> Todos</a>

                            <a type="submit"  class="ml-2 bg-red-900 hover:bg-red-700 text-white font-bold py-2 px-5 rounded" href="{{route('admin.users.pdf')}}" >PDF</a>

                        </div>
                    </form>

                    <div class="mt-4 py-4" style="overflow-x: auto; max-height: 400px;">
                        <table class="table-autobg-white dark:bg-zinc-700 w-full">
                            <thead class="text-xs border text-black dark:text-white font-semibold uppercase text-zinc-800 bg-zinc-100 dark:bg-zinc-400">
                                <tr>
                                    <th class="px-2 py-2">{{ __('Nombres') }}</th>
                                    <th class="px-2 py-2">{{ __('Email') }}</th>
                                    <th class="px-2 py-2">{{ __('DNI') }}</th>
                                    <th class="px-2 py-2">{{ __('Celular') }}</th>
                                    <th class="px-2 py-2">{{ __('Rol') }}</th>
                                    <th class="px-2 py-2">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-center divide-y divide-gray-100 text-black dark:text-white">
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="border px-2 py-2">{{ $user->nombres }}</td>
                                        <td class="border px-2 py-2">{{ $user->email }}</td>
                                        <td class="border px-2 py-2">{{ $user->numero_documento }}</td>
                                        <td class="border px-2 py-2">{{ $user->celular }}</td>
                                        <td class="border px-2 py-2">
                                            @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $rolNombre)
                                            {{ $rolNombre }}
                                            @endforeach
                                          @endif
                                        </td>
                                        <td class="border px-2 py-2">
                                            <button onclick="window.location.href = '{{ route('admin.users.edit', $user) }}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-edit"></i></button>
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline formulario-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-red-400 text-white text-center">
                                        <td colspan="3" class="border px-4 py-2">{{ __('No hay usuarios para mostrar') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($users->hasPages())
                                <tfoot class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="border px-4 py-2">
                                            {{ $users->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                    <a type="submit" class="ml-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-3 rounded" href="{{ route('export') }}"> excel rp</a>
                </div>
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

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'El usuario se eliminó con éxito.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este usuario se eliminará definitivamente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminar!',
            cancelButtonText:   'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
            })
        });

    </script>

@endsection


{{--
        <div class="container mx-auto">
            <div class="flex flex-col">
                <div class="w-full">
                    <div class="p-8 border-b border-gray-200 shadow">
                        <table class="bg-white overflow-hidden shadow-sm sm:rounded-lg" divide-y divide-gray-300" id="dataTable">
                            <thead class="bg-white overflow-hidden shadow-sm sm:rounded-lg bg-black">
                                <tr>
                                    <th class="px-6 py-2 text-xs text-white">{{ __('ID') }}</th>
                                    <th class="px-6 py-2 text-xs text-white">{{ __('Name') }}</th>
                                    <th class="px-6 py-2 text-xs text-white">{{ __('Email') }}</th>
                                    <th class="px-6 py-2 text-xs text-white">{{ __('Rol') }}</th>
                                    <th class="px-6 py-2 text-xs text-white">{{ __('Editar') }}</th>
                                    <th class="px-6 py-2 text-xs text-white">{{ __('Eliminar') }}</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-300">
                                @forelse ($users as $user)
                                    <tr class="text-center whitespace-nowrap">
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            {{ $user->id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-900">
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $rolNombre)
                                                {{ $rolNombre }}
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="inline-block text-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block text-center formulario-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-transparent border-none">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                        <tr class="bg-red-400 text-white text-center">
                                            <td colspan="3" class="border px-4 py-2">{{ __('No hay usuarios para mostrar') }}</td>
                                        </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('#dataTable').DataTable();

            });
        </script>
@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'El usuario se eliminó con éxito.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este usuario se eliminará definitivamente!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminar!',
            cancelButtonText:   'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
            })
        });

    </script>

@endsection
--}}
</x-app-layout>
