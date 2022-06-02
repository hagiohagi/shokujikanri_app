@extends('layouts.admin')

@section('content')
<div class="container-fluid">
<div class="container">
@csrf
  <ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link active disabled" href="/admin/user">ユーザー一覧</a></li>
  </ul>
  
    <h1>ユーザー一覧</h1>

    <div class="d-flex">
    <a href="/admin/user/register">
      <input type="button" class="my-5 btn btn-secondary" value="ユーザーを追加する">
    </a>
    &nbsp;
    <a href="/admin/user/import">
      <input type="button" class="my-5 btn btn-secondary" value="CSVアップロード">
    </a>
    </div>
</div>

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
              <th></th>
              <th></th>

          </tr>
      </thead>
      @foreach($accounts as $data)
      <tbody>
          <tr>
              <td>{{ $data['name'] }}</td>
              <td>{{ $data['email'] }}</td>
              <td>{{ $data['sex_type'] ?? '-' }}</td>
              <td>{{ $data['height'] ?? '-' }}cm</td>
              <td>{{ $data['weight'] ?? '-' }}kg</td>
              <td>{{ $data['fat_percentage'] ?? '-' }}%</td>
              <td>{{ $data['sport_name'] ?? '-' }}</td>
              <td>{{ $data['sport_position'] ?? '-' }}</td>
              @if($data['auth_type'] ==1)
              <td>回答者</td>
              @elseif($data['auth_type'] ==2)
              <td>研究者</td>
              @elseif($data['auth_type'] ==3)
              <td>管理者</td>
              @else
              <td></td>
              @endif
                @if($data['auth_type'] ==1)
              <td><a class="btn btn-secondary" href="/admin/user/{{ $data['id'] }}/edit">編集する</a></td>
              <td><a class="btn btn-secondary" href="/admin/user/{{ $data['id'] }}/index">投稿を見る</a></td>
              @endif
          </tr>
      </tbody>
      @endforeach

  </div>
</div>
@endsection