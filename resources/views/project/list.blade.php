@extends('layouts.researchers')

@section('content')

<div class="container">
@csrf
  <div class="row mt-3">
    <div class="col-5 h2">{{ $survey_info->survey_name ?? '' }}</div>
    <div class="col-5 h3">調査対象期間:{{ $survey_info->term ?? '' }}</div>
  </div>

  <div class="row">
    <form method="GET" action="/project/list/{{ $survey_info->survey_id }}/search">
    <div class="form-group form-inline mx-2 mt-3">
        <label class="control-label">
        絞込み：
        </label>
        <select class="form-control" name="user_name">
          <option value="">絞り込みなし</option>
          @foreach($survey_info->users as $user)
            <option value="{{$user->name}}" @if(request()->get('user_name') == $user->name) selected @endif>{{$user->name}}</option>
          @endforeach
        </select>
     
      </div>
      <div class="form-group form-inline mx-2 mt-3">
        <label class="control-label">
        並び替え：
        </label>
          <select class="form-control" name="survey_sort">
            <option value="1" @if(request()->get('survey_sort') == 1 ?? null) selected @endif>日付の新しい順</option>
            <option value="2" @if(request()->get('survey_sort') == 2) selected @endif>日付の古い順</option>
            <option value="3" @if(request()->get('survey_sort') == 3) selected @endif>あいうえお順</option>
        </select>
      </div>
      <button type="submit" class="btn-sm btn-secondary mx-2 mt-3">表示を変更</button>
    </form>
  </div>

  @foreach($users as $user)
  @foreach($user->mealrecords as $mealrecord)
  <div class="container mt-3 mx-2 border">
    <div class="d-flex justify-content-start">
      <div class="col-1">{{$user->name}}</div>
      <div class="col-1">
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
      <div class="col-1">{{$mealrecord->eat_place}}</div>
      <div class="col-1 offset-6">
        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#FullModal-{{$mealrecord->meal_id}}">
          拡大する
        </button>
        <div class="modal fade" id="FullModal-{{$mealrecord->meal_id}}" tabindex="-1" aria-labelledby="FullModal-{{$mealrecord->meal_id}}Label" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <!-- 以下モーダル -->
                        <div class="modal-body">
                        <div class=" container-fluid d-flex justify-content-start">
                          <div class="col-1">{{$user->name}}</div>
                          <div class="col-1">
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
                          <div class="col-1">{{$mealrecord->eat_place}}</div>
                        </div>
                          <div class="row">
                            <div class="col-8 mt-3">
                            <div id="carouselExampleIndicators-{{$mealrecord->meal_id}}" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                @foreach($mealrecord->mealPhotos as $meal_photo)
                                  <button type="button" data-bs-target="#carouselExampleIndicators-{{$mealrecord->meal_id}}" data-bs-slide-to="{{$meal_photo->photo_num - 1}}" class="active" aria-current="true" aria-label="Slide {{$meal_photo->photo_num}}"></button>
                                  @endforeach
                                </div>
                                <div class="carousel-inner">
                                  @foreach($mealrecord->mealPhotos as $meal_photo)
                                  <div class="carousel-item @if($loop->first) active @endif" data-interval="5000000">
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
                    <div class="col-4 mt-3">
                    <div class="row">
                      @foreach($mealrecord->mealDetails as $meal_detail)
                        <div class="col-4 text-wrap"><pre>{{$meal_detail->food}}</pre></div>
                        <div class="col-4 text-wrap"><pre>{{$meal_detail->ingredient}}</pre></div>
                        <div class="col-4 text-wrap"><pre>{{$meal_detail->amount}}</pre></div>
                    @endforeach
                      </div>
                  </table>
                      <div class="text-wrap">
                        <pre>{{$mealrecord->memo}}</pre>
                      </div>
                    </div>
                  </div>
                </div>
                

              <!-- 以上モーダル -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-7 mt-3">
      <div id="carouselExampleIndicators2-{{$mealrecord->meal_id}}" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
          @foreach($mealrecord->mealPhotos as $meal_photo)
            <button type="button" data-bs-target="#carouselExampleIndicators2-{{$mealrecord->meal_id}}" data-bs-slide-to="{{$meal_photo->photo_num - 1}}" class="active" aria-current="true" aria-label="Slide {{$meal_photo->photo_num}}"></button>
            @endforeach
          </div>
          <div class="carousel-inner">
            @foreach($mealrecord->mealPhotos as $meal_photo)
            <div class="carousel-item @if($loop->first) active @endif" data-interval="5000000">
              <img src="{{ url('/images/'. $meal_photo->photo_path)}}" class="d-block w-100" alt="{{ url('/images/'. $meal_photo->photo_path)}}">
            </div>
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2-{{$mealrecord->meal_id}}" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2-{{$mealrecord->meal_id}}" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="false"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="col-5 mt-3">
        <div class="row">
        @foreach($mealrecord->mealDetails as $meal_detail)
          <div class="col-4 text-wrap"><pre>{{$meal_detail->food}}</pre></div>
          <div class="col-4 text-wrap"><pre>{{$meal_detail->ingredient}}</pre></div>
          <div class="col-4 text-wrap"><pre>{{$meal_detail->amount}}</pre></div>
      @endforeach
        </div>
    </table>
        <div class="text-wrap">
          <pre>{{$mealrecord->memo}}</pre>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  @endforeach

  <a class="mt-5 btn btn-secondary" href="/project/index">一覧に戻る</a>




</div>

@endsection