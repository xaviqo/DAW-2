<h1> <?php echo e($mode); ?> book </h1>
<label for="name">Name</label>
<input type="text" value="<?php echo e(isset($book->name)?$book->name:''); ?>" name="name" id="name">
<br>
<label for="author">Author</label>
<input type="text" value="<?php echo e(isset($book->name)?$book->author:''); ?>" name="author" id="author">
<br>
<label for="price">Price</label>
<input type="number" value="<?php echo e(isset($book->name)?$book->price:''); ?>" name="price" id="price">
<br>
<label for="category">Category</label>
<input type="number" value="<?php echo e(isset($book->name)?$book->category:''); ?>" name="category" id="category">
<br>
<?php if(isset($book->image)): ?>
<?php echo e($book->image); ?>

<br>
<?php endif; ?>
<label for="image">Image</label>
<input type="file"  name="image" id="image">
<br>
<input type="submit" value="<?php echo e($mode); ?>" id="send">

<a href="<?php echo e(url('book')); ?>">Return</a>
<?php /**PATH /home/xavi/Desktop/TRABAJOS/DAW-2/PHP/COMPOSER/daw2crud/resources/views/book/form.blade.php ENDPATH**/ ?>