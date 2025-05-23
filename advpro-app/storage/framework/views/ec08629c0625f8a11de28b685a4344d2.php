<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Clientes</title>
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
                        <img src="src/home.svg" alt="">
                    </div>
                    <span class="self-center">Inicio</span>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="../src/user.svg" alt="">
                    </div>
                    <span class="self-center">Personal</span>
                </li>
                <li class="flex mb-8">
                    <div class="bg-blue-600 shadow-sm p-2 mr-3 rounded-lg">
                        <img src="src/users.svg" alt="">
                    </div>
                    <span class="self-center text-blue-600">Clientes</span>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="src/clipboard-document-check.svg" alt="">
                    </div>
                    <span class="self-center">Contratos</span>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="src/archive-box.svg" alt="">
                    </div>
                    <span class="self-center">Inventario</span>
                </li>
            </ul>
            <h6 class="font-bold mb-4">Contable</h6>
            <ul>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="src/book-open.svg" alt="">
                    </div>
                    <span class="self-center">Libro Diario</span>
                </li>
                <li class="flex mb-8">
                    <div class="bg-white shadow-sm p-2 mr-3 rounded-lg">
                        <img src="src/bookmark-square.svg" alt="">
                    </div>
                    <span class="self-center">Libro Mayor</span>
                </li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="flex-grow p-6 ">
            <h6 class="font-bold text-xl mb-4 ">Clientes</h6>

        <table class="table-fixed bg-white border border-gray-300 ">
        <thead>
            <tr>
            <th class="border border-gray-300 px-4 py-2 text-left">Id</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Telefono</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Direccion</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Contrato</th>
            </tr>
        </thead>
        <tbody >
            <tr>
            <td class="border border-gray-300 px-4 py-2">1</td>
            <td class="border border-gray-300 px-4 py-2">Malcolm Lockyer</td>
            <td class="border border-gray-300 px-4 py-2">mlockyer@gmail.com</td>
            <td class="border border-gray-300 px-4 py-2">58414123456</td>
            <td class="border border-gray-300 px-4 py-2">Bqto</td>
            <td class="border border-gray-300 px-4 py-2">101</td>
            </tr>
            <tr>
             <td class="border border-gray-300 px-4 py-2">2</td>
            <td class="border border-gray-300 px-4 py-2">Monkis C.A.</td>
            <td class="border border-gray-300 px-4 py-2">monkis@gmail.com</td>
            <td class="border border-gray-300 px-4 py-2">58414003456</td>
            <td class="border border-gray-300 px-4 py-2">Bqto</td>
            <td class="border border-gray-300 px-4 py-2">102</td>
            </tr>
            <tr>
             <td class="border border-gray-300 px-4 py-2">3</td>
            <td class="border border-gray-300 px-4 py-2">Raycreates</td>
            <td class="border border-gray-300 px-4 py-2">ray@gmail.com</td>
            <td class="border border-gray-300 px-4 py-2">5841410000</td>
            <td class="border border-gray-300 px-4 py-2">Bqto</td>
            <td class="border border-gray-300 px-4 py-2">103</td>
            </tr>
        </tbody>
        </table>

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
<?php /**PATH C:\xampp\htdocs\AudioVisualPro\advpro-app\resources\views/client.blade.php ENDPATH**/ ?>