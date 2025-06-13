<x-app-layout>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Personal Administrativo
    </h2>

    <x-button>
      <x-slot name="accion">
        @click="openModal"
      </x-slot>
      <x-slot name="type">
        button
      </x-slot>
      Nuevo Personal
    </x-button>

    <div>
      @php
        $headers = ['NOMBRE', 'DOCUMENTO', 'EMAIL', 'TELEFONO', 'DIRECCION', 'CARGO', 'ESTADO', 'Acciones'];
    @endphp

    <x-table :headers="$headers">
        @foreach($staff as $personal)
            <x-table.row :item="$personal">
                <x-table.cell truncate>
                    <p class="font-semibold">{{ $personal->nombre }}</p>
                </x-table.cell>
                
                <x-table.cell truncate>
                    {{ $personal->tipo_documento }}-{{ $personal->documento }}
                </x-table.cell>
                
                <x-table.cell status="success">
                    {{ $personal->email }}
                </x-table.cell>
                
                <x-table.cell truncate>
                    {{ $personal->telefono }}
                </x-table.cell>
                
                <x-table.cell breakWords>
                    {{ $personal->direccion }}
                </x-table.cell>
                
                <x-table.cell status="success">
                    {{ $personal->cargo }}
                </x-table.cell>
                
                <x-table.cell status="{{ $personal->estado == 'Activo' ? 'danger' : 'danger' }}">
                    {{ $personal->estado }}
                </x-table.cell>
                
               <x-table.actions 
                    edit-route="{{ url('/personal/' . $personal->id . '/edit') }}"
                    delete-route="{{ url('/personal/' . $personal->id) }}"
                />
            </x-table.row>
        @endforeach
    </x-table>
    </div>



      <!-- Paginación (mantener igual) -->
        <div
          class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
        >
          <span class="flex items-center col-span-3">
            Showing 21-30 of 100
          </span>
          <span class="col-span-2"></span>
          <!-- Pagination -->
          <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
              <ul class="inline-flex items-center">
                <li>
                  <button
                    class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple"
                    aria-label="Previous"
                  >
                    <svg
                      class="w-4 h-4 fill-current"
                      aria-hidden="true"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd"
                        fill-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                </li>
                <li>
                  <button
                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                  >
                    1
                  </button>
                </li>
                <li>
                  <button
                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                  >
                    2
                  </button>
                </li>
                <li>
                  <button
                    class="px-3 py-1 text-white transition-colors duration-150 bg-purple-600 border border-r-0 border-purple-600 rounded-md focus:outline-none focus:shadow-outline-purple"
                  >
                    3
                  </button>
                </li>
                <li>
                  <button
                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                  >
                    4
                  </button>
                </li>
                <li>
                  <span class="px-3 py-1">...</span>
                </li>
                <li>
                  <button
                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                  >
                    8
                  </button>
                </li>
                <li>
                  <button
                    class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple"
                  >
                    9
                  </button>
                </li>
                <li>
                  <button
                    class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple"
                    aria-label="Next"
                  >
                    <svg
                      class="w-4 h-4 fill-current"
                      aria-hidden="true"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"
                        fill-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                </li>
              </ul>
            </nav>
          </span>
        </div>
    </div>

        <div class="mt-4">
            {{ $staff->links() }}    
        </div>


    <div 
        
      x-show="isModalOpen"
      x-transition:enter="transition ease-out duration-150"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center "
      >
      <!-- Modal -->
      <div
        x-show="isModalOpen"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0  transform translate-y-1/2"
        @click.away="closeModal"
        @keydown.escape="closeModal"
        class="px-6 py-4  overflow-hidden  bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog"
        id="modal"
        >
        <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
        <header class="flex justify-end">
          <button
            class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
            aria-label="close"
            @click="closeModal"
          >
            <svg
              class="w-4 h-4"
              fill="currentColor"
              viewBox="0 0 20 20"
              role="img"
              aria-hidden="true"
            >
              <path
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"
                fill-rule="evenodd"
              ></path>
            </svg>
          </button>
        </header>
        <!-- Modal body -->
        <div class="mt-4 mb-6 ">
          <!-- Modal title -->
         <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
        Nuevo Personal
    </p>

    <form action="{{ url('/personal/save') }}" method="POST" class="max-w-md mx-auto">
        @csrf

            <div class="mt-2  text-sm">
              <span class="text-gray-700 dark:text-gray-400">
                Documento de indentidad
              </span>
              <div>
                <label class="inline-flex items-center  text-sm">
                    <select name="tipo_documento" id="tipo_documento" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                      <option value="" selected disabled>-</option>
                      <option value="V">V</option>
                      <option value="J">J</option>
                      <option value="E">E</option>
                      <option value="G">G</option>
                    </select>
                </label>
                <label class="inline-flex items-center text-sm">
                  <input name="documento"
                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Cedula/Rif"
                  />
                </label>
              </div>
            </div>
            <label class="block mt-2 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Nombre y Apellido</span>
              <input name="nombre"
                class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Juan Luis Guerra"
              />
            </label>
            <label class="block mt-2 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Email</span>
              <input type="email" name="email"
                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Juan Luis Guerra"
              />
            </label>
            <label class="block mt-2 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Telefono</span>
              <input type="text" name="telefono"
                class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="0424-0426-0414-0416-0412"
              />
            </label>
               <label class="block mt-2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Direccion</span>
                <input type="text" name="direccion"
                  class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                  placeholder="Cualquier calle, ciudad, estado"
                />
            </label>
            <label class="block mt-2 items-center  text-sm">
              <span class="text-gray-700 dark:text-gray-400">Cargo</span>
              <select name="cargo" id="cargo" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="" selected disabled>Seleccionar</option>
                <option value="Produccion">Produccion</option>
                <option value="Direccion">Direccion</option>
                <option value="Logística & Equipo">Logística & Equipo</option>
                <option value="Guion y Desarrollo">Guion y Desarrollo</option>
                <option value="Fotografia y Camara">Fotografia y Camara</option>
                <option value="Sonido">Sonido</option>
                <option value="Arte & Escenografía">Arte & Escenografía</option>
                <option value="Iluminación y Eléctricos">Iluminación y Eléctricos</option>
                <option value="Postproducción">Postproducción</option>
              </select>
            </label>

        <!-- Botones de acción -->
        <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
            <button type="button" 
            @click="closeModal"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Cancelar
            </button>
            <button type="submit"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Guardar
            </button>
        </footer>
    </form>

</x-app-layout>
