<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo e(base_url("public/css/bootstrap/bootstrap.min.css")); ?>" rel="stylesheet">
    <link href="<?php echo e(base_url("public/css/fontawesome/css/all.min.css")); ?>" rel="stylesheet">
    <script src="<?php echo e(base_url("public/js/bootstrap/bootstrap.min.js")); ?>"></script>
    <script src="<?php echo e(base_url("public/js/jquery-3.6.0.min.js")); ?>"></script>

    <style>
        #particles-js {
            position: absolute;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            background-size: cover;
            overflow-y: hidden;
        }
    </style>
</head>

<body id="particles-js" class="position-relative min-vh-100 bg-dark" style="height: 100vh;">
<div class="position-absolute top-50 start-50 translate-middle w-25">
    <div class="card shadow-lg rounded-3 bg-light">
        <div class="card-body p-0">
            <h5 class="card-title bg-dark p-2"></h5>
            <form method="POST" action="<?php echo e(base_url('login')); ?>" class="form-signin p-4">
                <?php echo csrf_field(); ?>
                <p class="text-center mb-0 display-2">
                    <i class="fas fa-user-shield"></i>
                </p>
                <h4 class="mt-3 font-weight-normal text-center">ようこそ</h4>
                <p class="small text-center">ログインしてください</p>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><i class="far fa-envelope me-2"></i>メールアドレス</label>
                    <input name="email" type="email" class="form-control shadow-sm" placeholder="メールアドレス">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><i class="fas fa-key me-2"></i>パスワード</label>
                    <input name="password" type="password" class="form-control shadow-sm" placeholder="******">
                </div>
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <?php echo e($error); ?>

                    </div>
                <?php endif; ?>
                <div class="text-center mt-4">
                    <button class="btn btn-dark mx-auto rounded-pill shadow-sm" type="submit"><i class="fas fa-sign-in-alt me-2"></i>ログイン</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo e(base_url("public/js/particles.min.js")); ?>"></script>
<script src="<?php echo e(base_url("public/js/app.js")); ?>"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\native-project\views/login.blade.php ENDPATH**/ ?>