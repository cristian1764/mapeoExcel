<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{ __('You are logged in!') }}

                    <!-- Formulario para subir archivos -->
                    <form action="{{ route('archivo.subir') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="archivo">Subir archivo Excel</label>
                            <input type="file" id="archivo" name="archivo" accept=".xlsx, .xls" required>
                        </div>
                        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Subir y Procesar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
