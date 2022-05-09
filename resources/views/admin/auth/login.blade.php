@extends('layouts.app')

@section('content')

<div class="container-fluid  title-screen">
    <form class="form-horizontal" method="POST" action="{{ route('admin.login') }}">
    @csrf
      <div class="py-5 form-group text-center">
        <div class="h2 my-3">
          ログイン
        </div>
        <div class="my-3">
          <a href="/admin/register" class="text-dark">初回登録はこちら</a>
        </div>
        <div class="my-3">
          <input id="email" type="email" class="form-control mx-auto login-block @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="my-3">
          <input id="password" type="password" class="form-control mx-auto login-block @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

        </div>
        <div class="my-3">
          <div class="form-check">
          <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('ログイン状態を保持する') }}</span>
                </label>
          </div>
        </div>


            <!-- <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif -->


        <div class="my-3">
          <button type="submit" class="btn btn-secondary login-block">ログイン</button>
        </div>
      </div>
    </form>
  </div>

<style>
.title-screen{
  height:100vh;
  min-height:100vh;
  background-color: #e5e5e5;
}

.login-block{
  width: 300px;
}

 .error {
	color: red;
}
</style>


@endsection