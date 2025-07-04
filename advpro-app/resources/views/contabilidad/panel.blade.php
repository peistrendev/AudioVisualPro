<x-layouts.app>
    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Módulo Contable
    </h2>

    <div x-data="{ isModalOpen: false }">
        {{-- Contenedor de Botones y Filtros --}}
        <div class="flex items-end justify-between mb-6">

            {{-- 1. Botón para Abrir Modal (placeholder, sin funcionalidad aún) --}}
            <x-button @click="isModalOpen = true" type="button">
                Registrar Asiento Manual
            </x-button>

            {{-- 2. Placeholder para filtros (si decides implementarlos en el futuro) --}}
            <div></div>

            {{-- 3. Botón "Generar Reporte" (sin funcionalidad por ahora) --}}
            <a href="#"
                class="h-10 px-5 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-purple flex items-center justify-center gap-2"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                Generar Reporte
            </a>
        </div>

        {{-- Tabla con botones de tipos de cuenta --}}
        <x-table :headers="['Tipo de Cuenta', 'Acción']">
            @foreach (['Activo', 'Pasivo', 'Capital', 'Ingreso', 'Egreso'] as $tipo)
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 font-semibold">{{ $tipo }}</td>
                    <td class="px-4 py-3">
                        <button class="h-9 px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Registrar {{ $tipo }}
                        </button>
                    </td>
                </tr>
            @endforeach
        </x-table>

        {{-- Modal genérico (sin contenido aún) --}}
        <x-create-modal
            modal_title="Registrar Asiento Contable"
            form_action="#"
            x-show="isModalOpen"
            @click.away="isModalOpen = false"
            @keydown.escape.window="isModalOpen = false"
        >
            <div class="text-gray-600 dark:text-gray-300">
                Aquí iría el formulario para registrar manualmente un asiento contable.
            </div>
        </x-create-modal>
    </div>
</x-layouts.app>
