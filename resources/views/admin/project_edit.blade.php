@extends('layouts.admin')

@section('content')
<div class="container">
<ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>
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
      <div class="form-group form-inline">
        <label class="col-sm-3 control-label">
        調査番号(編集不可)
        </label>
        <div class="col-sm-7">
        <input id="research_number" type="text" class="col-sm-2 form-control @error('research_number') is-invalid @enderror" name="research_number" value="{{ $survey_info->research_number }}" autocomplete="research_number" disabled>
            
        </div>
      </div>


      <div class="row mt-5">
          <!-- <delete-record-component></delete-record-component> -->
          <!-- <button type="button" class="btn btn-secondary mx-2" style="width:200px" data-bs-toggle="modal" data-bs-target="#exampleModal-1">
            削除する
          </button> -->

            <!-- Modal -->
              <!-- <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5 class="modal-title" id="exampleModalLabel">登録を削除してよろしいですか？</h5>
                        <div class="d-flex justify-content-around mt-5">
                            <input type="button" class="btn btn-secondary" style="width:100px" data-dismiss="modal" value="戻る">
                            <form method="post" action="/admin/project/{{ $survey_info->survey_id }}/delete }}">
                            @csrf
                              <input type="submit" class="btn btn-secondary" style="width:100px" value="削除する">
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
              </div>
 -->
          <button type="submit" class="btn btn-secondary mx-2" style="width:200px">更新する</button>
      </div>
  </div>
@endsection