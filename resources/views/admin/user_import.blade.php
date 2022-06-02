@extends('layouts.admin')

@section('content')
<div class="container">

  <ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>
  
  <div class="upload">
    <h2>CSVアップロード</h2>

    <div>
      <label class="col-7">
      <p>※回答者ユーザーのデータのみ受け付けています</p>
      <p>※CSVファイルには以下の値を順に設定してください</p>
      <p>・お名前</p>
      <p>・性別（男性or女性）</p>
      <p>・身長</p>
      <p>・体重</p>
      <p>・競技名</p>
      <p>・ポジション</p>
      <p>・メールアドレス</p>
      <p>・パスワード</p>
      <p>・調査番号</p>
      </label>
    </div>
    <form action="/admin/user/import" method="post" enctype="multipart/form-data">
      @csrf
      <input type="file" name="csvdata" />
      <button class="p-10 text-center btn btn-secondary">送信</button>
    </form>
  </div>

    <a class="mt-5 btn btn-secondary" href="/admin/user">一覧に戻る</a>
  
  </div>
@endsection