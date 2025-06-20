<x-layouts.app>

<div class="flex items-center justify-center p-4">
  <div class="max-w-4xl p-6 bg-white rounded-lg shadow-md dark:bg-gray-800"> {{-- Increased max-w-md to max-w-4xl for more width for two columns --}}
    <div class="mb-6">
      <div class="flex justify-between items-center mb-6"> {{-- Grouped title and back button --}}
        <p class="text-2xl font-semibold text-gray-800 dark:text-gray-300">
          Editar Proyecto
        </p>
        <a href="{{ url('proyectos/panel') }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          Volver
        </a>
      </div>
      <form action="{{ url('proyectos', ['proyecto' => $proyecto->id]) }}" method="POST" >
        @csrf
        @method('PUT')

        {{-- Nombre del Proyecto y Descripción (Two columns) --}}
        <div class="flex gap-x-6 mb-6">
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Nombre del Proyecto</span>
                <input type="text" name="nombre"
                    class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{ old('nombre', $proyecto->nombre) }}" required
                />
            </label>
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Descripción</span>
                <textarea name="descripcion"
                    class="block w-full h-24 px-5 py-2.5 border border-gray-300 rounded placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-textarea"
                    required>{{ old('descripcion', $proyecto->descripcion) }}</textarea>
            </label>
        </div>

        {{-- Cliente y Fecha de Inicio (Two columns) --}}
        <div class="flex gap-x-6 mb-6">
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Cliente</span>
                <select name="cliente" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-select" required>
                    <option value="" disabled>Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente', $proyecto->cliente) == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </label>
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Fecha de Inicio</span>
                <input type="date" name="fecha_inicio"
                    class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{ old('fecha_inicio', $proyecto->fecha_inicio) }}" required
                />
            </label>
        </div>

        {{-- Fecha de Fin y Presupuesto (Two columns) --}}
        <div class="flex gap-x-6 mb-6">
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Fecha de Fin</span>
                <input type="date" name="fecha_fin"
                    class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{ old('fecha_fin', $proyecto->fecha_fin) }}"
                />
            </label>
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Presupuesto</span>
                <input type="number" name="presupuesto"
                    class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{ old('presupuesto', $proyecto->presupuesto) }}" required
                />
            </label>
        </div>

        {{-- Estado y Lugar (Two columns) --}}
        <div class="flex gap-x-6 mb-6">
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Estado</span>
                <select name="estado" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-select" required>
                    <option value="" disabled>Seleccione un estado</option>
                    <option value="En espera" {{ old('estado', $proyecto->estado) == 'En espera' ? 'selected' : '' }}>En espera</option>
                    <option value="En proceso" {{ old('estado', $proyecto->estado) == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                    <option value="Realizado" {{ old('estado', $proyecto->estado) == 'Realizado' ? 'selected' : '' }}>Realizado</option>
                </select>
            </label>
            <label class="block w-full relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Lugar</span>
                <input type="text" name="lugar"
                    class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{ old('lugar', $proyecto->lugar) }}"
                />
            </label>
        </div>

        {{-- Responsable (Single column) --}}
        <div class="w-full relative mb-6">
            <label class="block relative">
                <span class="flex items-center mb-2 text-gray-600 text-sm font-medium dark:text-gray-400">Responsable</span>
                <input type="text" name="responsable"
                    class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    value="{{ old('responsable', $proyecto->responsable) }}" required
                />
            </label>
        </div>

        <div class="flex items-center justify-center mt-6">
            <button type="submit" class="w-52 h-12 shadow-sm rounded-full bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 text-white text-base font-semibold leading-7">
                Guardar
            </button>
        </div>
      </form>
    </div>
  </div>
</div>
</x-layouts.app>