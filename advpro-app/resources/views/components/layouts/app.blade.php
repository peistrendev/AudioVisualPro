<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en"> {{-- 'x-data' CORRECTO, sin '.partials.' --}}
  <head>
    {{-- Llamada correcta a los componentes en 'components/layouts/partials/' --}}
    <x-layouts.partials.head /> 
  </head>
  <body>
    <div
      class="flex h-screen bg-gray-50 dark:bg-gray-900"
      :class="{ 'overflow-hidden': isSideMenuOpen }"
    >
      {{-- Llamada correcta a los componentes en 'components/layouts/partials/' --}}
      <x-layouts.partials.desktop-sidebar /> 

      {{-- Llamada correcta a los componentes en 'components/layouts/partials/' --}}
      <x-layouts.partials.mobile-sidebar /> 

      <div class="flex flex-col flex-1 w-full"> {{-- CLASES TAILWIND CORRECTAS: flex-col flex-1 --}}
        {{-- Llamada correcta a los componentes en 'components/layouts/partials/' --}}
        <x-layouts.partials.header /> 

        <main>
            <div class="flex-grow p-6 "> {{-- CLASE TAILWIND CORRECTA: flex-grow --}}
                {{ $slot }} 
            </div>
        </main>
      </div>
    </div>

    {{-- Llamada correcta a los componentes en 'components/layouts/partials/' --}}
    <x-layouts.partials.alerts /> 

  </body>
</html>