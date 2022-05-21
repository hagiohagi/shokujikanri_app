@extends('layouts.app')

@section('content')
<div class="container">
  <ul class="nav nav-tabs bg-light ">
    <li class="nav-item"><a class="nav-link" href="/admin/project">調査一覧</a></li>
    <li class="nav-item "><a class="nav-link" href="/admin/user">ユーザー一覧</a></li>
  </ul>
@csrf
  <div class="p-3 my-3 text-center" style="background-color:#f5f5f5">
  {{ $user->name }}さんの投稿
  </div>
  @foreach($meals as $meal)
  <a href="/admin/user/{{ $user->id }}/edit/{{ $meal->meal_id }}">
  <div class="container m-3 pt-3 border mx-auto">

  @if($meal->meal_type == 1)
  <div class="badge bg-primary text-white">朝食</div>
  @elseif($meal->meal_type == 2)
  <div class="badge bg-success text-white">昼食</div>
  @elseif($meal->meal_type == 3)
  <div class="badge bg-info">間食</div>
  @elseif($meal->meal_type == 4)
  <div class="badge bg-danger text-white">夕食</div>
  @elseif($meal->meal_type == 5)
  <div class="badge bg-dark text-white">夜食</div>
  @endif

    <div id="carouselExample" class="carousel-dark slide mt-3 mx-auto" data-bs-ride="carousel" style="width:18rem">
        
        <div class="carousel-inner">
          @foreach($meal->mealPhotos as $meal_photo)
          @if($loop->first)
          <div class="carousel-item active">
            <img src="{{ url('/get_request_image/'. $meal_photo->photo_path)}}" class="d-block w-100" alt="...">
          </div>
          @endif
          @endforeach
          
          </div>
        </div>
        
      </a>
      <div class="d-flex justify-content-end">
        <div class="my-box w-50">{{$meal->eat_date}} {{$meal->eat_time}}</div>
        <div class="my-box w-25">{{$meal->eat_place}}</div>
      </div>
    </div>
  </div>
  @endforeach
  <div class="d-flex">
    <a href="/admin/user">
    <input type="button" class="m-2 btn btn-secondary" style="width:200px" value="一覧に戻る">
  </a>
    <a href="/admin/user/{{ $user->id }}/upload">
      <input type="button" class="m-2 btn btn-secondary" style="width:200px" value="回答を追加する">
    </a>
  </div>
  
  </div>
@endsection