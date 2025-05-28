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
                <th class="text-center py-2 text-left">Id</th>
                <th class="text-center py-2 text-left">Nombre</th>
                <th class="text-center py-2 text-left">Descripción</th>
                <th class="text-center py-2 text-left">Cliente</th>
                <th class="text-center py-2 text-left">Fecha Inicio</th>
                <th class="text-center py-2 text-left">Fecha Fin</th>
                <th class="text-center py-2 text-left">Presupuesto</th>
                <th class="text-center py-2 text-left">Estado</th>
                <th class="text-center py-2 text-left">Responsable</th>
                <th class="text-center py-2 text-left">Opciones</th>
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
                            <input type="text" name="cliente" class="form-control" placeholder="Cliente" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="date" name="fecha_inicio" class="form-control" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="date" name="fecha_fin" class="form-control" />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="number" name="presupuesto" class="form-control" placeholder="Presupuesto" required />
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="text" name="estado" class="form-control" placeholder="Estado" required />
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
