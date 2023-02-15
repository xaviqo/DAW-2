<form action="<?php echo e(url('/book/'.$book->id)); ?>" method="post" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo e(method_field('PATCH')); ?>

    <?php echo $__env->make('book.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
</form>
<?php /**PATH /home/xavi/Desktop/TRABAJOS/DAW-2/PHP/COMPOSER/daw2crud/resources/views/book/edit.blade.php ENDPATH**/ ?>