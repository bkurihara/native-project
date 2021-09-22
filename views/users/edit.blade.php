@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow-lg">
            <div class="card-title p-2 bg-dark text-white">
                <p class="h6 ps-2 mb-0"><i class="fas fa-edit me-2"></i>ユーザー情報変更</p>
            </div>
            <div class="card-body mx-3">
                <div class="row my-4">
                    <div class="col px-5">
                        <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                            <li class="nav-item rounded" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                        aria-selected="true"><i class="fas fa-user-alt me-2"></i>ユーザー情報
                                </button>
                            </li>
{{--                            <li class="nav-item rounded" role="presentation">--}}
{{--                                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"--}}
{{--                                        data-bs-target="#pills-profile" type="button" role="tab"--}}
{{--                                        aria-controls="pills-profile" aria-selected="false"><i--}}
{{--                                            class="fas fa-users me-3"></i>フォロワー一覧--}}
{{--                                </button>--}}
{{--                            </li>--}}
{{--                            <li class="nav-item rounded" role="presentation">--}}
{{--                                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"--}}
{{--                                        data-bs-target="#pills-contact" type="button" role="tab"--}}
{{--                                        aria-controls="pills-contact" aria-selected="false"><i--}}
{{--                                            class="fas fa-user-plus me-3"></i>フォロワー追加--}}
{{--                                </button>--}}
{{--                            </li>--}}
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                 aria-labelledby="pills-home-tab">
                                <div class="col border border-2 border-dark p-3">
                                    <form method="POST" action="{{base_url('user/').$user->id.'/update'}}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{$user->id}}"/>
                                        <div class="row mb-3">
                                            <div class="col-md-3 mx-auto text-center">
                                                <img id="preview" class="rounded img-thumbnail rounded-circle img-fluid"
                                                     width="180"
                                                     alt="profile picture"
                                                     src="{{base_url(isset($user->photo) ? $user->photo : 'public/images/placeholder.png')}}">
                                                <p class="h5 my-3">{{$user->name .' '. $user->name_kana}}</p>
                                                <input onchange="readURL(this)"
                                                       class="form-control form-control-sm {{isset($errors['photo']) ? 'is-invalid' : ''}}"
                                                       name="photo" type="file">
                                                @if(isset($errors['photo']))
                                                    <div class="invalid-feedback">
                                                        {{$errors['photo']}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">名前</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                               value="{{$old_data['name'] ?? $user->name}}"
                                                               class="form-control {{isset($errors['name']) ? 'is-invalid' : ''}} shadow-sm"
                                                               name="name" required>

                                                        @if(isset($errors['name']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['name']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">名前（カナ）</label>
                                                    <div class="col-sm-9">
                                                        <input type="text"
                                                               value="{{$old_data['name_kana'] ?? $user->name_kana}}"
                                                               class="form-control {{isset($errors['name_kana']) ? 'is-invalid' : ''}} shadow-sm"
                                                               name="name_kana" required>
                                                        @if(isset($errors['name_kana']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['name_kana']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <fieldset class="row mb-3">
                                                    <label class="col-form-label col-sm-3 pt-0">性別</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input"
                                                                   type="radio"
                                                                   value="1"
                                                                   name="gender"
                                                                    {{$user->gender == 1 ? 'checked' : ''}}>
                                                            <label class="form-check-label">男性</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       value="2"
                                                                       name="gender"
                                                                        {{$user->gender == 2 ? 'checked' : ''}}>
                                                                <label class="form-check-label {{isset($errors['gender']) ? 'is-invalid' : ''}}">女性</label>
                                                            </div>
                                                            @if(isset($errors['gender']))
                                                                <div class="invalid-feedback">
                                                                    {{$errors['gender']}}
                                                                </div>
                                                            @endif
                                                        </div>
                                                </fieldset>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">メールアドレス</label>
                                                    <div class="col-sm-9">
                                                        <input name="email"
                                                               type="email"
                                                               value="{{$old_data['email'] ?? $user->email}}"
                                                               class="form-control {{isset($errors['email']) ? 'is-invalid' : ''}} shadow-sm"
                                                               required>
                                                        @if(isset($errors['email']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['email']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-3 col-form-label">電話番号</label>
                                                    <div class="col-sm-9">
                                                        <input name="phone"
                                                               type="text"
                                                               value="{{$old_data['phone'] ?? $user->phone}}"
                                                               class="form-control {{isset($errors['phone']) ? 'is-invalid' : ''}} shadow-sm">
                                                        @if(isset($errors['phone']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['phone']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">パスワード</label>
                                                    <div class="col-sm-9">
                                                        <input name="password"
                                                               type="password"
                                                               class="form-control {{isset($errors['password']) ? 'is-invalid' : ''}} shadow-sm">
                                                        @if(isset($errors['password']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['password']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">パスワード確認</label>
                                                    <div class="col-sm-9">
                                                        <input name="password_confirmation"
                                                               type="password"
                                                               class="form-control {{isset($errors['password_confirmation']) ? 'is-invalid' : ''}} shadow-sm">
                                                        @if(isset($errors['password_confirmation']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['password_confirmation']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">郵便番号</label>
                                                    <div class="col-sm-3">
                                                        <input name="postal_code1"
                                                               type="number"
                                                               id="postal_code1"
                                                               value="{{$old_data['postal_code1'] ?? $user->postal_code1}}"
                                                               class="form-control {{isset($errors['postal_code1']) ? 'is-invalid' : ''}} shadow-sm"
                                                               placeholder="123">
                                                        @if(isset($errors['postal_code1']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['postal_code1']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input name="postal_code2"
                                                               type="number"
                                                               id="postal_code2"
                                                               class="form-control {{isset($errors['postal_code2']) ? 'is-invalid' : ''}} shadow-sm"
                                                               value="{{$old_data['postal_code2'] ?? $user->postal_code2}}"
                                                               placeholder="1234">
                                                        @if(isset($errors['postal_code2']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['postal_code2']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <button type="button" class="btn btn-sm btn-primary rounded-pill"
                                                                onclick="searchPostalcode()"><i
                                                                    class="fas fa-search me-2"></i>検索
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="inputEmail3" class="col-sm-3 col-form-label">住所</label>
                                                    <div class="col-sm-3">
                                                        <label class="col col-form-label small">都道府県</label>
                                                        <input type="text"
                                                               name="address1"
                                                               id="address1"
                                                               value="{{$old_data['address1'] ?? $user->address1}}"
                                                               class="form-control form-control-sm {{isset($errors['address1']) ? 'is-invalid' : ''}} shadow-sm">
                                                        @if(isset($errors['address1']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['address1']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="col col-form-label small">市区町村</label>
                                                        <input type="text"
                                                               name="address2"
                                                               id="address2"
                                                               value="{{$old_data['address2'] ?? $user->address2}}"
                                                               class="form-control form-control-sm {{isset($errors['address2']) ? 'is-invalid' : ''}} shadow-sm">
                                                        @if(isset($errors['address2']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['address2']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <label class="col col-form-label small">町域</label>
                                                        <input type="text"
                                                               name="address3"
                                                               id="address3"
                                                               value="{{$old_data['address3'] ?? $user->address3}}"
                                                               class="form-control form-control-sm {{isset($errors['address3']) ? 'is-invalid' : ''}} shadow-sm">
                                                        @if(isset($errors['address3']))
                                                            <div class="invalid-feedback">
                                                                {{$errors['address3']}}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="submit"
                                                        class="btn btn-success rounded-pill"><i
                                                            class="fas fa-save me-2"></i>保存
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                                 aria-labelledby="pills-profile-tab">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab">
                                    <div class="row border border-2 border-dark p-3"></div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                                 aria-labelledby="pills-contact-tab">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                     aria-labelledby="pills-home-tab">
                                    <div class="row border border-2 border-dark p-3">
                                        @include('components.add_form',['test'=>'hello'])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        var triggerTabList = [].slice.call(document.querySelectorAll('ul.nav-tabs button'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)

            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })

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
@endsection