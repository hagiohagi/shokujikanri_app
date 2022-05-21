@extends('layouts.admin')

@section('content')
<div class="container">
<ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>
@csrf
  <div class="row mt-3">
    <h1>{{ $survey_info->survey_name }}</h1>
    <h2>調査対象期間:{{ $survey_info->term }}</h2>
  </div>

  <div class="row">
  <div class="form-group form-inline mx-2 mt-3">
        <label class="control-label">
        絞込み：
        </label>
          <select class="form-control">
            <option value="" hidden>名前を選択してください</option>
            <option value="1">田中太郎</option>
            <option value="2">山田花子</option>
        </select>
        <!-- @error('')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror -->
      </div>
      <div class="form-group form-inline mx-2 mt-3">
        <label class="control-label">
        並び替え：
        </label>
          <select class="form-control">
            <option value="1">あいうえお順</option>
            <option value="2">日付の新しい順</option>
            <option value="3">日付の古い順</option>
        </select>
        <!-- @error('')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror -->
      </div>
  </div>

  <div class="container mt-3 mx-2 border">
    <div class="d-flex justify-content-start">
      <div class="my-box w-25">田中太郎</div>
      <div class="my-box w-25">朝食</div>
      <div class="my-box w-25">2022 01/01</div>
      <div class="my-box w-25">自宅</div>
    </div>
    <div class="row">
      <div class="col-7 mt-3">col-7</div>
      <div class="col-5 mt-3">
        <table class="table display-none">
          <tr>
              <td>食事</td>
              <td>材料</td>
              <td>量</td>
          </tr>
        </table>
        <div>
          補足
        </div>
      </div>
    </div>
  </div>

  <a class="mt-5 btn btn-secondary" href="/admin/project">一覧に戻る</a>




</div>

@endsection