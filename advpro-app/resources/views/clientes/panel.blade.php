<x-app-layout>
       
            <h2 class="mb-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            Clientes</h2>
            <div class="mb-4">
              <button
                @click="openModal"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Crear Cliente
              </button>
            </div>

        <table class="min-w-full bg-white border border-gray-300">
        <thead class="bg-gray-200 ">
            <tr>
            <th class="d-none"></th>
            <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Nombre</th>
            <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Documento</th>
            <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Email</th>
            <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Telefono</th>
            <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Direccion</th>
            <th class="py-2 px-3 text-left border-b border-gray-300 whitespace-nowrap">Opciones</th>
            
            
            </tr>
        </thead>
        <tbody >
            @foreach ($clientes as $client)
                
            
            <tr>
            <td class=" d-none px-4 py-2">{{$client->id}}</td>
            <td class=" px-4 py-2">{{$client->nombre}}</td>
            <td class=" px-4 py-2">{{$client->tipo_documento}}-{{$client->documento}}</td>
            <td class=" px-4 py-2">{{$client->email}}</td>
            <td class=" px-4 py-2">{{$client->telefono}}</td>
            <td class=" px-4 py-2">{{$client->direccion}}</td>
          
            <td class="px-2 py-2 whitespace-nowrap">
              <div class="flex items-center justify-start space-x-2">
                <!-- Botón Eliminar -->
                <form action="{{$client->id}}" method="POST" class="inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="p-2 bg-[#7C59F7] hover:bg-[#9E89FB] text-white rounded-full transition-colors duration-200">
                    <img src="{{asset('src/trash.svg')}}" class="" alt="Eliminar" class="w-4 h-4">
                  </button>
                </form>
                
                <!-- Botón Editar -->
                <a href="{{$client->id}}/edit" class="p-2 bg-[#7C59F7] hover:bg-[#9E89FB] text-white rounded-full transition-colors duration-200">
                  <img src="{{asset('src/pencil-square.svg')}}" class="" alt="Editar" class="w-4 h-4">
                </a>
              </div>
            </td>
            </tr>
            @endforeach
           
              
        </tbody>
        </table>
        <div class="mt-4">
            {{ $clientes->links() }}    
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
            Crear Cliente
          </p>
          <!-- Modal description -->
          <form action="save" method="POST" class="max-w-md mx-auto">
            @csrf

            <div class="mt-2  text-sm">
              <span class="text-gray-700 dark:text-gray-400">
                Documento de indentidad
              </span>
              <div>
                <label class="inline-flex items-center  text-sm">
                    <select name="tipo_documento" id="tipo_documento" class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                      <option value="" selected disabled>-</option>
                      <option value="1">V</option>
                      <option value="2">J</option>
                      <option value="3">E</option>
                      <option value="4">G</option>
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
            <footer
              class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800"
            >
              <button
                @click="closeModal"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray"
              >
                Cancel
              </button>
              <button type="submit"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              >
                Accept
              </button>
            </footer>
        </form>
      </div>
    </div>
        











 
       


    </x-app-layout>