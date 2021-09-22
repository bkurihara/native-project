<form method="POST" action="{{base_url('user')}}" enctype="multipart/form-data">
    <div class="row">
        <div class="col mb-3">
            <div class="col-md-3 mx-auto text-center">
                <img id="preview"
                     class="rounded img-thumbnail rounded-circle img-fluid"
                     width="180"
                     alt="profile picture"
                     src="{{base_url('public/images/placeholder.png')}}">
                <input onchange="readURL(this)"
                       class="form-control form-control-sm {{isset($errors['photo']) ? 'is-invalid' : ''}}"
                       name="photo" type="file">
                <small id="passwordHelpBlock" class="form-text text-muted">
                    Please upload only file that contains jpg, jpeg, png, gif
                    extensions
                </small>
                @if(isset($errors['photo']))
                    <div class="invalid-feedback">
                        {{$errors['photo']}}
                    </div>
                @endif
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
                           value="{{$old_data['name'] ?? ''}}"
                           class="form-control {{isset($errors['name']) ? 'is-invalid' : ''}} shadow-sm"
                           name="name"
                           placeholder="名前"
                           required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Only kanjis and kanas are allowed on this field
                    </small>
                    @if(isset($errors['name']))
                        <div class="invalid-feedback">
                            {{$errors['name']}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">
                    <span class="badge bg-danger me-2">必須</span>名前（カナ）
                </label>
                <div class="col-sm-8">
                    <input type="text"
                           value="{{$old_data['name_kana'] ?? ''}}"
                           class="form-control {{isset($errors['name_kana']) ? 'is-invalid' : ''}} shadow-sm"
                           name="name_kana"
                           placeholder="なまえ"
                           required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Only kana is allowed on this field
                    </small>
                    @if(isset($errors['name_kana']))
                        <div class="invalid-feedback">
                            {{$errors['name_kana']}}
                        </div>
                    @endif
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
                                   value="0"
                                   name="gender">
                            <label class="form-check-label">女性</label>
                        </div>
                        @if(isset($errors['gender']))
                            <div class="invalid-feedback">
                                {{$errors['gender']}}
                            </div>
                        @endif
                    </div>
            </fieldset>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">
                    <span class="badge bg-danger me-2">必須</span>メールアドレス</label>
                <div class="col-sm-8">
                    <input name="email"
                           type="email"
                           value="{{$old_data['email'] ?? ''}}"
                           class="form-control {{isset($errors['email']) ? 'is-invalid' : ''}} shadow-sm"
                           placeholder="example@gmail.com"
                           required>
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        Must be a valid email address
                    </small>
                    @if(isset($errors['email']))
                        <div class="invalid-feedback">
                            {{$errors['email']}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">
                    <span class="badge bg-dark me-2">任意</span>電話番号</label>
                <div class="col-sm-8">
                    <input name="phone"
                           type="text"
                           value="{{$old_data['phone'] ?? ''}}"
                           placeholder="080xxxxxxx"
                           class="form-control {{isset($errors['phone']) ? 'is-invalid' : ''}} shadow-sm">
                    <small id="passwordHelpBlock" class="form-text text-muted">
                        This field only allows numbers
                    </small>
                    @if(isset($errors['phone']))
                        <div class="invalid-feedback">
                            {{$errors['phone']}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label">
                    <span class="badge bg-dark me-2">任意</span>郵便番号</label>
                <div class="col-sm-2">
                    <input name="postal_code1"
                           type="text"
                           id="postal_code1"
                           value="{{$old_data['postal_code1'] ?? ''}}"
                           class="form-control {{isset($errors['postal_code1']) ? 'is-invalid' : ''}} shadow-sm"
                           placeholder="000">
                    @if(isset($errors['postal_code1']))
                        <div class="invalid-feedback">
                            {{$errors['postal_code1']}}
                        </div>
                    @endif
                </div>
                <div class="col-sm-3">
                    <input name="postal_code2"
                           type="text"
                           id="postal_code2"
                           class="form-control {{isset($errors['postal_code2']) ? 'is-invalid' : ''}} shadow-sm"
                           value="{{$old_data['postal_code2'] ?? ''}}"
                           placeholder="0000">
                    @if(isset($errors['postal_code2']))
                        <div class="invalid-feedback">
                            {{$errors['postal_code2']}}
                        </div>
                    @endif
                </div>
                <div class="col-sm-3">
                    <button type="button"
                            class="btn-sm btn-primary rounded-pill"
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
                           value="{{$old_data['address1'] ?? ''}}"
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
                           placeholder="港区"
                           value="{{$old_data['address2'] ?? ''}}"
                           class="form-control form-control-sm {{isset($errors['address2']) ? 'is-invalid' : ''}} shadow-sm">
                    @if(isset($errors['address2']))
                        <div class="invalid-feedback">
                            {{$errors['address2']}}
                        </div>
                    @endif
                </div>
                <div class="col-sm-2">
                    <label class="col col-form-label small">町域</label>
                    <input type="text"
                           name="address3"
                           id="address3"
                           placeholder="六本木"
                           value="{{$old_data['address3'] ?? ''}}"
                           class="form-control form-control-sm {{isset($errors['address3']) ? 'is-invalid' : ''}} shadow-sm">
                    @if(isset($errors['address3']))
                        <div class="invalid-feedback">
                            {{$errors['address3']}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button type="submit" class="btn btn-success rounded-pill"><i
                        class="fas fa-save me-2"></i>保存
            </button>
        </div>
    </div>
</form>
