@extends('layouts.app')

@section('content')
<div class="container-fluid">
@csrf
  <div class="p-3 my-3 text-center" style="background-color:#f5f5f5">
    <a href="#" class="h2 text-dark "><u>調査に関する注意</u></a>
  </div>

  @foreach($meals as $meal)
  <a href="/edit/{{ $meal->meal_id }}">
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
        <!-- <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div> -->
        <div class="carousel-inner">
          @foreach($meal->mealPhotos as $meal_photo)
          @if($loop->first)
          <div class="carousel-item active">
            <img src="{{ asset('images/' . $meal_photo['photo_path'])}}" class="d-block w-100" alt="...">
            <!-- <div class="carousel-caption d-none d-md-block">
              <div class="h5">First slide</div>
              <p>This is first slide.</p>
            </div> -->
          </div>
          @endif
          @endforeach
          <!-- <div class="carousel-item">
            <img src="/images/jiko_computer_coffee_kobosu.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <div class="h5">Second slide</div>
              <p>This is seconde slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="/images/neochi_computer_women.png" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <div class="h5">Third slide</div>
              <p>This is third slide.</p>
            </div> -->
          </div>
        </div>
        <!-- <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button> -->
      </a>
      <div class="d-flex justify-content-end">
        <div class="my-box w-25">{{$meal->eat_date}} {{$meal->eat_time}}</div>
        <div class="my-box w-25">{{$meal->eat_place}}</div>
      </div>
    </div>
  </div>
  @endforeach

    <a href="/upload">
      <input type="button" class="m-5 btn btn-secondary col-sm-2" value="回答を追加する">
    </a>
  
  </div>
@endsection