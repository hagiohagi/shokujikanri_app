@extends('layouts.admin')

@section('content')
<div class="container">
@csrf
<ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link active disabled" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>
  
    <h1>調査一覧</h1>

    <a href="/admin/project/register">
      <input type="button" class="mt-5 btn btn-secondary col-sm-2" value="プロジェクトを追加する">
    </a>

    <table class="table">
      <thead>
          <tr>
              <th>プロジェクト名</th>
              <th>調査対象期間</th>
              <th>年代</th>
              <th>性別</th>
              <th>競技</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
      @foreach($survey_info as $data)
      <tbody>
          <tr>
              <td>{{ $data->survey_name }}</td>
              <td>{{ $data->term }}</td>
              <td>{{ $data->era }}</td>
              <td>{{ $data->sex }}</td>
              <td>{{ $data->sport }}</td>
              <td><a class="btn btn-secondary" href="/admin/project/{{ $data->survey_id }}/list">回答を確認する</a></td>
              <td><a class="btn btn-secondary" href="/admin/project/{{ $data->survey_id }}/edit">編集する</a></td>
          </tr>
      </tbody>
      @endforeach
  
  </div>
@endsection