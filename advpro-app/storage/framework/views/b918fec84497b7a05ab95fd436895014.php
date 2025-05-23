<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Clientes</title>
   </head>
<body class="bg-gray-100">
    <div class="bg-gray-100 flex p-6 shadow-sm w-full">
        <button id="toggleSidebar" class="bg-blue-500 me-4 text-white p-2 rounded-lg mt-2 md:hidden"><img src="src/list-bullet.svg" alt=""></button>
        <h6 class="flex-grow text-2xl font-bold">AudioVisual Pro</h6>
        
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

        <?php echo e($slot); ?>

         <script>
        // JavaScript para mostrar/ocultar el sidebar
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');

        toggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\AudioVisualPro\advpro-app\resources\views/components/app-layout.blade.php ENDPATH**/ ?>