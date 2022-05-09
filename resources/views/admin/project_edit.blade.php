@extends('layouts.admin')

@section('content')
<div class="container">
    <form class="form-horizontal" method="POST" action="/admin/project/{{ $survey_info->survey_id }}/edit">
    {{csrf_field()}}
      <div class="p-3 my-3" style="background-color:#f5f5f5">
        調査情報の編集を行います。
      </div>

      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        プロジェクト名（必須）
        </label>
        <div class="col-sm-7">
          <input id="survey_name" type="text" class="form-control @error('survey_name') is-invalid @enderror" name="survey_name" value="{{ $survey_info->survey_name }}" autocomplete="survey_name" autofocus>
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
          <input id="term" type="text" class="form-control @error('term') is-invalid @enderror" name="term" value="{{ $survey_info->term }}" autocomplete="term" autofocus>
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
          <input id="era" type="text" class="form-control @error('era') is-invalid @enderror" name="era" value="{{ $survey_info->era }}" autocomplete="era" autofocus>
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
          <input id="sex" type="text" class="form-control @error('sex') is-invalid @enderror" name="sex" value="{{ $survey_info->sex }}" autocomplete="sex" autofocus>
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
          <input id="sport" type="text" class="form-control @error('sport') is-invalid @enderror" name="sport" value="{{ $survey_info->sport }}" autocomplete="sport" autofocus>
          @error('sport')
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