

<?php $__env->startSection('content'); ?>
    <div class="container mt-3">
        <nav class="bg-white p-2 shadow-sm"
             style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
             aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.blade.php" aria-current="page">ダッシュボード</a></li>
            </ol>
        </nav>
        <div class="card shadow-sm">
            <div class="card-title p-2 bg-dark"></div>
            <div class="card-body">
                <h5 class="card-title">検索条件</h5>
                <form class="row row-cols-lg-auto g-3 mb-3">
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
                            <option value="0">女</option>
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
                serverMethod: 'post',
                stateSave: true,
                ajax: {
                    url: "<?php echo e(base_url('users/get')); ?>",
                    data: function (d) {
                        d.name = $('#name').val();
                        d.gender = $('select[name=gender]').val();
                        d.address1 = $('select[name=address1]').val();
                        d.email = $('#email').val();
                    },
                },
                columns: [
                    {data: 'id'},
                    {data: 'name'},
                    {
                        mData: "gender",
                        mRender: function (data, type, row) {
                            return data ? '男' : '女';
                        }
                    },
                    {data: 'email'},
                    {data: 'address1'},
                    {
                        mData: "id",
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