@extends('layouts.admin')

@section('content')
<div class="container">

  <ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>

  <div style="background-color:#f5f5f5">
    <p>画像一覧</p>
    <div class="row row-cols-4 justify-content-start">
      @foreach($meal_record->mealPhotos as $meal_photo)
      <div class="card col">
        <img src="{{ url('/images/'. $meal_photo->photo_path ?? '')}}" alt="...">
        <div class="card-img-overlay">
          <button type="button" class="btn-close" aria-label="Close" data-bs-toggle="modal" data-bs-target="#pictureDeleteModal-{{ $meal_photo->photo_num ?? '' }}"></button>
        </div>
      </div>
      @endforeach
    </div>

    <form method="POST" enctype="multipart/form-data" action="/admin/user/{{ $user->id }}/edit/{{ $meal_record->meal_id }}">
      {{csrf_field()}}
      <div class="form-group card col-3">
        <label class="control-label">
          <span title="ファイルを選択">
            <img src="/images/add_photo.png" alt="写真をアップロード">
          </span>
          <input type="file" id="photo" name="files[][photo]" multiple>
        </label>
      </div>
      <div>
        @error('files[photo]')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
  </div>


  <div class="form-group mt-3">
    <label class="control-label">
      食事区分（必須）
    </label>
    <select class="form-control @error('meal_type') is-invalid @enderror" style="width:200px" value="{{ $meal_record->meal_type }}" name="meal_type">
      <option value="" hidden>選択してください</option>
      <option value="" hidden>選択してください</option>
      <option value="1" @if($meal_record->meal_type == 1) selected @endif>朝食</option>
      <option value="2" @if($meal_record->meal_type == 2) selected @endif>昼食</option>
      <option value="4" @if($meal_record->meal_type == 4) selected @endif>夕食</option>
      <option value="3" @if($meal_record->meal_type == 3) selected @endif>間食</option>
      <option value="5" @if($meal_record->meal_type == 5) selected @endif>夜食</option>
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
    <input class="form-control @error('eat_place') is-invalid @enderror" style="width:200px" type="text" value="{{ $meal_record->eat_place }}" name="eat_place">
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
      <input class="form-control @error('eat_date') is-invalid @enderror" style="width:150px" type="date" value="{{ $meal_record->eat_date }}" name="eat_date">
      @error('eat_date')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
      <input class="form-control @error('eat_time') is-invalid @enderror" style="width:150px" type="time" value="{{ $meal_record->eat_time }}" name="eat_time">
      @error('eat_time')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
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

    @foreach($meal_record->mealDetails as $meal_detail)
    <div class="d-flex mt-2">
      <div class="form-group" style="width: 150px">
        <input class="form-control @error('food') is-invalid @enderror" type="text" name="meal_details[{{$loop->index}}][food]" value="{{$meal_detail['food']}}">
        @error('food')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group" style="width: 150px">
        <input class="form-control @error('ingredient') is-invalid @enderror" type="text" name="meal_details[{{$loop->index}}][ingredient]" value="{{$meal_detail['ingredient']}}">
        @error('ingredient')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>

      <div class="form-group" style="width: 150px">
        <input class="form-control @error('amount') is-invalid @enderror" type="text" name="meal_details[{{$loop->index}}][amount]" value="{{$meal_detail['amount']}}">
        @error('amount')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </div>
    </div>
    @endforeach

    <div>
      <button class="btn btn-secondary mt-3" style="width: 450px" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
        ↓入力欄を追加↓
      </button>

      <div id="collapseOne" class="collapse">
        @for($i = 0; $i < 5; $i++) <div class="d-flex mt-2">
          <div class="form-group" style="width: 150px">
            <input class="form-control @error('food') is-invalid @enderror" type="text" name="meal_details[{{ $i + count($meal_record->mealDetails)}}][food]" value="">
            @error('food')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group" style="width: 150px">
            <input class="form-control @error('ingredient') is-invalid @enderror" type="text" name="meal_details[{{ $i + count($meal_record->mealDetails)}}][ingredient]" value="">
            @error('ingredient')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group" style="width: 150px">
            <input class="form-control @error('amount') is-invalid @enderror" type="text" name="meal_details[{{ $i + count($meal_record->mealDetails)}}][amount]" value="">
            @error('amount')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
      </div>
      @endfor
    </div>
  </div>

  <div class="form-group mt-5">
    <label class="control-label">
      補足事項があれば入力してください（任意）
    </label>
    <textarea class="form-control @error('memo') is-invalid @enderror" name="memo" rows="3">{{ $meal_record->memo }}</textarea>
    @error('memo')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>30
    @enderror
  </div>
  <div class="row mt-5">
    <button type="button" class="btn btn-secondary mx-2" style="width:200px" data-bs-toggle="modal" data-bs-target="#exampleModal">
      削除する
    </button>
    <button type="submit" class="btn btn-secondary mx-2" style="width:200px">更新する</button>
  </div>
  </form>

  <!-- Modal -->

  @foreach($meal_record->mealPhotos as $meal_photo)
  <div class="modal fade" id="pictureDeleteModal-{{ $meal_photo->photo_num ?? '' }}" aria-labelledby="pictureDeleteModal-{{ $meal_photo->photo_num ?? '' }}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h5 class="modal-title" id="pictureDeleteModal-{{ $meal_photo->photo_num ?? '' }}Label">写真を削除してよろしいですか？</h5>
          <div class="d-flex justify-content-around mt-5">
            <input type="button" class="btn btn-secondary" style="width:100px" data-bs-dismiss="modal" value="戻る">
            <form method="post" action="/admin/user/{{ $user->id }}/delete/{{ $meal_record->meal_id }}/{{ $meal_photo->photo_num ?? '' }}">
              @csrf
              <input type="submit" class="btn btn-secondary" style="width:100px" value="削除する">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach


  <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body text-center">
          <h5 class="modal-title" id="exampleModalLabel">登録を削除してよろしいですか？</h5>
          <div class="d-flex justify-content-around mt-5">
            <input type="button" class="btn btn-secondary" style="width:100px" data-bs-dismiss="modal" value="戻る">
            <form method="post" action="/admin/user/{{ $user->id }}/delete/{{ $meal_record->meal_id }}">
              @csrf
              <input type="submit" class="btn btn-secondary" style="width:100px" value="削除する">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection