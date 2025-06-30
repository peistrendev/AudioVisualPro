<x-layouts.app>
    <form action="{{ route('contratos.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="max-w-xl mx-auto">

            {{-- Cliente --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Cliente</span>
                <select name="id_cliente" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-select">
                    <option value="" disabled selected>Seleccionar cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('id_cliente') == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </label>

            {{-- Proyecto --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Proyecto</span>
                <select name="id_proyecto" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-select">
                    <option value="" disabled selected>Seleccionar proyecto</option>
                    @foreach($proyectos as $proyecto)
                        <option value="{{ $proyecto->id }}" {{ old('id_proyecto') == $proyecto->id ? 'selected' : '' }}>
                            {{ $proyecto->nombre }}
                        </option>
                    @endforeach
                </select>
            </label>

            {{-- Responsable --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Responsable (Staff)</span>
                <select name="id_responsable" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-select">
                    <option value="" disabled selected>Seleccionar responsable</option>
                    @foreach($staff as $persona)
                        <option value="{{ $persona->id }}" {{ old('id_responsable') == $persona->id ? 'selected' : '' }}>
                            {{ $persona->nombre }}
                        </option>
                    @endforeach
                </select>
            </label>

            {{-- Fecha --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Fecha de Contrato</span>
                <input type="date" name="fecha_contrato" value="{{ old('fecha_contrato') }}"
                    class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-input">
            </label>

            {{-- Tipo --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Tipo de Contrato</span>
                <input name="tipo_contrato" value="{{ old('tipo_contrato') }}"
                    placeholder="Ej: Prestación de servicios"
                    class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-input">
            </label>

            {{-- Duración --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Duración / Tiempo</span>
                <input name="tiempo_contrato" value="{{ old('tiempo_contrato') }}"
                    placeholder="Ej: 6 meses, 1 año"
                    class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-input">
            </label>

            {{-- Estado --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Estado</span>
                @php
                    $estados = ['activo', 'inactivo', 'finalizado', 'pendiente'];
                @endphp
                <select name="estado" class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-select">
                    <option value="" disabled selected>Seleccionar estado</option>
                    @foreach ($estados as $estado)
                        <option value="{{ $estado }}" {{ old('estado') == $estado ? 'selected' : '' }}>
                            {{ ucfirst($estado) }}
                        </option>
                    @endforeach
                </select>
            </label>

            {{-- Observaciones --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Observaciones</span>
                <textarea name="observaciones"
                    placeholder="Notas adicionales"
                    class="block w-full mt-1 text-sm dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 form-textarea"
                >{{ old('observaciones') }}</textarea>
            </label>

            {{-- Documento --}}
            <label class="block mt-4 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Documento (PDF/DOC)</span>
                <input type="file" name="documento"
                    class="block mt-1 w-full text-sm text-white dark:bg-gray-700 dark:border-gray-600 form-input">
            </label>

            {{-- Botón --}}
            <div class="flex justify-center mt-6">
                <button type="submit"
                    class="px-6 py-3 rounded-full bg-indigo-600 text-white font-semibold hover:bg-indigo-800 transition-all duration-300">
                    Guardar Contrato
                </button>
            </div>
        </div>
    </form>
</x-layouts.app>