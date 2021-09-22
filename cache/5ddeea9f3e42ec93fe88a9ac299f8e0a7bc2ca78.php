

<?php $__env->startSection('content'); ?>
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-title p-2 bg-dark"></div>
            <div class="card-body p-4 px-4">
                <h5 class="card-title">検索条件</h5>
                <form class="row row-cols-lg-auto g-3 mb-3">
                    <?php echo csrf_field(); ?>
                    <div class="col-auto">
                        <label>名前</label>
                        <input id="name" name="name" type="text" class="form-control" placeholder="名前"/>
                    </div>
                    <div class="col-auto">
                        <label>メールアドレス</label>
                        <input id="email" name="email" type="email" class="form-control" placeholder="メールアドレス">
                    </div>
                    <div class="col-auto">
                        <label>性別</label>
                        <select name="gender" class="form-select">
                            <option value="" selected>なし</option>
                            <option value="1">男</option>
                            <option value="2">女</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label>都道府県</label>
                        <select name="address1" class="form-select">
                            <option value="" selected>なし</option>
                            <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($region['address1']); ?>"><?php echo e($region['address1']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex h-100">
                            <div class="align-self-end">
                                <button onclick="searchUserData()" type="button" class="btn btn-success rounded-pill"><i
                                            class="fas fa-search me-2"></i>検索
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-sm table-hover table-bordered data-table text-center table-light shadow-sm"
                       id="data-table">
                    <thead class="table-dark">
                    <tr>
                        <th>番号</th>
                        <th>名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>住所</th>
                        <th>アクション</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        var mytable = null
        var ajaxResponse = false

        $(document).ready(function () {
            mytable = $('#data-table').DataTable({
                language: {url: "//cdn.datatables.net/plug-ins/1.11.0/i18n/ja.json"},
                processing: true,
                serverSide: true,
                searching: false,
                serverMethod: 'post',
                stateSave: true,
                ajax: {
                    url: "<?php echo e(base_url('users/get')); ?>",
                    data: function (d) {
                        d.name = $('#name').val();
                        d.gender = $('select[name=gender]').val();
                        d.address1 = $('select[name=address1]').val();
                        d.email = $('#email').val();
                        d.csrf_token = $('input[name=csrf_token]').val()
                    },
                    error: function (xhr, status, error) {

                    },
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {
                        mData: "gender",
                        mRender: function (data, type, row) {
                            return data === 1 ? '男' : '女';
                        }
                    },
                    {data: 'email'},
                    {data: 'address1'},
                    {
                        mData: "id",
                        orderable: false,
                        mRender: function (data, type, row) {
                            return `<a href="http://localhost/native-project/user/` + data + `/edit"class="btn btn-sm rounded-pill btn-primary mx-1"><i
                            class="fas fa-edit me-2"></i>編集</a>
                            <button onclick="deleteUser(` + data + `)" class="btn btn-sm rounded-pill btn-danger mx-1"><i
                            class="fas fa-eraser me-2"></i>編集
                        </button>`;
                        }
                    }
                ]
            });
        });

        function searchUserData() {
            mytable.ajax.reload();
        }

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        function deleteUser(id) {
            Swal.fire({
                title: 'こちらのデータを削除して宜しいですか?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'キャンセル',
                confirmButtonText: 'はい'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'http://localhost/native-project/user/' + id + '/delete',
                        type: 'get',
                    }).always(function (data) {
                        ajaxResponse = true;
                        setTimeout(function () {
                            $('#data-table').DataTable().draw(false);
                        }, 1000)
                        Toast.fire({
                            icon: 'success',
                            title: 'ユーザー削除は完了しました'
                        })
                    });
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\native-project\views/dashboard.blade.php ENDPATH**/ ?>