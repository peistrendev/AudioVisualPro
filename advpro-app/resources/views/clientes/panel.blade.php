<x-layouts.app>
    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Clientes
    </h2>

    {{-- The x-data wraps both the button and the modal to manage the modal's state --}}
    <div x-data="{ isModalOpen: false }">
        <div class="mb-4">
            {{-- Button to open the client creation modal --}}
            <x-button @click="isModalOpen = true" type="button">
                Crear Cliente
            </x-button>
        </div>

        {{-- Generic table component for displaying the list of clients --}}
        <x-table :headers="['Nombre', 'Documento', 'Email', 'Telefono', 'Direccion', 'Opciones']">
            @forelse ($clientes as $client)
                {{-- Include the partial view for rendering each table row --}}
                @include('components.clientes.table-row', ['item' => $client, 'route_prefix' => 'clientes'])
            @empty
                {{-- Message if there are no clients to display --}}
                <tr class="text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3 text-center" colspan="6">No hay clientes para mostrar.</td>
                </tr>
            @endforelse
        </x-table>

        {{-- Laravel pagination for clients --}}
        <div class="mt-4">
            {{ $clientes->links() }}
        </div>

        {{-- Generic creation modal component --}}
        <x-create-modal
            modal_title="Crear Cliente"
            {{-- CRUCIAL CORRECTION! Using the route() helper for the correct URL --}}
            form_action="{{ route('clientes.store') }}"
            x-show="isModalOpen" {{-- Modal visibility based on Alpine state --}}
            @click.away="isModalOpen = false" {{-- Close modal when clicking outside --}}
            @keydown.escape.window="isModalOpen = false" {{-- Close modal when pressing Esc key --}}
        >
            {{-- Pass the form fields content directly as a slot --}}
            @include('components.clientes.create-form-fields')
        </x-create-modal>
    </div>
</x-layouts.app>