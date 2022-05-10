@extends('layouts.researchers')

@section('content')
<div class="container">
@csrf
  
<div class="row">
      <div class="col-7 mt-3">col-7</div>
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
@endsection