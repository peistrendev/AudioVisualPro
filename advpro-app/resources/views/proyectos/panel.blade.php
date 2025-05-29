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
                            <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded hover:bg-red-700">X</button>
                        </form>
                        <a href="{{ $proyecto->id }}/edit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-700">Edit</a>
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
                            <button type="submit" class="btn btn-success">Registrar</button>
                        </center>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
