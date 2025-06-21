<x-layouts.app> 

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Equipos
    </h2>

    
    <div x-data="{ isModalOpen: false, openModal() { this.isModalOpen = true }, closeModal() { this.isModalOpen = false } }">

        {{-- El botón para abrir el modal --}}
        <div class="mb-4"> 
           
            <x-button @click="openModal" type="button">
                Nuevo Equipo
            </x-button>
        </div>

        {{-- La tabla de equipos --}}
        <x-table :headers="['Nombre', 'Descripción', 'Marca', 'Tipo de Equipo', 'Estado', 'Ubicación', 'Responsable', 'Acciones']">
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($equipos as $equipo)
                    @include('components.equipos.table-row', ['item' => $equipo, 'route_prefix' => 'equipos'])
                @empty
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td colspan="8" class="px-4 py-3 text-center">No hay equipos para mostrar.</td>
                    </tr>
                @endforelse
            </tbody>
        </x-table>

        {{-- Paginación de Laravel --}}
        <div class="mt-4">
            {{ $equipos->links() }}
        </div>


        <x-create-modal
            modal_title="Crear Equipo"
            form_action="{{ route('equipos.store') }}"
            x-show="isModalOpen" 
            @click.away="closeModal"
            @keydown.escape.window="closeModal"
        >
            @include('components.equipos.create-form-fields', ['personal' => $personal])
        </x-create-modal>

    </div> 

</x-layouts.app>