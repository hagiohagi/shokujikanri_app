@extends('layouts.researchers')

@section('content')
<div class="container">
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
          @foreach($survey_info->users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
          @endforeach
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
      <div class="col-7 mt-3">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="/images/upload.png" class="d-block w-100" alt="/images/upload.png">
            </div>
            <div class="carousel-item">
              <img src="/images/upload.png" class="d-block w-100" alt="/images/upload.png">
            </div>
            <div class="carousel-item">
              <img src="/images/upload.png" class="d-block w-100" alt="/images/upload.png">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
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

  @foreach($survey_info->users as $user)
  @foreach($user->mealrecords as $mealrecord)
  <div class="container mt-3 mx-2 border">
    <div class="d-flex justify-content-start">
      <div class="my-box w-25">{{$user->name}}</div>
      <div class="my-box w-25">朝食</div>
      <div class="my-box w-25">{{$mealrecord->eat_date}}{{$mealrecord->eat_time}}</div>
      <div class="my-box w-25">{{$mealrecord->eat_place}}</div>
    </div>
    <div class="row">
      <div class="col-7 mt-3">
      @foreach($mealrecord->mealPhotos as $meal_photo)

      @endforeach
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
          @foreach($mealrecord->mealPhotos as $meal_photo)
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$meal_photo->photo_num - 1}}" class="active" aria-current="true" aria-label="Slide {{$meal_photo->photo_num}}"></button>
            @endforeach
          </div>
          <div class="carousel-inner">
            @foreach($mealrecord->mealPhotos as $meal_photo)
            <div class="carousel-item">
              <img src="{{ url('/images/'. $meal_photo->photo_path)}}" class="d-block w-100" alt="/images/upload.png">
            </div>
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="col-5 mt-3">
        <table class="table display-none">
        @foreach($mealrecord->mealDetails as $meal_detail)
          <tr>
              <td>{{$meal_detail->food}}</td>
              <td>{{$meal_detail->ingredient}}</td>
              <td>{{$meal_detail->amount}}</td>
          </tr>
          @endforeach
        </table>
        <div>
        {{$mealrecord->memo}}
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @endforeach

  <a class="mt-5 btn btn-secondary" href="/project/index">一覧に戻る</a>




</div>

@endsection