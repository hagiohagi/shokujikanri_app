@extends('layouts.admin')

@section('content')
  <div class="container">

  <ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>

    <form class="form-horizontal" method="POST" action="/admin/user/register">
    {{csrf_field()}}

    <div class="p-3 my-3" style="background-color:#f5f5f5">
    このサイトに追加する新規ユーザーを作成します。
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        お名前（必須）
        </label>
        <div class="col-sm-7">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
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
          <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" autocomplete="height" size="10">&nbsp;cm
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
          <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') }}" autocomplete="weight" size="10">&nbsp;kg
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
          <input id="fat_percentage" type="text" class="form-control @error('fat_percentage') is-invalid @enderror" name="fat_percentage" value="{{ old('fat_percentage') }}" autocomplete="fat_percentage" size="10">&nbsp;%
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
          <input id="sport_name" type="text" class="form-control @error('sport_name') is-invalid @enderror" name="sport_name" value="{{ old('sport_name') }}" autocomplete="sport_name">
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
          <input id="sport_positon" type="text" class="form-control @error('sport_positon') is-invalid @enderror" name="sport_positon" value="{{ old('sport_positon') }}" autocomplete="sport_positon">
          @error('sport_positon')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

        </div>
      </div>

      <div class="p-3 my-3" style="background-color:#f5f5f5">
        メールアドレスとパスワードを設定してください
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        メールアドレス（必須）
        </label>
        <div class="col-sm-7">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
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
        <input id="email_confirmation" type="text" class="form-control @error('email_confirmation') is-invalid @enderror" name="email_confirmation" value="{{ old('email_confirmation') }}" autocomplete="email_confirmation">
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
      </div>
      <div class="p-3 my-3" style="background-color:#f5f5f5">
        権限を設定してください
      </div>
      
      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
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
      <div class="form-group form-inline">
        <label class="col-sm-7 control-label">
        【回答者のみ】6桁の番号を入力してください。(正しくない場合NOT FOUNDと表示されます)
        </label>
        <div class="col-sm-7">
        <input id="research_number" type="text" class="col-sm-2 form-control @error('research_number') is-invalid @enderror" name="research_number" value="{{ old('research_number') }}" autocomplete="research_number">
            @error('research_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
      </div>
        <button type="submit" class="p-10 text-center btn btn-secondary" style="width:150px">登録する</button>
    </form>
  </div>
@endsection