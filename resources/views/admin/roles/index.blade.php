<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Roles') }}
        </h2>

    </x-slot>


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])


        <!--  Datatables  -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>

        <!--  extension responsive  -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
    </head>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow sm:rounded-lg">
            <div class=" shadow p-6 bg-gray-50 dark:bg-zinc-800">
                    <div class="flex justify-between">
                        <h1 class="text-2xl font-bold text-black dark:text-white">{{ __('Table Roles') }}</h1>
                        <a href="{{ route('admin.roles.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Crear Rol</a>
                    </div>

                    <div class="mt-4" style="overflow-x: auto; max-height: 400px;">
                    <table class="table-autobg-white dark:bg-zinc-700 w-full">
                            <thead class="text-xs border text-black dark:text-white font-semibold uppercase text-zinc-800 bg-zinc-100 dark:bg-zinc-400">
                                <tr>
                                    <th class="px-2 py-2">ID </th>
                                    <th class="px-2 py-2">Rol</th>
                                    <th class="px-2 py-4">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-center divide-y divide-gray-100 text-black dark:text-white">
                                 @forelse ($roles as $rol)
                                    <tr>
                                        <td class="border px-2 py-2">{{ $rol->id }}</td>
                                        <td class="border px-2 py-2">{{ $rol->name }}</td>
                                        <td class="border px-2 py-4" style="width: 270px">
                                        <button onclick="window.location.href = '{{ route('admin.roles.edit', $rol) }}'" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-2 rounded"><i class="fas fa-edit"></i></button>
                                        <form action="{{ route('admin.roles.destroy', $rol) }}" method="POST" class="inline formulario-eliminar">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-2 rounded"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="bg-red-400 text-white text-center">
                                        <td colspan="3" class="border px-4 py-2">{{ __('No hay roles para mostrar') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            @if ($roles->hasPages())
                                <tfoot class="text-xs font-semibold uppercase text-gray-400 bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="border px-4 py-2">
                                            {{ $roles->links() }}
                                        </td>
                                    </tr>
                                </tfoot>
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                '¡Eliminado!',
                'El rol se eliminó con éxito.',
                'success'
            )
        </script>
    @endif

    <script>
        $('.formulario-eliminar').submit(function(e){
            e.preventDefault();
            Swal.fire({
            title: '¿Estas seguro?',
            text: "Este rol se eliminará definitivamente!",
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
</x-app-layout>
