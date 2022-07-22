@extends('layouts.researchers')

@section('content')
<div class="container-fluid">
<div class="container">
@csrf
    <h1>ユーザー一覧</h1>

    <div class="row mt-3">
    <div class="col-5 h2">プロジェクト名:{{ $survey_info->survey_name ?? '' }}</div>
    <div class="col-5 h3">調査対象期間:{{ $survey_info->term ?? '' }}</div>
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

          </tr>
      </thead>
      @foreach($users as $user)
      <tbody>
          <tr>
              <td>{{ $user['name'] }}</td>
              <td>{{ $user['email'] }}</td>
              <td>{{ $user['sex_type'] ?? '-' }}</td>
              <td>{{ $user['height'] ?? '-' }}cm</td>
              <td>{{ $user['weight'] ?? '-' }}kg</td>
              <td>{{ $user['fat_percentage'] ?? '-' }}%</td>
              <td>{{ $user['sport_name'] ?? '-' }}</td>
              <td>{{ $user['sport_position'] ?? '-' }}</td>
      </tbody>
      @endforeach
      <a class="mt-5 btn btn-secondary" href="/project/index">一覧に戻る</a>

  </div>
</div>
@endsection