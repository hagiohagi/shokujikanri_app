@extends('layouts.admin')

@section('content')
<div class="container">
<ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>
  @csrf
  <div class="row mt-3">
    <div class="col-5 h2">{{ $survey_info->survey_name }}</div>
    <div class="col-5 h3">調査対象期間:{{ $survey_info->term }}</div>
  </div>

  <div class="row">
  <div class="form-group form-inline mx-2 mt-3">
        <label class="control-label">
        絞込み：
        </label>

        <select class="form-control" name="user_name">
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
          <select class="form-control" name="survey_sort">
            <option value="1" @if($request->sort == 1) selected @endif>あいうえお順</option>
            <option value="2" @if($request->sort == 2) selected @endif>日付の新しい順</option>
            <option value="3" @if($request->sort == 3) selected @endif>日付の古い順</option>
        </select>
        <!-- @error('')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror -->
      </div>
  </div>

  @foreach($survey_info->users as $user)
  @foreach($user->mealrecords as $mealrecord)
  <div class="container mt-3 mx-2 border">
    <div class="d-flex justify-content-start">
      <div class="col-2">{{$user->name}}</div>
      <div class="col-2">
        @if($mealrecord->meal_type == 1)
        <div class="badge bg-primary text-white">朝食</div>
        @elseif($mealrecord->meal_type == 2)
        <div class="badge bg-success text-white">昼食</div>
        @elseif($mealrecord->meal_type == 3)
        <div class="badge bg-info">間食</div>
        @elseif($mealrecord->meal_type == 4)
        <div class="badge bg-danger text-white">夕食</div>
        @elseif($mealrecord->meal_type == 5)
        <div class="badge bg-dark text-white">夜食</div>
        @endif
      </div>
      <div class="col-2">{{$mealrecord->eat_date}}&nbsp;{{$mealrecord->eat_time}}</div>
      <div class="col-2">{{$mealrecord->eat_place}}</div>
    </div>
    <div class="row">
      <div class="col-7 mt-3">
      @foreach($mealrecord->mealPhotos as $meal_photo)

      @endforeach
      <div id="carouselExampleIndicators-{{$mealrecord->meal_id}}" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
          @foreach($mealrecord->mealPhotos as $meal_photo)
            <button type="button" data-bs-target="#carouselExampleIndicators-{{$mealrecord->meal_id}}" data-bs-slide-to="{{$meal_photo->photo_num - 1}}" class="active" aria-current="true" aria-label="Slide {{$meal_photo->photo_num}}"></button>
            @endforeach
          </div>
          <div class="carousel-inner">
            @foreach($mealrecord->mealPhotos as $meal_photo)
            <div class="carousel-item @if($loop->first) active @endif data-interval="50000">
              <img src="{{ url('/images/'. $meal_photo->photo_path)}}" class="d-block w-100" alt="{{ url('/images/'. $meal_photo->photo_path)}}">
            </div>
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators-{{$mealrecord->meal_id}}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators-{{$mealrecord->meal_id}}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="col-5 mt-3">
        <table class="table display-none">
        @foreach($mealrecord->mealDetails as $meal_detail)
          <tr>
              <td><pre>{{$meal_detail->food}}</pre></td>
              <td><pre>{{$meal_detail->ingredient}}</pre></td>
              <td><pre>{{$meal_detail->amount}}</pre></td>
          </tr>
          @endforeach
        </table>
        <div>
          <pre>{{$mealrecord->memo}}</pre>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @endforeach

  <a class="mt-5 btn btn-secondary" href="/admin/project">一覧に戻る</a>




</div>

@endsection