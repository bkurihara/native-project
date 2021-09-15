

<?php $__env->startSection('content'); ?>
    <div class="container mt-3">
        <nav class="bg-white p-2 shadow-sm"
             style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
             aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../dashboard.blade.php">ダッシュボード</a></li>
                <li class="breadcrumb-item active" aria-current="page">ユーザー情報変更</li>
            </ol>
        </nav>
        <div class="card shadow-sm">
            <div class="card-title p-2 bg-dark"></div>
            <div class="card-body">
                <h4 class="mb-3">ユーザー情報変更</h4>
                <form method="POST" action="<?php echo e(base_url('user/').$user->id.'/update'); ?>" enctype="multipart/form-data">
                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                    <div class="row mb-3">
                        <div class="col-md-3 mx-auto">
                            <input class="form-control form-control-sm" id="formFileSm" type="file">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">名前</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   value="<?php echo e($old_data['name'] ?? $user->name); ?>"
                                   class="form-control <?php echo e(isset($errors['name']) ? 'is-invalid' : ''); ?> shadow-sm"
                                   name="name">

                            <?php if(isset($errors['name'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['name']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">名前（カナ）</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   value="<?php echo e($old_data['name_kana'] ?? $user->name_kana); ?>"
                                   class="form-control <?php echo e(isset($errors['name_kana']) ? 'is-invalid' : ''); ?> shadow-sm"
                                   name="name_kana">
                            <?php if(isset($errors['name_kana'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['name_kana']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-2 pt-0">性別</legend>
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       value="1"
                                       name="gender"
                                        <?php echo e($user->gender == 1 ? 'checked' : ''); ?>>
                                <label class="form-check-label">男</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="radio"
                                       value="0"
                                       name="gender"
                                        <?php echo e($user->gender == 0 ? 'checked' : ''); ?>>
                                <label class="form-check-label">女</label>
                            </div>
                            <?php if(isset($errors['gender'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['gender']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </fieldset>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">メールアドレス</label>
                        <div class="col-sm-10">
                            <input name="email"
                                   type="email"
                                   value="<?php echo e($old_data['email'] ?? $user->email); ?>"
                                   class="form-control <?php echo e(isset($errors['email']) ? 'is-invalid' : ''); ?> shadow-sm">
                            <?php if(isset($errors['email'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['email']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">パスワード</label>
                        <div class="col-sm-10">
                            <input name="password"
                                   type="password"
                                   class="form-control <?php echo e(isset($errors['password']) ? 'is-invalid' : ''); ?> shadow-sm">
                            <?php if(isset($errors['password'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['password']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">パスワード再入力</label>
                        <div class="col-sm-10">
                            <input name="password_confirmation"
                                   type="password"
                                   class="form-control <?php echo e(isset($errors['password_confirmation']) ? 'is-invalid' : ''); ?> shadow-sm">
                            <?php if(isset($errors['password_confirmation'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['password_confirmation']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">郵便番号</label>
                        <div class="col-sm-2">
                            <input name="postal_code1"
                                   type="number"
                                   id="postal_code1"
                                   value="<?php echo e($old_data['postal_code1'] ?? $user->postal_code1); ?>"
                                   class="form-control <?php echo e(isset($errors['postal_code1']) ? 'is-invalid' : ''); ?> shadow-sm"
                                   placeholder="123">
                            <?php if(isset($errors['postal_code1'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['postal_code1']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-2">
                            <input name="postal_code2"
                                   type="number"
                                   id="postal_code2"
                                   class="form-control <?php echo e(isset($errors['postal_code2']) ? 'is-invalid' : ''); ?> shadow-sm"
                                   value="<?php echo e($old_data['postal_code2'] ?? $user->postal_code2); ?>"
                                   placeholder="1234">
                            <?php if(isset($errors['postal_code2'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['postal_code2']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-2">
                            <button type="button"
                                    class="btn btn-success rounded-pill"
                                    onclick="searchPostalcode()">
                                <i class="fas fa-search me-2"></i>検索
                            </button>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">住所</label>
                        <div class="col-sm-2">
                            <label class="col col-form-label small">都道府県</label>
                            <input type="text"
                                   name="address1"
                                   id="address1"
                                   value="<?php echo e($old_data['address1'] ?? $user->address1); ?>"
                                   class="form-control <?php echo e(isset($errors['address1']) ? 'is-invalid' : ''); ?> shadow-sm">
                            <?php if(isset($errors['address1'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['address1']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-2">
                            <label class="col col-form-label small">市区町村</label>
                            <input type="text"
                                   name="address2"
                                   id="address2"
                                   value="<?php echo e($old_data['address2'] ?? $user->address2); ?>"
                                   class="form-control <?php echo e(isset($errors['address2']) ? 'is-invalid' : ''); ?> shadow-sm">
                            <?php if(isset($errors['address2'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['address2']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-2">
                            <label class="col col-form-label small">町域</label>
                            <input type="text"
                                   name="address3"
                                   id="address3"
                                   value="<?php echo e($old_data['address3'] ?? $user->address3); ?>"
                                   class="form-control <?php echo e(isset($errors['address3']) ? 'is-invalid' : ''); ?> shadow-sm">
                            <?php if(isset($errors['address3'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['address3']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">電話番号</label>
                        <div class="col-sm-10">
                            <input name="phone"
                                   type="number"
                                   value="<?php echo e($old_data['phone'] ?? $user->phone); ?>"
                                   class="form-control <?php echo e(isset($errors['phone']) ? 'is-invalid' : ''); ?> shadow-sm">
                            <?php if(isset($errors['phone'])): ?>
                                <div class="invalid-feedback">
                                    <?php echo e($errors['phone']); ?>

                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success rounded-pill"><i class="fas fa-save me-2"></i>保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        function searchPostalcode() {
            var postalCode = $("#postal_code1").val() + $("#postal_code2").val()
            $.ajax({
                url: "https://zipcloud.ibsnet.co.jp/api/search?zipcode=" + postalCode,
                type: 'GET',
                dataType: "jsonp",
                success: function (data) {
                    if (data.results == null)
                        alert("データが見つかりません")
                    else {
                        $("#address1").val(data.results[0].address1)
                        $("#address2").val(data.results[0].address2)
                        $("#address3").val(data.results[0].address3)
                    }
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\native-project\views/users/edit.blade.php ENDPATH**/ ?>