@extends('layouts.admin')

@section('content')
<div class="container">
<ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>
    <form class="form-horizontal" method="POST" action="/admin/project/register">
    {{csrf_field()}}
      <div class="p-3 my-3" style="background-color:#f5f5f5">
        調査情報の登録を行います。
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        プロジェクト名（必須）
        </label>
        <div class="col-sm-7">
          <input id="survey_name" type="text" class="form-control @error('survey_name') is-invalid @enderror" name="survey_name" value="{{ old('survey_name') }}" autocomplete="survey_name" autofocus>
          @error('survey_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        調査対象期間（必須）
        </label>
        <div class="col-sm-7">
          <input id="term" type="text" class="form-control @error('term') is-invalid @enderror" name="term" value="{{ old('term') }}" autocomplete="term" autofocus>
          @error('term')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        年代（必須）
        </label>
        <div class="col-sm-7">
          <input id="era" type="text" class="form-control @error('era') is-invalid @enderror" name="era" value="{{ old('era') }}" autocomplete="era" autofocus>
          @error('era')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        性別（必須）
        </label>
        <div class="col-sm-7">
          <input id="sex" type="text" class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ old('sex') }}" autocomplete="sex" autofocus>
          @error('sex')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        競技（必須）
        </label>
        <div class="col-sm-7">
          <input id="sport" type="text" class="form-control @error('sport') is-invalid @enderror" name="sport" value="{{ old('sport') }}" autocomplete="sport" autofocus>
          @error('sport')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>
      
      <div class="form-group form-inline">
        <label class="col-sm-7 control-label">
        6桁の番号を入力してください。(必須)
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
      <div class="col-sm-3">
        <button type="submit" class="p-10 btn btn-secondary" style="width:150px">登録する</button>
      </div>
  </div>
@endsection