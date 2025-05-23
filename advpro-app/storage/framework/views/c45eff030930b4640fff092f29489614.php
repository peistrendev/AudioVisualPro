<?php if (isset($component)) { $__componentOriginal4619374cef299e94fd7263111d0abc69 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4619374cef299e94fd7263111d0abc69 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Back button top-left -->
        <div class="mb-4">
            <a href="/AudioVisualPro/advpro-app/public/clientes/panel" class="m-4 inline-flex items-center px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                Regresar
            </a>
        </div>
    <div class="max-w-lg mx-auto p-6 rounded-lg shadow-md mt-10">
        

        <h2 class="text-2xl font-semibold mb-6 text-gray-800 text-center">Registrar Cliente</h2>
        <form action="form" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1">
                    <label for="nombre" class="block mb-1 font-medium text-gray-700">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo e($clientes->nombre); ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ingrese el nombre" />
                </div>
                <div class="flex-1 mt-4 md:mt-0">
                    <label for="email" class="block mb-1 font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"  value="<?php echo e($clientes->email); ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="example@mail.com" />
                </div>
            </div>
            <div class="flex flex-col md:flex-row md:space-x-4">
                <div class="flex-1">
                    <label for="telefono" class="block mb-1 font-medium text-gray-700">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" value="<?php echo e($clientes->telefono); ?>" pattern="[0-9]{7,15}"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ingrese el teléfono" />
                </div>
                <div class="flex-1 mt-4 md:mt-0">
                    <label for="direccion" class="block mb-1 font-medium text-gray-700">Dirección</label>
                    <input type="text" id="direccion" name="direccion"  value="<?php echo e($clientes->direccion); ?>"
                        class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Ingrese la dirección" />
                </div>
            </div>
            <button type="submit"
                class="w-full bg-blue-700 text-white font-semibold py-2 rounded-md hover:bg-blue-800 transition-colors">
                Registrar
            </button>
        </form>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $attributes = $__attributesOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__attributesOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4619374cef299e94fd7263111d0abc69)): ?>
<?php $component = $__componentOriginal4619374cef299e94fd7263111d0abc69; ?>
<?php unset($__componentOriginal4619374cef299e94fd7263111d0abc69); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\AudioVisualPro\advpro-app\resources\views/clients/edit.blade.php ENDPATH**/ ?>