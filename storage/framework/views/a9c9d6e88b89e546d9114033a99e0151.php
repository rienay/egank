<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magang Industri</title>

    <!-- ✅ WAJIB ADA (INI KUNCI MASALAHMU) -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-50 font-[Poppins]">

    <!-- Navbar -->
    <?php echo $__env->make('layouts/navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>



    <!-- Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

        <?php echo $__env->make('layouts/footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

</body>
</html><?php /**PATH C:\laragon\www\gank\egank\resources\views/layouts/main.blade.php ENDPATH**/ ?>