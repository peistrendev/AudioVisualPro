<x-app-layout>
       

            <h6 class="font-bold text-xl mb-4 ">Clientes</h6>
            <div class="mb-4">
             <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Crear
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
                  <button type="submit" class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition-colors duration-200">
                    <img src="{{asset('src/trash.svg')}}" alt="Eliminar" class="w-4 h-4">
                  </button>
                </form>
                
                <!-- Botón Editar -->
                <a href="{{$client->id}}/edit" class="p-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition-colors duration-200">
                  <img src="{{asset('src/pencil-square.svg')}}" alt="Editar" class="w-4 h-4">
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

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Cliente</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="save" method="POST" class="max-w-md mx-auto">
            @csrf
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" name="nombre" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " />
      <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre y Apellido</label>
  </div>
   <div class="grid md:grid-cols-2 md:gap-6">
   <div class="relative z-0 w-full mb-5 group">
    <select name="tipo_documento" id="tipo_documento" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" required>
        <option value="">Seleccione una opción</option>
        <option value="J">J</option>
        <option value="V">V</option>
        <option value="E">E</option>
    </select>
    <label for="tipo_documento" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Tipo Documento</label>
</div>
    <div class="relative z-0 w-full mb-5 group">
        <input type="text" name="documento" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
        <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Documento</label>
    </div>
  </div>
  <div class="relative z-0 w-full mb-5 group">
      <input type="email" name="email" id="floating_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
      <label for="floating_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
  </div>
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" name="telefono" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
      <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Telefono</label>
  </div>
  <div class="relative z-0 w-full mb-5 group">
      <input type="text" name="direccion" id="floating_repeat_password" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
      <label for="floating_repeat_password" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Direccion</label>
  </div>
  
   
  <center><button type="submit" class="text-white bg-green-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Registrar</button></center>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
       


    </x-app-layout>