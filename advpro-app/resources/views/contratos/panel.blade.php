<x-layouts.app>
  <h6 class="font-bold text-xl mb-4">Contrato de Servicios</h6>

  <div class="mb-4">
    <button
      onclick="openModal()"
      class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
      Nuevo Contrato
    </button>
  </div>

  <table class="min-w-full bg-white border border-gray-300">
    <thead class="bg-gray-200">
      <tr>
        <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">N° Contrato</th>
        <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Cliente</th>
        <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Fecha de Inicio</th>
        <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Fecha de Culminación</th>
        <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Lugar/Zona</th>
        <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Estado</th>
        <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Opciones</th>
      </tr>
    </thead>
    
  </table>

<!-- Modal para Crear Contrato -->
<div id="modal" class="fixed inset-0 z-50 flex items-center justify-center bg-transparent backdrop-blur-sm hidden">
  <div class="w-full max-w-xl bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Nuevo Contrato</h2>
      <button onclick="closeModal()" class="text-gray-400 hover:text-gray-300 text-2xl leading-none">&times;</button>
    </div>

    <form action="{{ route('contratos.store') }}" method="POST">
      @csrf

      {{-- Cliente --}}
      <div class="mb-4">
        <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Cliente</label>
        <select name="id_cliente" required
          class="w-full form-select text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
          <option value="">Seleccione un cliente</option>
          @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
          @endforeach
        </select>
      </div>
      {{-- Proyecto --}}
<div class="mb-4">
  <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Proyecto</label>
  <select name="id_proyecto" required
    class="w-full form-select text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
    <option value="">Seleccione un proyecto</option>
   @foreach($proyectos as $proyecto)
    <option value="{{ $proyecto->id }}">{{ $proyecto->nombre }}</option>
@endforeach
  </select>
</div>

{{-- Responsable --}}
<div class="mb-4">
  <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Responsable</label>
  <select name="id_responsable" required
    class="w-full form-select text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
    <option value="">Seleccione un responsable</option>
    @foreach($staff as $persona)
      <option value="{{ $persona->id }}">{{ $persona->nombre }}</option>
    @endforeach
  </select>
</div>

{{-- Fecha de Contrato --}}
<div class="mb-4">
  <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Fecha de Contrato</label>
  <input name="fecha_contrato" type="date" required
    class="w-full form-input text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
</div>

{{-- Tipo de Contrato --}}
<div class="mb-4">
  <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Tipo de Contrato</label>
  <input name="tipo_contrato" type="text" required placeholder="Ej: Servicios técnicos"
    class="w-full form-input text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
</div>

      {{-- Fechas --}}
      <div class="grid grid-cols-2 gap-4 mb-4">
        <div>
          <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Fecha de Inicio</label>
          <input name="fecha_inicio" type="date" required
            class="w-full form-input text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
        </div>
        <div>
          <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Fecha de Culminación</label>
          <input name="fecha_fin" type="date" required
            class="w-full form-input text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
        </div>
      </div>

      {{-- Lugar/Zona --}}
      <div class="mb-4">
        <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Lugar/Zona</label>
        <input name="lugar" type="text" required placeholder="Ej: Caracas, Zona 2"
          class="w-full form-input text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
      </div>

      {{-- Estado --}}
      <div class="mb-5">
        <label class="block text-sm text-gray-700 dark:text-gray-300 mb-1">Estado</label>
        <select name="estado" required
          class="w-full form-select text-sm dark:bg-gray-700 dark:text-white dark:border-gray-600">
          <option value="">Seleccione un estado</option>
          <option value="activo">Activo</option>
          <option value="pendiente">Pendiente</option>
          <option value="finalizado">Finalizado</option>
          <option value="cancelado">Cancelado</option>
        </select>
      </div>

      {{-- Acciones --}}
      <div class="flex justify-end space-x-3 border-t pt-4 border-gray-200 dark:border-gray-600">
        <button type="button" onclick="closeModal()"
          class="px-4 py-2 text-sm rounded bg-gray-300 text-gray-800 hover:bg-gray-400 dark:bg-gray-600 dark:text-white dark:hover:bg-gray-500 transition">
          Cancelar
        </button>
        <button type="submit"
          class="px-4 py-2 text-sm rounded bg-purple-600 text-white hover:bg-purple-700 transition">
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function openModal() {
    document.getElementById('modal').classList.remove('hidden');
  }

  function closeModal() {
    document.getElementById('modal').classList.add('hidden');
  }

  window.onclick = function (e) {
    const modal = document.getElementById('modal');
    if (e.target === modal) closeModal();
  }
</script>
</x-layouts.app>