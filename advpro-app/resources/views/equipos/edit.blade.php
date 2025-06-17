<x-app-layout>
    <form action="{{ url('equipos', ['equipo' => $equipo->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Editar Equipo</h1>
            <a href="{{ url('equipos/panel') }}" class="text-sm text-gray-500 hover:text-gray-700">Volver</a>
        </div>

        <div class="flex gap-x-6 mb-6">
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Nombre del equipo</label>
                <input type="text" class="block w-full h-11 px-5 py-2.5 bg-white shadow-xs text-gray-900 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    name="nombre" value="{{ $equipo->nombre }}" required>
            </div>

            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Marca</label>
                <input type="text" class="block w-full h-11 px-5 py-2.5 bg-white shadow-xs text-gray-900 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    name="marca" value="{{ $equipo->marca }}" required>
            </div>
        </div>

        <div class="flex gap-x-6 mb-6">
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Tipo de Equipo</label>
                <select name="tipo_equipo" class="block w-full h-11 px-5 py-2.5 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="{{ $equipo->tipo_equipo }}" selected>{{ $equipo->tipo_equipo }}</option>
                    <option value="Fotografía">Fotografía</option>
                    <option value="Video">Video</option>
                    <option value="Sonido">Sonido</option>
                    <option value="Iluminación">Iluminación</option>
                </select>
            </div>

            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Estado</label>
                <select name="estado" class="block w-full h-11 px-5 py-2.5 bg-white border border-gray-300 rounded-full focus:outline-none">
                    <option value="{{ $equipo->estado }}" selected>{{ $equipo->estado }}</option>
                    <option value="Nuevo">Nuevo</option>
                    <option value="Usado">Usado</option>
                    <option value="Reparado">Reparado</option>
                </select>
            </div>
        </div>

        <div class="flex gap-x-6 mb-6">
            <div class="w-full relative">
                <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Ubicación</label>
                <input type="text" class="block w-full h-11 px-5 py-2.5 bg-white shadow-xs text-gray-900 border border-gray-300 rounded-full placeholder-gray-400 focus:outline-none"
                    name="ubicacion" value="{{ $equipo->ubicacion }}" required>
            </div>

            <div class="w-full relative mb-6">
            <label class="block mt-2 mb-2 items-center  text-sm">
              <span class="text-gray-700 dark:text-gray-400">Responsable</span>
              <select name="responsable" id="cargo" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="" selected disabled>Seleccionar</option>
                @foreach ($personal as $staff)
                    <option value="{{ $staff->id }}" >
                       {{$staff->nombre}}
                    </option>
                @endforeach
              </select>
            </label>
            </div>
        </div>

        <div class="w-full relative">
            <label class="flex items-center mb-2 text-gray-600 text-sm font-medium">Descripción</label>
            <textarea name="descripcion"
                class="block w-full h-20 px-5 py-2.5 bg-white border border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none">{{ $equipo->descripcion }}</textarea>
        </div>

        <center>
            <button class="w-52 h-12 shadow-sm rounded-full bg-indigo-600 hover:bg-indigo-800 transition-all duration-700 text-white text-base font-semibold leading-7">
                Guardar
            </button>
        </center>
    </form>
</x-app-layout>