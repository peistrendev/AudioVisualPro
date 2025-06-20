<x-app-layout>
   
    <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
    Proyectos</h2>
        <x-button>
      <x-slot name="accion">
        @click="openModal"
      </x-slot>
      <x-slot name="type">
        button
      </x-slot>
      Nuevo Proyecto
    </x-button>

    <div class="w-full rounded-lg shadow-xs overflow-x-auto lg:overflow-visible">
      <div class="w-full rounded-lg shadow-xs overflow-x-auto xl:overflow-visible">
        <table class="w-full whitespace-nowrap min-w-[800px] xl:min-w-full xl:whitespace-normal">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
              <th class="px-4 py-3 w-1/6">Nombre</th>
              <th class="px-4 py-3 w-1/6">Descripción</th>
              <th class="px-4 py-3 w-1/6">Cliente</th>
              <th class="px-4 py-3 w-1/6">Fecha Inicio</th>
              <th class="px-4 py-3 w-1/6">Fecha Fin</th>
              <th class="px-4 py-3 w-1/6">Presupuesto</th>
              <th class="px-4 py-3 w-1/3">Estado</th>
              <th class="px-4 py-3 w-1/3">Responsable</th>
              <th class="px-4 py-3 w-1/12">Opciones</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
            @foreach ($proyectos as $proyecto)
            <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3 break-words">
                <div class="flex items-center text-sm">
                  <div>
                    <p class="font-semibold truncate">{{$proyecto->nombre}}</p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-3 text-sm break-words">
      
                  {{$proyecto->descripcion}}
              </td>
                <td class="px-4 py-3 text-sm">                  
                    {{$proyecto->cliente}}
                </td>
              <td class="px-4 py-3 text-sm">
                {{$proyecto->fecha_inicio}}
              </td>
              <td class="px-4 py-3 text-sm">
                {{$proyecto->fecha_fin}}
              </td>
              <td class="px-4 py-3 text-sm">
                <span class="inline-block max-w-full truncate px-2 py-1 font-semibold leading-tight text-purple-700 bg-purple-100 rounded-full dark:bg-purple-700 dark:text-purple-100">
                  {{$proyecto->presupuesto}}
                </span>
              </td>
              <td class="px-4 py-3 text-sm">
                <span class="inline-block max-w-full truncate px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                  {{$proyecto->estado}}
                </span>
              </td>
              <td class="px-4 py-3 text-sm">
                <span class="inline-block max-w-full truncate px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:bg-gray-700 dark:text-gray-100">
                  {{$proyecto->responsable}}
                </span>
              </td>
              <td class="px-4 py-3">
                <div class="flex items-center space-x-4 text-sm">
                  <a href="{{$proyecto->id}}/edit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                    aria-label="Edit">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                    </svg>
                  </a>
                  <form action="{{$proyecto->id}}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray" aria-label="Delete">
                      <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
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
            {{ $proyectos->links() }}    
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
        style="width: 80%; padding-bottom: 0;"
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
            Crear Proyecto
          </p>
          <!-- Modal description -->
          <form action="save" method="POST" class="max-w-md mx-auto">
            @csrf

            <label class="block mt-2 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Nombre del Proyecto</span>
              <input name="nombre"
                class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Ej: VideoClip-Abracadabra-Lady_Gaga"
              />
            </label>
            <label class="block mt-2 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Descripcion</span>
                <textarea name="descripcion" rows="4" 
                class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-textarea" 
                placeholder="Ej: Se inspiraría en un universo místico, surrealista y oscuro, fusionando elementos de magia negra, circo freak, estética vintage de los años 20-30 y un toque de ciencia ficción."></textarea>
            </label>
            <label class="block mt-2 items-center  text-sm">
              <span class="text-gray-700 dark:text-gray-400">Cliente</span>
              <select name="cliente" id="cargo" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="" selected disabled>Seleccionar</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}" 
                        {{ old('cliente', $proyecto->cliente ?? '') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
              </select>
            </label>

            <div class="flex flex-col sm:flex-row sm:space-x-4 mt-2">
                <div class="w-full sm:w-1/2 pr-2">
                    <label class="block items-center  text-sm" for="fecha_inicio">
                        <span class="text-gray-700 dark:text-gray-400">Fecha Inicio</span>
                    </label>
                    <input type="date" name="fecha_inicio"
                    class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Fecha de Inicio"
                    />
                </div>
                <div class="w-full sm:w-1/2 pl-2">
                    <label class="block items-center  text-sm" for="Fecha-Fin">
                        <span class="text-gray-700 dark:text-gray-400">Fecha Fin</span>
                    </label>
                    <input type="date" name="fecha_fin"
                    class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                    placeholder="Fecha de Inicio"
                    />
                </div>
            </div>

            <label class="block mt-2 mb-2 text-sm">
                <span class="text-gray-700 dark:text-gray-400">Presupuesto</span>
                <input type="number" name="presupuesto"
                class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Expresado en dolares"
                step="0.1" inputmode="decimal"
              />
            </label>
            <label class="block items-center  text-sm">
              <span class="text-gray-700 dark:text-gray-400">Estado del Proyecto</span>
              <select name="estado" id="cargo" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="" selected disabled>Seleccionar</option>
                <option value="En espera" {{ old('estado', $proyecto->estado ?? '') == 'En espera' ? 'selected' : '' }}>En espera</option>
                <option value="En proceso" {{ old('estado', $proyecto->estado ?? '') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="Realizado" {{ old('estado', $proyecto->estado ?? '') == 'Realizado' ? 'selected' : '' }}>Realizado</option>
              </select>
            </label>
            <label class="block mt-2 text-sm">
              <span class="text-gray-700 dark:text-gray-400">Lugar de Ejecucion</span>
              <input name="lugar"
                class="block mt-1 w-full text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                placeholder="Ej: Hollywood, Los Angeles, California, USA" required
              />
            </label>

            <label class="block mt-2 mb-2 items-center  text-sm">
              <span class="text-gray-700 dark:text-gray-400">Responsable</span>
              <select name="responsable" id="cargo" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="" selected disabled>Seleccionar</option>
                @foreach ($personal as $staff)
                    <option value="{{ $staff->id }}" 
                        {{ old('cliente', $proyecto->cliente ?? '') == $staff->id ? 'selected' : '' }}>
                        {{ $staff->nombre }}
                    </option>
                @endforeach
              </select>
            </label>

            <footer style="margin-bottom: -1.8rem;"
              class="flex flex-col items-center justify-end px-6 py-4 pb-0.5 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
            >
              <button type="button"
                @click="closeModal"
                class="w-full px-5 py-4 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
              >
                Cancelar
              </button>
              <button type="submit"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                Guardar
              </button>
            </footer>
          </form>
      </div>
    </div>
        











 
       


    </x-app-layout>






<x-app-layout>

    <h6 class="font-bold text-xl mb-4">Proyectos</h6>
    <div class="mb-4">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Crear
        </button>
    </div>

    <table class="table-fixed bg-white border-gray-300">
        <thead class="bg-gray-200">
            <tr>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Id</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Nombre</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Descripción</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Cliente</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Fecha Inicio</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Fecha Fin</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Presupuesto</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Estado</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Responsable</th>
                <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proyectos as $proyecto)
                <tr>
                    <td class="px-4 py-2">{{ $proyecto->id }}</td>
                    <td class="px-4 py-2">{{ $proyecto->nombre }}</td>
                    <td class="px-4 py-2">{{ $proyecto->descripcion }}</td>
                    <td class="px-4 py-2">{{ $proyecto->cliente }}</td>
                    <td class="px-4 py-2">{{ $proyecto->fecha_inicio }}</td>
                    <td class="px-4 py-2">{{ $proyecto->fecha_fin }}</td>
                    <td class="px-4 py-2">{{ $proyecto->presupuesto }}</td>
                    <td class="px-4 py-2">{{ $proyecto->estado }}</td>
                    <td class="px-4 py-2">{{ $proyecto->responsable }}</td>
                    <td class="mt-4 px-2 py-1">
                        <form action="{{ $proyecto->id }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white font-bold py-2 px-2 rounded hover:bg-red-700"><i class="fa-solid fa-trash"></i></button>
                        </form>
                        <a href="{{ $proyecto->id }}/edit" class="bg-blue-500 text-white font-bold py-2 px-2 rounded hover:bg-blue-700"><i class="fa-solid fa-pencil"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="mt-4">
        {{ $proyectos->links() }}    
    </div>

    <!-- Modal para crear un nuevo proyecto -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Proyecto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="save" method="POST" class="max-w-md mx-auto">
                        @csrf
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre del Proyecto" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <textarea name="descripcion" class="form-control" placeholder="Descripción" required></textarea>
                        </div>
                        
                        <div class="relative z-0 w-full mb-5 group">
                            <select name="cliente" class="form-control" required>
                                <option value="" disabled>Seleccione un cliente</option>
                                @foreach ($clientes as $cliente)
                                    <option value="{{ $cliente->id }}" 
                                        {{ old('cliente', $proyecto->cliente ?? '') == $cliente->id ? 'selected' : '' }}>
                                        {{ $cliente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        
                            <label for="cliente" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Cliente</label>
                        </div>

                        <div class="relative z-0 w-full mb-5 group">
                            <input type="date" name="fecha_inicio" class="form-control" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="date" name="fecha_fin" class="form-control" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="presupuesto" step="0.01" inputmode="decimal" class="form-control" placeholder="Presupuesto" required />
                        </div>
                        
                        <div class="relative z-0 w-full mb-5 group">
                            <select name="estado" class="form-control" required>
                                <option value="" disabled {{ old('estado', $proyecto->estado ?? '') == '' ? 'selected' : '' }}>Seleccione un estado</option>
                                <option value="En espera" {{ old('estado', $proyecto->estado ?? '') == 'En espera' ? 'selected' : '' }}>En espera</option>
                                <option value="En proceso" {{ old('estado', $proyecto->estado ?? '') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                                <option value="Realizado" {{ old('estado', $proyecto->estado ?? '') == 'Realizado' ? 'selected' : '' }}>Realizado</option>
                            </select>
                        </div>

                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="lugar" class="form-control" placeholder="Lugar" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="responsable" class="form-control" placeholder="Responsable" required />
                        </div>
                        <center>
                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>  Registrar</button>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
