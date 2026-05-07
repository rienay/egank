<!DOCTYPE html>
<html lang="en">



<?php echo $__env->make('admin.layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php echo $__env->make('admin.layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
  <?php echo $__env->make('admin.layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

  <div class="content-wrapper">
    <?php echo $__env->yieldContent('content'); ?>
  </div>

  <?php echo $__env->make('admin.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</div>

</body>
</html><?php /**PATH C:\laragon\www\gank\egank\resources\views/admin/layouts/main.blade.php ENDPATH**/ ?>