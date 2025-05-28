<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- TAILWIND -->
    <script src="https://cdn.tailwindcss.com"></script>
      <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    
    <title>ADVPRO</title>
   </head>
<body class="bg-gray-100">
    <div class="bg-white flex p-6 shadow-sm">
        <h6 class="flex-grow text-2xl font-bold">AudioVisual Pro</h6>
        <button id="toggleSidebar" class="bg-blue-500 text-white p-2 rounded-lg mt-2 md:hidden"><img src="src/list-bullet.svg" alt=""></button>
    </div>

    <div class="flex h-screen">
        <div id="sidebar" class="sidebar border-r p-6 w-64 border-gray-300 hidden md:block bg-gray-200">
            <h6 class="font-bold mb-4">Empresa</h6>
            <ul>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{ asset('src/home.svg') }}" alt="">
                    </div>
                    <a href="" class="self-center hover:text-blue-600 ">Inicio</a>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{asset('src/user.svg')}}" alt="">
                    </div>
                    <a href="" class="self-center hover:text-blue-600 ">Personal</a>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{asset('src/users.svg')}}" alt="">
                    </div>
                   <a href="{{ url('clientes/panel') }}" class="self-center {{ Request::is('clientes/panel') ? 'text-blue-600' : 'hover:text-blue-600' }}">
                        Clientes
                    </a>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{asset('src/clipboard-document-check.svg')}}" alt="">
                    </div>
                     <a href="{{ url('contratos/panel') }}" class="self-center {{ Request::is('contratos/panel') ? 'text-blue-600' : 'hover:text-blue-600' }}">
                        Contratos
                    </a>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{asset('src/archive-box.svg')}}" alt="">
                    </div>
                    <a href="" class="self-center hover:text-blue-600 ">Inventario</a>
                </li>
            </ul>
            <h6 class="font-bold mb-4">Contable</h6>
            <ul>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{asset('src/book-open.svg')}}" alt="">
                    </div>
                    <a href="" class="self-center hover:text-blue-600 ">Libro Diario</a>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{asset('src/bookmark-square.svg')}}" alt="">
                    </div>
                    <a href="" class="self-center hover:text-blue-600 ">Libro Mayor</a>
                </li>
            </ul>
        </div>
         <!-- Contenido principal -->
        <div class="flex-grow p-6 ">
            
         {{$slot}}

        </div>
        
    <script>
        // JavaScript para mostrar/ocultar el sidebar
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>

