<x-layouts.app>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Personal Administrativo
    </h2>

    {{-- Contenedor principal con x-data para Alpine.js --}}
    <div x-data="{ isModalOpen: false, openModal() { this.isModalOpen = true }, closeModal() { this.isModalOpen = false } }">

        <div class="mb-4">
            {{-- Botón "Nuevo Personal" con @click directo --}}
            <x-button type="button" @click="openModal">
                Nuevo Personal
            </x-button>
        </div>

        <div class="w-full rounded-lg shadow-xs overflow-x-auto lg:overflow-visible">
            <div class="w-full rounded-lg shadow-xs overflow-x-auto xl:overflow-visible">
                <table class="w-full whitespace-nowrap min-w-[800px] xl:min-w-full xl:whitespace-normal">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3 w-1/6">Nombre</th>
                            <th class="px-4 py-3 w-1/6">Documento</th>
                            <th class="px-4 py-3 w-1/6">Email</th>
                            <th class="px-4 py-3 w-1/6">Teléfono</th>
                            <th class="px-4 py-3 w-1/6">Dirección</th>
                            <th class="px-4 py-3 w-1/6">Cargo</th>
                            <th class="px-4 py-3 w-1/6">Estado</th>
                            <th class="px-4 py-3 w-1/12">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @forelse ($staff as $personal) {{-- Usamos $staff como el nombre de la colección en el controlador --}}
                        @include('components.personal.table-row', ['personal' => $personal])
                        @empty
                            <tr class="text-gray-700 dark:text-gray-400">
                                <td colspan="8" class="px-4 py-3 text-center">No hay personal para mostrar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Paginación de Laravel --}}
        <div class="mt-4">
            {{ $staff->links() }}
        </div>

        {{-- Modal de Creación de Personal --}}
        <div
            x-show="isModalOpen"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
        >
            <div
                x-show="isModalOpen"
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 transform translate-y-1/2"
                @click.away="closeModal"
                @keydown.escape="closeModal"
                class="px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog"
                id="modal"
            >
                <header class="flex justify-end">
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                        aria-label="close"
                        @click="closeModal"
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <div class="mt-4 mb-6">
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Crear Personal
                    </p>

                    <form action="{{ route('personal.store') }}" method="POST">
                        @csrf

                        {{-- Incluimos el parcial con los campos del formulario --}}
                        @include('components.personal.create-form-fields')

                        <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                            <button @click="closeModal" type="button"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Guardar
                            </button>
                        </footer>
                    </form>
                </div>
            </div>
        </div>

    </div> {{-- Cierre del div con x-data --}}

</x-app-layout>