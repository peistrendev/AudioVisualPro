<x-app-layout>
    <form action="{{ url('proyectos', ['proyecto' => $proyecto->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Editar Proyecto</h1>
            <a href="{{ url('proyectos/panel') }}" class="text-sm text-gray-500 hover:text-gray-700">Volver</a>
        </div>

        <div class="flex gap-x-6 mb-6">
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Nombre del Proyecto</label>
                <input type="text" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" name="nombre" value="{{ $proyecto->nombre }}" required>
            </div>
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Descripción</label>
                <textarea class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded placeholder-gray-400 focus:outline-none" name="descripcion" required>{{ $proyecto->descripcion }}</textarea>
            </div>
        </div>

        <div class="flex gap-x-6 mb-6">
            {{-- Cliente con select --}}
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Cliente</label>
                <select name="cliente" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full focus:outline-none" required>
                    <option value="" disabled>Seleccione un cliente</option>
                    @foreach ($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ $proyecto->cliente == $cliente->id ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Fecha de Inicio</label>
                <input type="date" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" name="fecha_inicio" value="{{ $proyecto->fecha_inicio }}" required>
            </div>
        </div>

        <div class="flex gap-x-6 mb-6">
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Fecha de Fin</label>
                <input type="date" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" name="fecha_fin" value="{{ $proyecto->fecha_fin }}">
            </div>
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Presupuesto</label>
                <input type="number" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" name="presupuesto" value="{{ $proyecto->presupuesto }}" required>
            </div>
        </div>

        <div class="flex gap-x-6 mb-6">
            {{-- Estado con select --}}
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Estado</label>
                <select name="estado" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full focus:outline-none" required>
                    <option value="" disabled>Seleccione un estado</option>
                    <option value="En espera" {{ $proyecto->estado == 'En espera' ? 'selected' : '' }}>En espera</option>
                    <option value="En proceso" {{ $proyecto->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                    <option value="Realizado" {{ $proyecto->estado == 'Realizado' ? 'selected' : '' }}>Realizado</option>
                </select>
            </div>

            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Lugar</label>
                <input type="text" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" name="lugar" value="{{ $proyecto->lugar }}">
            </div>
        </div>

        <div class="w-full relative mb-6">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Responsable</label>
            <input type="text" class="block w-full h-11 px-5 py-2.5 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none" name="responsable" value="{{ $proyecto->responsable }}" required>
        </div>

        <center>
            <button class="w-52 h-12 shadow-sm rounded-full bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 text-white text-base font-semibold leading-7">Guardar</button>
        </center>
    </form>
</x-app-layout>
