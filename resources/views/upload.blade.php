@extends('layouts.app')

@section('content')

<div class="container">
  <form method="POST" enctype="multipart/form-data" action="/upload">
    {{csrf_field()}}
    @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
    @endif
    <div class="py-5 text-center border" style="width:500">
      <label>
        <span class="mx-auto" title="ファイルを選択">
          <img src="/images/upload.png" width="450" alt="写真をアップロード">
        </span>
        <input type="file" id="photo" name="files[][photo]" multiple>
      </label>
    </div>
    <div class="form-group mt-3">
      <label class="control-label">
        食事区分（必須）
      </label>
      <select class="form-control @error('meal_type') is-invalid @enderror" style="width:200px" name="meal_type">
        <option value="" hidden>選択してください</option>
        <option value="1">朝食</option>
        <option value="2">昼食</option>
        <option value="4">夕食</option>
        <option value="3">間食</option>
        <option value="5">夜食</option>
      </select>
    </div>
    <div class="form-group mt-3">
      <label class="control-label">
        場所（必須）
      </label>
      <input class="form-control @error('eat_place') is-invalid @enderror" style="width:200px" type="text" name="eat_place">
    </div>
    <div class="form-group mt-3">
      <label class="control-label">
        日時(必須）
      </label>
      <div class="d-flex">
        <input class="form-control col-2 @error('eat_date') is-invalid @enderror" style="width:150px" type="date" name="eat_date">

        <input class="form-control col-2 @error('eat_time') is-invalid @enderror" style="width:150px" type="time" name="eat_time">

      </div>
    </div>


    <div>
      <label class="control-label mt-5 mb-3">
        食事内容を入力してください（必須）&nbsp;<a href="/pdf/request" target="_blank" rel="noopener noreferrer">ヘルプ</a>
      </label>
      <div class="d-flex">
        <label class="control-label text-center" style="width:150px">食事</label>
        <label class="control-label text-center" style="width:150px">材料</label>
        <label class="control-label text-center" style="width:150px">量</label>
      </div>
      <div id="meal-detail">
      </div>
      <!-- <div class="row">
          <div class="form-group col-4">
            <textarea id="textarea-with-border" class="form-control @error('food') is-invalid @enderror" name="food" rows="5"></textarea>
            @error('food')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div> 
          <div class="form-group col-4">
          <textarea id="textarea-with-border" class="form-control @error('ingredient') is-invalid @enderror" name="ingredient" rows="5"></textarea>
          @error('ingredient')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group col-4">
          <textarea id="textarea-with-border" class="form-control @error('amount') is-invalid @enderror" name="amount" rows="5"></textarea>
          @error('amount')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        </div> -->
    </div>

    <div class="form-group mt-5">
      <label class="control-label">
        補足事項があれば入力してください（任意）
      </label>
      <textarea class="form-control @error('memo') is-invalid @enderror" name="memo" rows="3"></textarea>
    </div>
    <button class="mt-5 btn btn-secondary" style="width:150px" name="submit" id="post">登録する</button>
  </form>
</div>
@endsection


<script src="{{ mix('/js/app.js') }}" defer></script>