

<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-title p-2 bg-dark text-white">
                <p class="h6 ps-2 mb-0"><i class="fas fa-user-plus me-2"></i>ユーザー登録</p>
            </div>
            <div class="card-body mx-3">
                <form method="POST" action="<?php echo e(base_url('user')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col mb-3">
                            <div class="col-md-3 mx-auto text-center">
                                <img id="preview" class="rounded img-thumbnail rounded-circle img-fluid" width="180"
                                     alt="profile picture" src="<?php echo e(base_url('public/images/placeholder.png')); ?>">
                                <input onchange="readURL(this)"
                                       class="form-control form-control-sm <?php echo e(isset($errors['photo']) ? 'is-invalid' : ''); ?>"
                                       name="photo" type="file">
                                <small id="passwordHelpBlock" class="form-text text-muted">
                                    Please upload only file that contains jpg, jpeg, png, gif extensions
                                </small>
                                <?php if(isset($errors['photo'])): ?>
                                    <div class="invalid-feedback">
                                        <?php echo e($errors['photo']); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row border border-1 border-dark p-3">
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-danger me-2">必須</span>名前
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           value="<?php echo e($old_data['name'] ?? ''); ?>"
                                           class="form-control <?php echo e(isset($errors['name']) ? 'is-invalid' : ''); ?> shadow-sm"
                                           name="name"
                                           placeholder="名前"
                                           required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Only kanjis and kanas are allowed on this field
                                    </small>
                                    <?php if(isset($errors['name'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['name']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-danger me-2">必須</span>名前（カナ）
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           value="<?php echo e($old_data['name_kana'] ?? ''); ?>"
                                           class="form-control <?php echo e(isset($errors['name_kana']) ? 'is-invalid' : ''); ?> shadow-sm"
                                           name="name_kana"
                                           placeholder="なまえ"
                                           required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Only kana is allowed on this field
                                    </small>
                                    <?php if(isset($errors['name_kana'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['name_kana']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <label class="col-form-label col-sm-4 pt-0">
                                    <span class="badge bg-danger me-2">必須</span>性別</label>
                                <div class="col-sm-8">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               value="1"
                                               name="gender" checked>
                                        <label class="form-check-label">男性</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   value="2"
                                                   name="gender">
                                            <label class="form-check-label">女性</label>
                                        </div>
                                        <?php if(isset($errors['gender'])): ?>
                                            <div class="invalid-feedback">
                                                <?php echo e($errors['gender']); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-danger me-2">必須</span>メールアドレス</label>
                                <div class="col-sm-8">
                                    <input name="email"
                                           type="email"
                                           value="<?php echo e($old_data['email'] ?? ''); ?>"
                                           class="form-control <?php echo e(isset($errors['email']) ? 'is-invalid' : ''); ?> shadow-sm"
                                           placeholder="example@gmail.com"
                                           required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Must be a valid email address
                                    </small>
                                    <?php if(isset($errors['email'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['email']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-dark me-2">任意</span>電話番号</label>
                                <div class="col-sm-8">
                                    <input name="phone"
                                           type="text"
                                           value="<?php echo e($old_data['phone'] ?? ''); ?>"
                                           placeholder="080xxxxxxx"
                                           class="form-control <?php echo e(isset($errors['phone']) ? 'is-invalid' : ''); ?> shadow-sm">
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        This field only allows numbers
                                    </small>
                                    <?php if(isset($errors['phone'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['phone']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-danger me-2">必須</span>パスワード</label>
                                <div class="col-sm-8">
                                    <input name="password"
                                           type="password"
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                           class="form-control <?php echo e(isset($errors['password']) ? 'is-invalid' : ''); ?> shadow-sm"
                                           placeholder="パスワードを入力してください"
                                           required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Your password must be 8-20 characters long, contain letters and numbers, and
                                        must not contain spaces, special characters, or emoji.
                                    </small>
                                    <?php if(isset($errors['password'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['password']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-danger me-2">必須</span>パスワード確認</label>
                                <div class="col-sm-8">
                                    <input name="password_confirmation"
                                           type="password"
                                           pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                           class="form-control <?php echo e(isset($errors['password_confirmation']) ? 'is-invalid' : ''); ?> shadow-sm"
                                           placeholder="確認のためパスワードを再入力してください"
                                           required>
                                    <small id="passwordHelpBlock" class="form-text text-muted">
                                        Please re-enter your passwoprd and make sure it matches the password you entered
                                        above
                                    </small>
                                    <?php if(isset($errors['password_confirmation'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['password_confirmation']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-dark me-2">任意</span>郵便番号</label>
                                <div class="col-sm-2">
                                    <input name="postal_code1"
                                           type="text"
                                           id="postal_code1"
                                           value="<?php echo e($old_data['postal_code1'] ?? ''); ?>"
                                           class="form-control <?php echo e(isset($errors['postal_code1']) ? 'is-invalid' : ''); ?> shadow-sm"
                                           placeholder="000">
                                    <?php if(isset($errors['postal_code1'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['postal_code1']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-3">
                                    <input name="postal_code2"
                                           type="text"
                                           id="postal_code2"
                                           class="form-control <?php echo e(isset($errors['postal_code2']) ? 'is-invalid' : ''); ?> shadow-sm"
                                           value="<?php echo e($old_data['postal_code2'] ?? ''); ?>"
                                           placeholder="0000">
                                    <?php if(isset($errors['postal_code2'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['postal_code2']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" class="btn-sm btn-primary rounded-pill"
                                            onclick="searchPostalcode()"><i
                                                class="fas fa-search me-2"></i>検索
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">
                                    <span class="badge bg-dark me-2">任意</span>住所</label>
                                <div class="col-sm-3">
                                    <label class="col col-form-label small">都道府県</label>
                                    <input type="text"
                                           name="address1"
                                           id="address1"
                                           placeholder="東京都"
                                           value="<?php echo e($old_data['address1'] ?? ''); ?>"
                                           class="form-control form-control-sm <?php echo e(isset($errors['address1']) ? 'is-invalid' : ''); ?> shadow-sm">
                                    <?php if(isset($errors['address1'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['address1']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-sm-3">
                                    <label class="col col-form-label small">市区町村</label>
                                    <input type="text"
                                           name="address2"
                                           id="address2"
                                           placeholder="港区"
                                           value="<?php echo e($old_data['address2'] ?? ''); ?>"
                                           class="form-control form-control-sm <?php echo e(isset($errors['address2']) ? 'is-invalid' : ''); ?> shadow-sm">
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
                                           placeholder="六本木"
                                           value="<?php echo e($old_data['address3'] ?? ''); ?>"
                                           class="form-control form-control-sm <?php echo e(isset($errors['address3']) ? 'is-invalid' : ''); ?> shadow-sm">
                                    <?php if(isset($errors['address3'])): ?>
                                        <div class="invalid-feedback">
                                            <?php echo e($errors['address3']); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-success rounded-pill"><i class="fas fa-save me-2"></i>保存
                            </button>
                        </div>
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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview')
                        .attr('src', e.target.result)
                        .width(200)
                        .addClass("rounded img-thumbnail rounded-circle img-fluid")
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\native-project\views/users/add.blade.php ENDPATH**/ ?>