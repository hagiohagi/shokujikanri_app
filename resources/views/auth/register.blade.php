@extends('layouts.app')

@section('content')

<div class="container">
    <form class="form-horizontal" method="POST" action="/register">
    {{csrf_field()}}
      <div class="p-3 my-3" style="background-color:#f5f5f5">
        本日時点のあなたの情報を入力してください
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        お名前（必須）
        </label>
        <div class="col-sm-7">
          <!-- <input class="form-control" type="text" v-model="user_name"> -->
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
          @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

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
        <!-- <input class="form-control" type="email" v-model="email"> -->
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
        パスワード（必須）
        </label>
        <div class="col-sm-7">
        <!-- <input class="form-control" type="password" v-model="password"> -->
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
        <!-- <input class="form-control" type="password" v-model="password_confirmation"> -->
        <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" autocomplete="current-password_confirmation">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      </div>

      </div>
        <button type="submit" class="mt-5 btn btn-secondary" style="width:150px">登録する</button>
    </form>
  </div>
@endsection
