@extends('layouts.researchers')

@section('content')
<div class="container-fluid">
@csrf
  </div>
                        <div class="card md-4">
                            <div class="card-header">
                                参照する調査を選択してください
                            </div>
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="col-2">プロジェクト名</th>
                                            <th class="col-2">調査対象期間</th>
                                            <th class="col-1">年代</th>
                                            <th class="col-1">性別</th>
                                            <th class="col-2">競技</th>
                                            <th class="col-2"></th>
                                            <th class="col-2"></th>
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
                                            <td><a class="btn btn-secondary" href="/project/list/{{ $data->survey_id }}">回答を確認する</a></td>
                                            <td><a class="btn btn-secondary" href="/project/userlist/{{ $data->survey_id }}">調査回答者を見る</a></td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

@endsection