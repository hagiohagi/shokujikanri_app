@extends('layouts.app')

@section('content')
<div class="container">
  
  <form method="POST" action="/edit/{{ $meal_record->meal_id }}">
  {{csrf_field()}}
    <div style="background-color:#f5f5f5">
      画像一覧
      <div class="carousel-inner">
          @foreach($meal_record->mealPhotos as $meal_photo)
          <div class="d-flex justify-content-left">
            <img src="{{ url('/images/'. $meal_photo->photo_path)}}" class="d-block w-25" alt="...">
          </div>
          @endforeach
          
      </div>
      <div>
          <label>
            <span class="mx-auto" title="ファイルを選択">
            </span>
            <input type="file" id="photo" name="files[][photo]" multiple>
          </label>
          @error('files[photo]')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      </div>
      <delete-picture-component></delete-picture-component>
    </div>
    <div class="form-group mt-3">
        <label class="control-label">
        食事区分（必須）
        </label>
          <select class="form-control @error('meal_type') is-invalid @enderror" style="width:200px" value="{{ $meal_record->meal_type }}" name="meal_type">
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

    <!-- <meal-detail-component></meal-detail-component> -->
    <div>
        <label class="control-label mt-5 mb-3">
          食事内容を入力してください（必須）&nbsp;<a href="#" name="help">ヘルプ</a>
        </label>
        <div class="row">
          <label class="control-label text-center col-3">食事</label>
          <label class="control-label text-center col-3">材料</label>
          <label class="control-label text-center col-3">量</label>
        </div>
        @foreach($meal_record->mealDetails as $meal_detail)
        <div class="row">
          <div class="form-group col-3">
            <input class="form-control @error('food') is-invalid @enderror" type="textarea" value="{{ $meal_detail->food }}" name="food">
            @error('food')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div> 
          <div class="form-group col-3">
          <input class="form-control @error('ingredient') is-invalid @enderror" type="textarea" value="{{ $meal_detail->ingredient }}"name="ingredient">
          @error('ingredient')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
          </div>
          <div class="form-group col-3">
          <input class="form-control @error('amount') is-invalid @enderror" type="textarea" value="{{ $meal_detail->amount }}"name="amount">
          @error('amount')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
        </div>
        </div>
        @endforeach
      </div>
       
      <div class="form-group mt-5">
        <label class="control-label">
          補足事項があれば入力してください（任意）
        </label>
          <textarea class="form-control @error('memo') is-invalid @enderror" value="{{ $meal_record->memo }}" name="memo" rows="3"></textarea>
          @error('memo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>30
          @enderror
      </div>
      <div class="row mt-5">
          <!-- <delete-record-component></delete-record-component> -->
          <button type="button" class="btn btn-secondary mx-2" style="width:200px" data-bs-toggle="modal" data-bs-target="#exampleModal">
            削除する
          </button>
          <button type="submit" class="btn btn-secondary mx-2" style="width:200px">登録する</button>
      </div>
  </form>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-body text-center">
                        <h5 class="modal-title" id="exampleModalLabel">登録を削除してよろしいですか？</h5>
                        <div class="d-flex justify-content-around mt-5">
                            <input type="button" class="btn btn-secondary" style="width:100px" data-dismiss="modal" value="戻る">
                            <form method="post" action="/delete/{{ $meal_record->meal_id }}">
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