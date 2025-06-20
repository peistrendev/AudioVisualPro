<x-layouts.app>
    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Proyectos
    </h2>

    <div x-data="{ isModalOpen: false }">
        <div class="mb-4">
            <x-button @click="isModalOpen = true" type="button">
                Crear Proyecto
            </x-button>
        </div>

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
            {{ $proyectos->links() }}
        </div>

        <x-create-modal
            modal_title="Crear Proyecto"
            form_action="{{ route('proyectos.store') }}"
            x-show="isModalOpen"
            @click.away="isModalOpen = false"
            @keydown.escape.window="isModalOpen = false"
        >
            {{-- Asegúrate de que este include pase las variables necesarias --}}
            @include('components.proyectos.create-form-fields', compact('clientes', 'personal'))
        </x-create-modal>
    </div>
</x-layouts.app>