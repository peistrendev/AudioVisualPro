{{-- resources/views/components/proyectos/table-row.blade.php --}}
{{-- Este parcial espera $item (un proyecto) y $route_prefix --}}
<tr class="text-gray-700 dark:text-gray-400">
    <td class="px-4 py-3">
        <div class="flex items-center text-sm">
            <div>
                <p class="font-semibold">{{ $item->nombre }}</p>
            </div>
        </div>
    </td>
    {{-- Celdas separadas para Descripción --}}
    <td class="px-4 py-3 text-sm">
        {{ Str::limit($item->descripcion, 50) }}
    </td>
    {{-- Acceso correcto al nombre del cliente a través de la relación --}}
    <td class="px-4 py-3 text-sm">
        {{ $item->cliente->nombre ?? 'N/A' }}
    </td>
    {{-- Estado con colores de texto ajustados para mejor visibilidad en modo oscuro --}}
    <td class="px-4 py-3 text-sm">
        <span class="px-2 py-1 font-semibold leading-tight rounded-full
            @if ($item->estado == 'Realizado')
                text-green-700 bg-green-100 dark:bg-green-700 dark:text-white
            @elseif ($item->estado == 'En proceso')
                text-orange-700 bg-orange-100 dark:bg-orange-700 dark:text-white
            @elseif ($item->estado == 'En espera')
                text-blue-700 bg-blue-100 dark:bg-blue-700 dark:text-white
            @endif
        ">
            {{ $item->estado }}
        </span>
    </td>
    <td class="px-4 py-3 text-sm">
        {{ $item->fecha_inicio ? \Carbon\Carbon::parse($item->fecha_inicio)->format('d/m/Y') : 'N/A' }}
    </td>
    <td class="px-4 py-3 text-sm">
        {{ $item->fecha_fin ? \Carbon\Carbon::parse($item->fecha_fin)->format('d/m/Y') : 'N/A' }}
    </td>
    <td class="px-4 py-3 text-sm">
        ${{ number_format($item->presupuesto, 2, ',', '.') }}
    </td>
    <td class="px-4 py-3 text-sm truncate">
        {{ $item->lugar ?? 'N/A' }}
    </td>
    <td class="px-4 py-3 text-sm truncate">
        {{ $item->responsable }}
    </td>
    <td class="px-4 py-3">
        <div class="flex items-center space-x-4 text-sm">
            {{-- Enlace para editar --}}
            <a href="{{ route($route_prefix . '.edit', $item->id) }}"
                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                aria-label="Edit">
                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                </svg>
            </a>

            {{-- Formulario para eliminar --}}
            <form action="{{ route($route_prefix . '.destroy', $item->id) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                    aria-label="Delete"
                    onclick="return confirm('¿Estás seguro de que quieres eliminar este proyecto?');"> {{-- Confirmación simple --}}
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 011-1h4a1 1 0 110 2H8a1 1 0 01-1-1z"></path>
                    </svg>
                </button>
            </form>
        </div>
    </td>
</tr>