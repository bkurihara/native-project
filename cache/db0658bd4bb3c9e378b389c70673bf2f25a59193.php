<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <link href="<?php echo e(base_url("public/css/my-theme.css")); ?>" rel="stylesheet">
    <link href="<?php echo e(base_url("public/css/fontawesome/css/all.min.css")); ?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="<?php echo e(base_url("public/js/bootstrap/bootstrap.bundle.min.js")); ?>"></script>
    <script src="<?php echo e(base_url("public/js/jquery-3.6.0.min.js")); ?>"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.2/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="bg-light">
<?php echo $__env->make('components.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\native-project\views/layouts/app.blade.php ENDPATH**/ ?>