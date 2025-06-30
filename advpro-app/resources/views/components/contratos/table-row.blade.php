<tr class="text-gray-700 dark:text-gray-400">

    {{-- Cliente --}}
    <td class="px-4 py-3 text-sm truncate">
        {{ $item->cliente?->nombre ?? '—' }}
    </td>

    {{-- Proyecto --}}
    <td class="px-4 py-3 text-sm truncate">
        {{ $item->proyecto?->nombre ?? '—' }}
    </td>

    {{-- Responsable --}}
    <td class="px-4 py-3 text-sm truncate">
        {{ $item->responsable?->nombre ?? '—' }}
    </td>

    {{-- Tipo de Contrato --}}
    <td class="px-4 py-3 text-sm truncate">
        {{ $item->tipo_contrato ?? '—' }}
    </td>

    {{-- Fecha de Contrato --}}
    <td class="px-4 py-3 text-sm truncate">
        {{ $item->fecha_contrato?->format('d/m/Y') ?? '—' }}
    </td>

    {{-- Estado --}}
    <td class="px-4 py-3 text-sm truncate">
        {{ ucfirst($item->estado) ?? '—' }}
    </td>

    {{-- Documento --}}
    <td class="px-4 py-3 text-sm truncate">
        @if ($item->documento)
            <a href="{{ Storage::url($item->documento) }}" target="_blank" class="text-blue-500 underline">
                Ver
            </a>
        @else
            —
        @endif
    </td>

    {{-- Acciones --}}
    <td class="px-4 py-3">
        <div class="flex items-center space-x-4 text-sm">

            {{-- Editar --}}
            <a href="{{ route($route_prefix . '.edit', $item->id) }}"
               class="flex items-center justify-between px-2 py-2 text-purple-600 dark:text-gray-400 hover:text-purple-800 focus:outline-none"
               aria-label="Editar">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                </svg>
            </a>

            {{-- Eliminar --}}
            <form action="{{ route($route_prefix . '.destroy', $item->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                        onclick="return confirm('¿Estás seguro de que quieres eliminar este contrato?');"
                        class="flex items-center justify-between px-2 py-2 text-purple-600 dark:text-gray-400 hover:text-red-600 focus:outline-none"
                        aria-label="Eliminar">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                              clip-rule="evenodd"></path>
                    </svg>
                </button>
            </form>
        </div>
    </td>
</tr>