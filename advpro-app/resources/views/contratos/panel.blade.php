<x-app-layout>
  <h6 class="font-bold text-xl mb-4">Contrato de Servicios</h6>
  <div class="mb-4">
    <button type="button" onclick="openModal()" class="px-4 py-2 bg-[#462E7C] text-white rounded hover:bg-[#5A3F9D]">
      Crear Contrato
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
    <tbody>
        <!-- Aquí irían las filas de datos -->
    </tbody>
  </table>

  <!-- Modal para Crear Contrato -->
  <div id="modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
      <div class="mt-3">
        <div class="flex justify-between items-center pb-3 border-b">
          <h3 class="text-lg leading-6 font-medium text-gray-900">Nuevo Contrato</h3>
          <button onclick="closeModal()" class="text-gray-400 hover:text-gray-500">
            <span class="text-2xl">&times;</span>
          </button>
        </div>

        <form action="save" method="POST" class="mt-4">
          @csrf
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="numero_contrato">
              N° Contrato
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="numero_contrato" name="numero_contrato" type="text" placeholder="Ingrese el número de contrato" required>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="cliente">
              Cliente
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="cliente" name="cliente" required>
              <option value="">Seleccione un cliente</option>
              @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
              <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_inicio">
                Fecha de Inicio
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                     id="fecha_inicio" name="fecha_inicio" type="date" required>
            </div>
            <div>
              <label class="block text-gray-700 text-sm font-bold mb-2" for="fecha_fin">
                Fecha de Culminación
              </label>
              <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                     id="fecha_fin" name="fecha_fin" type="date" required>
            </div>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="lugar">
              Lugar/Zona
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="lugar" name="lugar" type="text" placeholder="Ingrese el lugar o zona" required>
          </div>

          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="estado">
              Estado
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="estado" name="estado" required>
              <option value="">Seleccione un estado</option>
              <option value="activo">Activo</option>
              <option value="pendiente">Pendiente</option>
              <option value="finalizado">Finalizado</option>
              <option value="cancelado">Cancelado</option>
            </select>
          </div>

          <div class="flex items-center justify-between pt-4 border-t">
            <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">
              Cancelar
            </button>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
              Guardar Contrato
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Función para abrir el modal
    function openModal() {
      document.getElementById('modal').classList.remove('hidden');
    }

    // Función para cerrar el modal
    function closeModal() {
      document.getElementById('modal').classList.add('hidden');
    }

    // Cerrar el modal si se hace clic fuera del contenido
    window.onclick = function(event) {
      const modal = document.getElementById('modal');
      if (event.target === modal) {
        closeModal();
      }
    }
  </script>
</x-app-layout>