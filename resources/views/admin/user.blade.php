@extends('layouts.app')

@section('content')
<div class="container-fluid">
@csrf
  
    <h1>ユーザー一覧</h1>

    <a href="/admin/user/register">
      <input type="button" class="mt-5 btn btn-secondary col-sm-2" value="ユーザーを追加する">
    </a>

    <table class="table">
      <thead>
          <tr>
              <th>名前</th>
              <th>メールアドレス</th>
              <th>性別</th>
              <th>身長</th>
              <th>体重</th>
              <th>体脂肪率</th>
              <th>競技名</th>
              <th>ポジション</th>
              <th>権限</th>

          </tr>
      </thead>
      @foreach($user as $data)
      <tbody>
          <tr>
              <td>{{ $data->name }}</td>
              <td>{{ $data->email }}</td>
              <td>{{ $data->sex_type }}</td>
              <td>{{ $data->height }}cm</td>
              <td>{{ $data->weight }}kg</td>
              <td>{{ $data->fat_percentage }}%</td>
              <td>{{ $data->sport_name }}</td>
              <td>{{ $data->sport_position }}</td>
              @if($data->auth_type ==1)
              <td>回答者</td>
              @elseif($data->auth_type ==2)
              <td>研究者</td>
              @elseif($data->auth_type ==3)
              <td>管理者</td>
              @else
              <td></td>
              @endif
          </tr>
      </tbody>
      @endforeach

  </div>
@endsection