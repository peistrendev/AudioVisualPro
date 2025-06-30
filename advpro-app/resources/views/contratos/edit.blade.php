<x-layouts.app>
    <form action="{{ route('contratos.update', $contrato->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h1 class="text-2xl font-semibold text-gray-800 dark:text-white mb-6">Editar Contrato</h1>

        <div class="grid md:grid-cols-2 gap-6 mb-6">
            {{-- Cliente --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Cliente</label>
                <select name="id_cliente" class="form-select dark:bg-gray-700 dark:text-white">
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $contrato->id_cliente == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Proyecto --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Proyecto</label>
                <select name="id_proyecto" class="form-select dark:bg-gray-700 dark:text-white">
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ $contrato->id_proyecto == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Responsable --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Responsable</label>
                <select name="id_responsable" class="form-select dark:bg-gray-700 dark:text-white">
                    @foreach($staff as $persona)
                        <option value="{{ $persona->id }}" {{ $contrato->id_responsable == $persona->id ? 'selected' : '' }}>
                            {{ $persona->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Fecha de contrato --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Fecha del Contrato</label>
                <input type="date" name="fecha_contrato"
                    value="{{ old('fecha_contrato', $contrato->fecha_contrato->format('Y-m-d')) }}"
                    class="form-input dark:bg-gray-700 dark:text-white w-full">
            </div>

            {{-- Tipo --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Tipo de Contrato</label>
                <input type="text" name="tipo_contrato"
                    value="{{ old('tipo_contrato', $contrato->tipo_contrato) }}"
                    class="form-input dark:bg-gray-700 dark:text-white w-full">
            </div>

            {{-- Tiempo --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Duración / Tiempo</label>
                <input type="text" name="tiempo_contrato"
                    value="{{ old('tiempo_contrato', $contrato->tiempo_contrato) }}"
                    class="form-input dark:bg-gray-700 dark:text-white w-full">
            </div>

            {{-- Estado --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Estado</label>
                @php
                    $estados = ['activo', 'inactivo', 'finalizado', 'pendiente'];
                @endphp
                <select name="estado" class="form-select dark:bg-gray-700 dark:text-white">
                    @foreach ($estados as $estado)
                        <option value="{{ $estado }}" {{ $contrato->estado == $estado ? 'selected' : '' }}>
                            {{ ucfirst($estado) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Documento --}}
            <div>
                <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Documento</label>
                @if($contrato->documento)
                    <a href="{{ Storage::url($contrato->documento) }}" target="_blank" class="text-blue-500 underline text-sm">Ver actual</a>
                @endif
                <input type="file" name="documento" class="form-input dark:bg-gray-700 dark:text-white w-full mt-2">
            </div>
        </div>

        {{-- Observaciones --}}
        <div class="mb-6">
            <label class="text-sm text-gray-600 dark:text-gray-300 font-medium">Observaciones</label>
            <textarea name="observaciones" rows="4"
                class="w-full form-textarea dark:bg-gray-700 dark:text-white">{{ old('observaciones', $contrato->observaciones) }}</textarea>
        </div>

        <div class="flex justify-center">
            <button type="submit"
                class="px-6 py-3 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-800 transition-all duration-300">
                Guardar Cambios
            </button>
        </div>
    </form>
</x-layouts.app>