@extends('layouts.app')

@section('content')
<div class="container">
@csrf
  
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
             
          </tr>
      </tbody>
      @endforeach
  
  </div>
@endsection