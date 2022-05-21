@extends('layouts.admin')

@section('content')
  <div class="container">
    <form class="form-horizontal" method="POST" action="/admin/user/{{ $user->id }}/edit">
    {{csrf_field()}}

    <div class="p-3 my-3" style="background-color:#f5f5f5">
    ユーザーを編集します。
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        お名前（必須）
        </label>
        <div class="col-sm-7">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autocomplete="name" autofocus>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 form-check-label">
          性別（必須）
        </label>
          <div class="row radio-inline mx-2">
            <input class="form-check-input @error('sex_type') is-invalid @enderror" id="man" type="radio" name="sex_type" value="男性">&nbsp;<label for="男性">男性</label>
          </div>
          <div class="row radio-inline mx-2">
            <input class="form-check-input @error('sex_type') is-invalid @enderror" id="women" type="radio" name="sex_type" value="女性">&nbsp;<label for="女性">女性</label>
          </div>
          @error('sex_type')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
          @enderror
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        身長（必須）
        </label>
        <div class="col-sm-7">
          <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ $user->height }}" autocomplete="height" size="10">&nbsp;cm
          @error('height')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        体重（必須）
        </label>
        <div class="col-sm-7">
          <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ $user->weight }}" autocomplete="weight" size="10">&nbsp;kg
          @error('weight')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        体脂肪率（任意）
        </label>
        <div class="col-sm-7">
          <input id="fat_percentage" type="text" class="form-control @error('fat_percentage') is-invalid @enderror" name="fat_percentage" value="{{ $user->fat_percentage }}" autocomplete="fat_percentage" size="10">&nbsp;%
          @error('fat_percentage')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        競技名（必須）
        </label>
        <div class="col-sm-7">
          <input id="sport_name" type="text" class="form-control @error('sport_name') is-invalid @enderror" name="sport_name" value="{{ $user->sport_name }}" autocomplete="sport_name">
          @error('sport_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        ポジション（任意）
        </label>
        <div class="col-sm-7">
          <input id="sport_position" type="text" class="form-control @error('sport_position') is-invalid @enderror" name="sport_position" value="{{ $user->sport_position }}" autocomplete="sport_position">
          @error('sport_position')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>
      </div>

      <!-- <div class="p-3 my-3" style="background-color:#f5f5f5">
        メールアドレスとパスワードを設定してください
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        メールアドレス（必須）
        </label>
        <div class="col-sm-7">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        メールアドレス確認用（必須）
        </label>
        <div class="col-sm-7">
        <input id="email_confirmation" type="text" class="form-control @error('email_confirmation') is-invalid @enderror" name="email_confirmation" value="{{ $user->email_confirmation }}" autocomplete="email_confirmation">
            @error('email_confirmation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        パスワード（必須）
        </label>
        <div class="col-sm-7">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        パスワード確認用（必須）
        </label>
        <div class="col-sm-7">
        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="current-password_confirmation">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      </div> -->
      
      <div class="form-group form-inline">
        <label class="col-sm-3 control-label mt-5">
        権限（必須）
        </label>
        <div class="col-sm-7">
          <select class="form-control @error('auth_type') is-invalid @enderror" id="auth_type" name="auth_type">
            <option value="" hidden>選択してください</option>
            <option value="1">回答者</option>
            <option value="2">研究者</option>
            <option value="3">管理者</option>
          </select>
          @error('auth_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="row mt-5">
          <!-- <delete-record-component></delete-record-component> -->
          <!-- <button type="button" class="btn btn-secondary mx-2" style="width:200px" data-bs-toggle="modal" data-bs-target="#deleteModal">
            削除する
          </button> -->
          <button type="submit" class="btn btn-secondary mx-2" style="width:200px">登録する</button>
      </div>
    </form>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
          <div class="modal-body text-center">
              <h5 class="modal-title" id="deleteModalLabel">登録を削除してよろしいですか？</h5>
              <div class="d-flex justify-content-around mt-5">
                  <input type="button" class="btn btn-secondary" style="width:100px" data-dismiss="modal" value="戻る">
                  <form method="post" action="/admin/user/{{ $user->id }}/delete">
                  @csrf
                    <input type="submit" class="btn btn-secondary" style="width:100px" value="削除する">
                  </form>
              </div>
          </div>
          </div>
      </div>
    </div>
  </div>
@endsection