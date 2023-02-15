<?php if(Session::has('message')): ?>
<?php echo e(Session::get('message')); ?>

<?php endif; ?>

<a href="<?php echo e(url('book/create')); ?>">Add new book</a>

<table>
    <thead>
        <tr>
            <th>
                #
            </th>
            <th>
                Name
            </th>
            <th>
                Author
            </th>
            <th>
                Price
            </th>
            <th>
                Category
            </th>
            <th>
                Image
            </th>
        </tr>
    </thead>
    <tbody>
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <?php echo e($book->id); ?>

                </td>
                <td>
                    <?php echo e($book->name); ?>

                </td>
                <td>
                    <?php echo e($book->author); ?>

                </td>
                <td>
                    <?php echo e($book->price); ?>

                </td>
                <td>
                    <?php echo e($book->category); ?>

                </td>
                <td>
                    <img src="<?php echo e(asset('storage').'/'.$book->image); ?>" alt="" width="100px" height="100px">
                </td>
                <td>
                    <a href="<?php echo e(url('/book/'.$book->id.'/edit')); ?>">
                        Edit
                    </a>
                     |
                    <form action="<?php echo e(url('/book/'.$book->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <?php echo e(method_field('DELETE')); ?>

                        <input type="submit" onclick="return confirm('Do you want to delete this book?')" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/xavi/Desktop/TRABAJOS/DAW-2/PHP/COMPOSER/daw2crud/resources/views/book/index.blade.php ENDPATH**/ ?>