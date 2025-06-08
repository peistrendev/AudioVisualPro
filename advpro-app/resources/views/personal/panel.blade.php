<x-app-layout>

    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Personal Administrativo
    </h2>

    <div class="mb-4">
        <button
            @click="openModal"
            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            Nuevo Personal
        </button>
    </div>

    <div class="w-full rounded-lg shadow-xs overflow-x-auto lg:overflow-visible">
        <div class="w-full rounded-lg shadow-xs overflow-x-auto xl:overflow-visible">
            <table class="w-full whitespace-nowrap min-w-[800px] xl:min-w-full xl:whitespace-normal">
                <thead>
                    <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3 w-1/6">NOMBRE</th>
                        <th class="px-4 py-3 w-1/6">DOCUMENTO</th>
                        <th class="px-4 py-3 w-1/6">EMAIL</th>
                        <th class="px-4 py-3 w-1/6">TELEFONO</th>
                        <th class="px-4 py-3 w-1/6">DIRECCION</th>
                        <th class="px-4 py-3 w-1/6">CARGO</th>
                        <th class="px-4 py-3 w-1/6">ESTADO</th>
                        <th class="px-4 py-3 w-1/12">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($staff as $personal)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div>
                                    <p class="font-semibold truncate">{{ $personal->nombre }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm truncate">
                          {{$personal->tipo_documento}}-{{$personal->documento}}
                        </td>
                        <td class="px-4 py-3 text-sm">
                          <span class="inline-block max-w-full truncate px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            {{$personal->email}}
                          </span>
                        </td>
                        <td class="px-4 py-3 text-sm truncate">
                          {{$personal->telefono}}
                        </td>
                        <td class="px-4 py-3 text-sm break-words">
                          {{$personal->direccion}}
                        </td>
                        <td class="px-4 py-3 text-sm break-words">
                            <span class="inline-block max-w-full truncate px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                            {{$personal->cargo}}
                          </span>
                        </td>
                        <td class="px-4 py-3 text-sm">                
                            @if ($personal->estado == "Activo")
                               <span class="inline-block max-w-full truncate px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                  Activo
                               </span>
                            @else
                                <span class="inline-block max-w-full truncate px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full dark:bg-red-700 dark:text-red-100">
                                  Desactivo
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                           <div class="flex items-center space-x- text-sm">
                              <a href="{{$personal->id}}/edit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Edit">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                  <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                </svg>
                              </a>
                              <form action="{{$personal->id}}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete" title="desactivar">
                                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 22 22">
                                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                  </svg>

                                </button>
                              </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
      class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
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
        class="px-6 py-4  overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
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
