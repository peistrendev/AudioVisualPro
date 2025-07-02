<x-layouts.app>
    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Proyectos
    </h2>

    {{-- Contenedor principal con Alpine.js para gestionar el estado de dos modales --}}
    <div x-data="{ isCreateModalOpen: false, isFilterModalOpen: false }">
        {{-- Contenedor de botones de acción --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            {{-- Botón para abrir el modal de creación (usando x-button con dimensiones) --}}
            <x-button @click="isCreateModalOpen = true" type="button" class="order-1 h-10 px-5 py-2 flex items-center justify-center gap-2">
                {{-- Se ha quitado el SVG del símbolo "+" --}}
                Crear Proyecto
            </x-button>

            {{-- Contenedor de filtros y exportación --}}
            <div class="flex items-center space-x-4 order-2"> {{-- CAMBIO: space-x-2 a space-x-4 para más separación --}}
                {{-- Botón para abrir el modal de filtros (usando x-button con dimensiones) --}}
                <x-button @click="isFilterModalOpen = true" type="button" class="h-10 px-5 py-2 flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                    </svg>
                    Filtrar
                </x-button>

                {{-- Formulario para exportar a PDF (oculto) --}}
                <form action="{{ route('proyectos.exportar-pdf') }}" method="GET" id="export-pdf-form">
                    {{-- Los campos se añadirán aquí con JS --}}
                </form>

                {{-- Botón para exportar a PDF (ROJO y con dimensiones) --}}
                <x-button type="button" onclick="submitExportForm()"
                    class="h-10 px-5 py-2 bg-red-600 hover:bg-red-700 active:bg-red-600 focus:shadow-outline-red flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zM10 12V4a1 1 0 012 0v8h3a1 1 0 01.707 1.707l-4 4a1 1 0 01-1.414 0l-4-4A1 1 0 017 12h3z" clip-rule="evenodd" />
                    </svg>
                    Exportar PDF
                </x-button>

                {{-- Botón para limpiar filtros (mantiene estilo gris/borde con dimensiones) --}}
                @if (count(request()->query()) > 0) {{-- Muestra solo si hay filtros activos --}}
                    <a href="{{ route('proyectos.index') }}" class="h-10 px-5 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 hover:border-gray-500 focus:border-gray-500 focus:outline-none focus:shadow-outline-gray flex items-center justify-center gap-2">
                        Limpiar Filtros
                    </a>
                @endif
            </div>
        </div>

        {{-- Script para enviar el formulario de exportación con los filtros actuales --}}
        <script>
            function submitExportForm() {
                const filterForm = document.getElementById('filter-form'); // El formulario dentro del modal de filtros
                const exportForm = document.getElementById('export-pdf-form'); // El formulario oculto de exportación

                // Limpiar el formulario de exportación antes de copiar los campos para evitar duplicados
                exportForm.innerHTML = '';

                // Clonar todos los campos (input, select, textarea) del formulario de filtro y añadirlos al formulario de exportación
                // Asegúrate de que el formulario de filtros tenga el ID 'filter-form'
                if (filterForm) {
                    const filterInputs = filterForm.querySelectorAll('input, select, textarea');
                    filterInputs.forEach(input => {
                        // Solo copiar campos que tienen un nombre y un valor (para evitar campos vacíos no relevantes)
                        if (input.name && input.value) {
                            const clonedInput = input.cloneNode(true);
                            exportForm.appendChild(clonedInput);
                        }
                    });
                }

                // Enviar el formulario de exportación. Esto hará que el navegador solicite el PDF.
                exportForm.submit();
            }
        </script>

        {{-- Muestra los filtros activos --}}
        {{-- Usamos request()->query() directamente para reflejar los filtros actuales de la URL --}}
        @if (count(array_filter(request()->query())) > 0 && !empty(array_diff_key(request()->query(), ['page' => ''])))
            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mb-6 shadow-inner text-sm text-gray-600 dark:text-gray-300">
                <p class="font-semibold mb-2">Filtros Activos:</p>
                <div class="flex flex-wrap gap-2">
                    @foreach (request()->query() as $key => $value)
                        @if ($value && $key !== 'page')
                            <span class="bg-purple-100 text-purple-800 dark:bg-purple-800 dark:text-purple-100 px-3 py-1 rounded-full flex items-center gap-1">
                                {{ ucfirst(str_replace(['_id', '_', '_desde', '_hasta', '_min', '_max'], ['',' ', ' Desde', ' Hasta', ' Mín.', ' Máx.'], $key)) }}:
                                <span class="font-bold">
                                    @if (Str::contains($key, 'fecha'))
                                        {{ \Carbon\Carbon::parse($value)->format('d/m/Y') }}
                                    @elseif (Str::contains($key, 'presupuesto'))
                                        ${{ number_format($value, 2, ',', '.') }}
                                    @elseif ($key == 'responsable_id')
                                        {{ $personal->find($value)->nombre ?? 'N/A' }}
                                    @elseif ($key == 'cliente_id')
                                        {{ $clientes->find($value)->nombre ?? 'N/A' }}
                                    @elseif ($key == 'cliente_documento')
                                        {{ $clientes->where('documento', $value)->first()->nombre ?? 'N/A' }}
                                    @else
                                        {{ $value }}
                                    @endif
                                </span>
                            </span>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif


        <x-table :headers="['Nombre', 'Descripción', 'Cliente', 'Estado', 'Inicio', 'Fin', 'Presupuesto', 'Lugar', 'Responsable', 'Opciones']">
           @forelse ($proyectos as $project)
                @include('components.proyectos.table-row', ['item' => $project, 'route_prefix' => 'proyectos'])
           @empty
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-center" colspan="10">No hay proyectos para mostrar.</td>
                </tr>
           @endforelse
        </x-table>

        <div class="mt-4">
            {{ $proyectos->appends(request()->except('page'))->links() }}
        </div>

        {{-- MODAL DE CREACIÓN (Implementado directamente en panel.blade.php) --}}
        <div
            x-show="isCreateModalOpen"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
            @click.away="isCreateModalOpen = false"
            @keydown.escape.window="isCreateModalOpen = false"
        >
            <div
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 transform translate-y-1/2"
                class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog"
                id="modal-create"
                style="width: 80%; padding-bottom: 0;"
            >
                <header class="flex justify-end">
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                        aria-label="close"
                        @click="isCreateModalOpen = false" {{-- Cierra isCreateModalOpen directamente --}}
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <div class="mt-4 mb-6">
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Crear Proyecto
                    </p>
                    <form action="{{ route('proyectos.store') }}" method="POST">
                        @csrf
                        @include('components.proyectos.create-form-fields', compact('clientes', 'personal'))

                        <footer style="margin-bottom: -1.8rem;"
                            class="flex flex-col items-center justify-end px-6 py-4 pb-0.5 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
                        >
                            <button type="button"
                                @click="isCreateModalOpen = false" {{-- Cierra isCreateModalOpen directamente --}}
                                class="w-full px-5 py-4 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                            >
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancelar
                            </button>
                            <x-button type="submit">
                                Guardar
                            </x-button>
                        </footer>
                    </form>
                </div>
            </div>
        </div>

        {{-- MODAL DE FILTROS (Implementado directamente en panel.blade.php) --}}
        <div
            x-show="isFilterModalOpen"
            x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
            @click.away="isFilterModalOpen = false"
            @keydown.escape.window="isFilterModalOpen = false"
        >
            <div
                x-transition:enter="transition ease-out duration-150"
                x-transition:enter-start="opacity-0 transform translate-y-1/2"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0 transform translate-y-1/2"
                class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                role="dialog"
                id="modal-filter"
                style="width: 80%; padding-bottom: 0;"
            >
                <header class="flex justify-end">
                    <button
                        class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover:text-gray-700"
                        aria-label="close"
                        @click="isFilterModalOpen = false" {{-- Cierra isFilterModalOpen directamente --}}
                    >
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <div class="mt-4 mb-6">
                    <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Filtrar Proyectos
                    </p>
                    <form action="{{ route('proyectos.index') }}" method="GET" id="filter-form">
                        {{-- No @csrf para formulario GET --}}
                        @include('components.proyectos.filter-form-fields', compact('clientes', 'personal'))

                        <footer style="margin-bottom: -1.8rem;"
                            class="flex flex-col items-center justify-end px-6 py-4 pb-0.5 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
                        >
                            <button type="button"
                                @click="isFilterModalOpen = false" {{-- Cierra isFilterModalOpen directamente --}}
                                class="w-full px-5 py-4 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
                            >
                                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Cancelar
                            </button>
                            <x-button type="submit" form="filter-form" class="h-10 px-5 py-2 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-1 1h-2a1 1 0 01-1-1v-3.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                </svg>
                                Aplicar Filtros
                            </x-button>
                        </footer>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>