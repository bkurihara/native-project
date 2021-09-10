@extends('layouts.app')

@section('content')
    <div class="container mt-5">
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
                        <input type="text" class="form-control" placeholder="名前"/>
                    </div>
                    <div class="col-auto">
                        <label>メールアドレス</label>
                        <input type="email" class="form-control" placeholder="メールアドレス">
                    </div>
                    <div class="col-auto">
                        <label>性別</label>
                        <select class="form-select">
                            <option selected>なし</option>
                            <option value="男">男</option>
                            <option value="女">女</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <label>都道府県</label>
                        <select class="form-select">
                            <option selected>なし</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex h-100">
                            <div class="align-self-end">
                                <button type="button" class="btn btn-success rounded-pill"><i
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
                    <tr>
                        <td>1</td>
                        <td>test</td>
                        <td>男</td>
                        <td>male@gmail.com</td>
                        <td>東京</td>
                        <td>
                            <a href="{{base_url('users/edit/1')}}" class="btn btn-sm rounded-pill btn-primary mx-1"><i
                                        class="fas fa-edit me-2"></i>編集</a>
                            <button onclick="deleteUser()" class="btn btn-sm rounded-pill btn-danger mx-1"><i
                                        class="fas fa-eraser me-2"></i>編集
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('#data-table').DataTable({
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.11.0/i18n/ja.json"
                },
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'address1',
                        name: 'address1'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });

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

        function deleteUser() {
            Swal.fire({
                title: 'こちらのユーザーを削除して宜しいですか?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'キャンセル',
                confirmButtonText: 'はい'
            }).then((result) => {
                if (result.isConfirmed) {
                    Toast.fire({
                        icon: 'success',
                        title: 'ユーザー削除は完了しました'
                    })
                }
            })
        }
    </script>
@endsection