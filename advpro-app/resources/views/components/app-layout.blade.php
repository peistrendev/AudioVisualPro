<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Windmill Dashboard</title>
    <script src="{{asset('js/init-alpine.js')}}"></script>
    @vite(['resources/js/app.js'])
    <script src="{{asset('js/charts-lines.js')}}" defer></script>
    <script src="{{asset('js/charts-pie.js')}}" defer></script>
     {{-- <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    @vite(['resources/css/styles.css']) --}}
    <!-- TAILWIND -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
      <!-- BOOTSTRAP -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script> --}}

    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    
    @vite(['resources/css/tailwind.output.css'])
    <script
      src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
      defer
    ></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css"
    />
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
      defer
    ></script>
    <script src="{{asset('js/charts-lines.js')}}" defer></script>
    <script src="{{asset('js/charts-pie.js')}}" defer></script>
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      <!-- Desktop sidebar -->
      <aside
        class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0"
      >
        <div class="py-4 text-gray-500 dark:text-gray-400">
          <a
            class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
            href="#"
          >
            AudioVisual Pro
          </a>
          <ul class="mt-6">
          <ul>
              <!-- Dashboard -->
              <li class="relative px-6 py-3">
                @if(request()->is('inicio/dashboard*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('inicio/dashboard*') ? 'text-gray-800 dark:text-gray-100' : '' }}" href="{{ url('inicio/dashboard') }}">
                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                  </svg>
                  <span class="ml-4">Dashboard</span>
                </a>
              </li>

              <!-- Personal -->
              <li class="relative px-6 py-3">
                @if(request()->is('personal/panel*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('personal/panel*') ? 'text-gray-800 dark:text-gray-100' : '' }}" href="{{ url('personal/panel') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"></path>
                  </svg>
                  <span class="ml-4">Personal</span>
                </a>
              </li>


              <!-- Clientes -->
              <li class="relative px-6 py-3">
                @if(request()->is('clientes/panel*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('clientes/panel*') ? 'text-gray-800 dark:text-gray-100' : '' }}" href="{{ url('clientes/panel') }}">
                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"></path>
                  </svg>
                  <span class="ml-4">Clientes</span>
                </a>
              </li>


              <!-- Contratos -->
              <li class="relative px-6 py-3">
                @if(request()->is('contratos/panel*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('contratos/panel*') ? 'text-gray-800 dark:text-gray-100' : '' }}" href="{{ url('contratos/panel') }}">
                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                  </svg>
                  <span class="ml-4">Contratos</span>
                </a>
              </li>

              <!-- Proyectos -->
              <li class="relative px-6 py-3">
                @if(request()->is('proyectos/panel*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('proyectos/panel*') ? 'text-gray-800 dark:text-gray-100' : '' }}" href="{{ url('proyectos/panel') }}">
                  <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                  <span class="ml-4">Proyectos</span>
                </a>
              </li>

              <li class="relative px-6 py-3">
                @if(request()->is('equipos/panel*'))
                <span class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg" aria-hidden="true"></span>
                @endif
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 {{ request()->is('equipos/panel*') ? 'text-gray-800 dark:text-gray-100' : '' }}" href="{{ url('equipos/panel') }}">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                  <path d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                </svg>
                <span class="ml-4">Equipos</span>
                </a>
              </li>


            <li class="relative px-6 py-3">
              <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                href="{{ url('equipos/panel') }}"
              >
                <svg
                  class="w-5 h-5"
                  aria-hidden="true"
                  fill="none"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                <span class="ml-4">Tables</span>
              </a>
            </li>
            <li class="relative px-6 py-3">
              <button
                class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                @click="togglePagesMenu"
                aria-haspopup="true"
              >
                <span class="inline-flex items-center">
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                    ></path>
                  </svg>
                  <span class="ml-4">Pages</span>
                </span>
                <svg
                  class="w-4 h-4"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
              <template x-if="isPagesMenuOpen">
                <ul
                  x-transition:enter="transition-all ease-in-out duration-300"
                  x-transition:enter-start="opacity-25 max-h-0"
                  x-transition:enter-end="opacity-100 max-h-xl"
                  x-transition:leave="transition-all ease-in-out duration-300"
                  x-transition:leave-start="opacity-100 max-h-xl"
                  x-transition:leave-end="opacity-0 max-h-0"
                  class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                  aria-label="submenu"
                >
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/login.html">Login</a>
                  </li>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/create-account.html">
                      Create account
                    </a>
                  </li>
                  <li
                    class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                  >
                    <a class="w-full" href="pages/forgot-password.html">
                      Forgot password
                    </a>
                </li>
                 <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="{{asset('src/bookmark-square.svg')}}" alt="">
                    </div>
                     <a href="{{ url('proyectos/panel') }}" class="self-center {{ Request::is('contratos/panel') ? 'text-blue-600' : 'hover:text-blue-600' }}">
                        Proyectos
                    </a>
                </li>
            </ul>
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
        </header>
        <main>
            <div class="flex-grow p-6 ">
                
                {{$slot}}

            </div>
        </main>

      </div>
    </div>
      @if(session('alert') || session('swal') || session('success') || session('error') || $errors->any())
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              // Manejo de session('alert')
              @if(session('alert'))
                  const alert = @json(session('alert'));
                  Swal.fire({
                      icon: alert.type || 'info',
                      title: alert.title || 'Mensaje',
                      text: alert.message || '',
                      confirmButtonText: alert.button || 'Aceptar',
                      confirmButtonColor: '#6C2BD9',
                      timer: alert.timer || null,
                      showConfirmButton: (alert.showConfirmButton !== false)
                  });
              @endif

              // Manejo de session('swal')
              @if(session('swal'))
                  Swal.fire(@json(session('swal')));
              @endif

              // Manejo de session('success')
              @if(session('success'))
                  Swal.fire({
                      icon: 'success',
                      title: '{{ session('success') }}',
                      timer: 3000,
                      showConfirmButton: false,
                      toast: true,
                      position: 'top-end'
                  });
              @endif

              // Manejo de session('error')
              @if(session('error'))
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: '{{ session('error') }}',
                      confirmButtonText: 'Aceptar',
                      confirmButtonColor: '#d33'
                  });
              @endif

              // Manejo de errores de validación
              @if($errors->any())
                  Swal.fire({
                      icon: 'error',
                      title: 'Errores de validación',
                      html: `{!! implode('<br>', $errors->all()) !!}`,
                      confirmButtonText: 'Entendido',
                      confirmButtonColor: '#d33'
                  });
              @endif
          });
      </script>
      @endif
  </body>
</html>
