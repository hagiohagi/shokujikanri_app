@extends('layouts.app')

@section('content')
<div class="container">
@csrf
  <div class="p-3 my-3 text-center" style="background-color:#f5f5f5">
    <a href="#" class="h2 text-dark "><u>調査に関する注意</u></a>
  </div>

  @foreach($meals as $meal)
  <div class="container mt-3 mx-2 border">
  <div class="my-box w-25">{{$meal->meal_type}}</div>
  <div class="col-7 mt-3">col-7</div>
    <div class="d-flex justify-content-start">
      <div class="my-box w-25">{{$meal->meal_date}}{{$meal->meal_time}}</div>
      <div class="my-box w-25">{{$meal->eat_place}}</div>
    </div>
  </div>
  @endforeach

    <a href="/upload">
      <input type="button" class="mt-5 btn btn-secondary col-sm-2" value="回答を追加する">
    </a>
  
  </div>
@endsection