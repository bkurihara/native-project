

<?php $__env->startSection('content'); ?>
    <div class="container mt-5">
        <nav class="bg-white p-2 shadow-sm" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.blade.php">ダッシュボード</a></li>
                <li class="breadcrumb-item active" aria-current="page">ユーザー登録</li>
            </ol>
        </nav>
        <div class="card shadow-sm">
            <div class="card-title p-2 bg-dark"></div>
            <div class="card-body">
                <h4 class="mb-3">ユーザー登録</h4>
                <form method="POST" action="<?php echo e(base_url('users')); ?>" enctype="multipart/form-data">
                    <div class="row mb-3">
                        <div class="col-md-3 mx-auto">
                            <input class="form-control form-control-sm" id="formFileSm" type="file">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">名前</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control shadow-sm" name="name">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">名前（カナ）</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control shadow-sm" name="name_kana">
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">性別</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="gender" checked>
                                <label class="form-check-label">
                                    男
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="gender" >
                                <label class="form-check-label">
                                    女
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">メールアドレス</label>
                        <div class="col-sm-10">
                            <input name="email" type="email" class="form-control shadow-sm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">郵便番号</label>
                        <div class="col-sm-2">
                            <input name="postal_code1" type="number" class="form-control shadow-sm" placeholder="123">
                        </div>
                        <div class="col-sm-2">
                            <input name="postal_code2" type="number" class="form-control shadow-sm" placeholder="1234">
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-success rounded-pill"><i class="fas fa-search me-2"></i>検索</button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">住所</label>
                        <div class="col-sm-2">
                            <label class="col col-form-label small">都道府県</label>
                            <input type="text" name="address1" class="form-control shadow-sm">
                        </div>
                        <div class="col-sm-2">
                            <label class="col col-form-label small">市区町村</label>
                            <input type="text" name="address2" class="form-control shadow-sm">
                        </div>
                        <div class="col-sm-2">
                            <label class="col col-form-label small">町域</label>
                            <input type="text" name="address3" class="form-control shadow-sm">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">電話番号</label>
                        <div class="col-sm-10">
                            <input name="phone" type="number" class="form-control shadow-sm">
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success rounded-pill"><i class="fas fa-save me-2"></i>保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\native-project\views/users/add.blade.php ENDPATH**/ ?>