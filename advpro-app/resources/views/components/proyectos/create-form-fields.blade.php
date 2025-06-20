{{-- resources/views/components/proyectos/create-form-fields.blade.php --}}

<div class="flex gap-x-6 mb-6">
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Nombre del Proyecto</span>
        <input type="text" name="nombre"
            class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="Nombre del Proyecto" value="{{ old('nombre') }}" required
        />
    </label>
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Descripción</span>
        <textarea name="descripcion"
            class="block w-full h-24 px-5 py-2.5 border border-gray-300 rounded placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-textarea"
            placeholder="Descripción del proyecto" required>{{ old('descripcion') }}</textarea>
    </label>
</div>

<div class="flex gap-x-6 mb-6">
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Cliente</span>
        <select name="cliente" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-select" required>
            <option value="" disabled selected>Seleccione un cliente</option>
            @foreach ($clientes as $cliente)
                <option value="{{ $cliente->id }}" {{ old('cliente') == $cliente->id ? 'selected' : '' }}>
                    {{ $cliente->nombre }}
                </option>
            @endforeach
        </select>
    </label>
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Fecha de Inicio</span>
        <input type="date" name="fecha_inicio"
            class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            value="{{ old('fecha_inicio') }}" required
        />
    </label>
</div>

<div class="flex gap-x-6 mb-6">
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Fecha de Fin (Opcional)</span>
        <input type="date" name="fecha_fin"
            class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            value="{{ old('fecha_fin') }}"
        />
    </label>
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Presupuesto</span>
        <input type="number" name="presupuesto"
            class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="0.00" step="0.01" value="{{ old('presupuesto') }}" required
        />
    </label>
</div>

<div class="flex gap-x-6 mb-6">
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Estado</span>
        <select name="estado" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-select" required>
            <option value="" disabled selected>Seleccione un estado</option>
            <option value="En espera" {{ old('estado') == 'En espera' ? 'selected' : '' }}>En espera</option>
            <option value="En proceso" {{ old('estado') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="Realizado" {{ old('estado') == 'Realizado' ? 'selected' : '' }}>Realizado</option>
        </select>
    </label>
    <label class="block w-full relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Lugar (Opcional)</span>
        <input type="text" name="lugar"
            class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
            placeholder="Lugar del proyecto" value="{{ old('lugar') }}"
        />
    </label>
</div>

<div class="w-full relative mb-6">
    <label class="block relative">
        <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Responsable</span>
        <select name="responsable" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-select" required>
            <option value="" disabled selected>Seleccione un responsable</option>
            @foreach ($personal as $person) {{-- Asumiendo que 'personal' es la colección de usuarios/empleados --}}
                <option value="{{ $person->nombre }}" {{ old('responsable') == $person->nombre ? 'selected' : '' }}>
                    {{ $person->nombre }}
                </option>
            @endforeach
        </select>
    </label>
</div>