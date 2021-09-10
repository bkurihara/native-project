<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">管理システム</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo e(base_url('dashboard')); ?>"><i
                                class="far fa-chart-bar me-2"></i>ダッシュボード</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?php echo e(base_url('users')); ?>"><i
                                class="fas fa-user-plus me-2"></i>ユーザー登録</a>
                </li>
            </ul>
            <form class="d-flex">
                <div class="nav-item dropdown d-inline">
                    <a class="nav-link dropdown-toggle text-white active" href="#" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-2"></i>ユーザー
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo e(base_url()); ?>"><i class="fas fa-sign-out-alt me-2"></i>ログアウト</a></li>
                    </ul>
                </div>
            </form>
        </div>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\native-project\views/components/navbar.blade.php ENDPATH**/ ?>