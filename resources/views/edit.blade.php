@extends('layouts.app')

@section('content')
<div class="container">
  
  <form method="POST" action="/edit">
  {{csrf_field()}}
    <div style="background-color:#f5f5f5">
      画像一覧が表示される予定
      <delete-picture-component></delete-picture-component>
    </div>
    <div class="form-group mt-3">
        <label class="control-label">
        食事区分（必須）
        </label>
          <select class="form-control @error('meal_type') is-invalid @enderror" style="width:200px" name="meal_type">
            <option value="" hidden>選択してください</option>
            <option value="1">朝食</option>
            <option value="2">昼食</option>
            <option value="3">間食</option>
            <option value="4">夕食</option>
            <option value="5">夜食</option>
        </select>
        @error('meal_type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
      <div class="form-group mt-3">
        <label class="control-label">
        場所（必須）
        </label>
        <input class="form-control @error('eat_place') is-invalid @enderror" style="width:200px" type="text" name="eat_place">
        @error('eat_place')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
      <div class="form-group mt-3">
        <label class="control-label">
          日時(必須）
        </label>
        <div class="form-row">
          <input class="form-control @error('eat_date') is-invalid @enderror" style="width:150px" type="date" name="eat_date">
          @error('eat_date')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          <input class="form-control @error('eat_time') is-invalid @enderror" style="width:150px" type="time" name="eat_time">
          @error('eat_time')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
      </div>

    <meal-detail-component></meal-detail-component>
       
      <div class="form-group mt-5">
        <label class="control-label">
          補足事項があれば入力してください（任意）
        </label>
          <textarea class="form-control @error('memo') is-invalid @enderror" name="memo" rows="3"></textarea>
          @error('memo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
      <div class="row mt-5">
          <delete-record-component></delete-record-component>
          <button type="submit" class="btn btn-secondary" style="width:200px">登録する</button>
      </div>
  </form>

  @endsection
  <script src="{{ mix('/js/app.js') }}" defer></script>
