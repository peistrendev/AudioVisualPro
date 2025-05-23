
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
        <!-- Contenido principal -->
        <div class="flex-grow p-6 ">
            <h6 class="font-bold text-xl mb-4 ">Clientes</h6>
         
            <div class="grid grid-cols-7 mb-2">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
             <div></div>
            <div class="flex justify-center">
                <a href="create" class="bg-blue-700 text-white px-4 py-2 rounded-lg text-sm mb-4 me-8">Nuevo</a>
            </div>
        </div>
        
           <div class="overflow-x-auto">
        <table class="table-fixed bg-white border border-gray-300 ">
        <thead>
            <tr>
            <th class="border border-gray-300 px-4 py-2 text-left">Id</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Telefono</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Direccion</th>
            <th class="border border-gray-300 px-4 py-2 text-left">Contrato</th>
             <th class="border border-gray-300 px-4 py-2 text-left">Opc</th>
            </tr>
        </thead>
        <tbody >
            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
            <td class="border border-gray-300 px-4 py-2"><?php echo e($client->id); ?></td>
            <td class="border border-gray-300 px-4 py-2"><?php echo e($client->nombre); ?></td>
            <td class="border border-gray-300 px-4 py-2"><?php echo e($client->email); ?></td>
            <td class="border border-gray-300 px-4 py-2"><?php echo e($client->telefono); ?></td>
            <td class="border border-gray-300 px-4 py-2"><?php echo e($client->direccion); ?></td>
            <td class="border border-gray-300 px-4 py-2">101</td>
            <td class="border border-gray-300 px-4 py-2">
                <a href="<?php echo e($client->id); ?>/edit" class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm m-3">Editar</a>
                <a href="" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm m-3">Eliminar</a>
            </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           
        </tbody>
        </table>
        </div>

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
<?php endif; ?>

   
<?php /**PATH C:\xampp\htdocs\AudioVisualPro\advpro-app\resources\views/clients/client.blade.php ENDPATH**/ ?>