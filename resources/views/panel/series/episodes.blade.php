<div id="accordion-episode" class="accordion">
   
    @php  $count = 0;
    @endphp
 
@foreach($episodes as $episode)
@php 
  
$collapsed = ($count ==0 )?"show":"";
$count++;
$s = ($episode->season()->first()->season_number < 10)?"0".$episode->season()->first()->season_number:$episode->season()->first()->season_number;
$e = ($episode['episode_number'] < 10)?"0".$episode['episode_number']:$episode['episode_number'];
@endphp
<div class="card">
    <div class="card-header" id="heading-episode{{$count}}">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-episode{{$count}}" aria-expanded="true" aria-controls="collapse-episode{{$count}}">
          {{$episode['name']}}  S{{$s}}E{{$e}}
        </button>
      </h5>
    </div>

    <div id="collapse-episode{{$count}}" class="collapse {{$collapsed}}" aria-labelledby="heading-episode{{$count}}" data-parent="#accordion-episode">
      <div class="card-body">
          <div class="row">
              <div class="col-md-3"> 
                  @if($episode['still_path'])
                  <img src="https://image.tmdb.org/t/p/w500{{ $episode['still_path'] }}" class="series-img" alt="{{ $episode['name'] }}"></td>
                  @endif
                  <hr>
                 
                   

              </div>
              <div class="col-md-9">
                  <div class="row"> <div class="col-md-4"><b>ID</b></div><div class="col-md-8">{{$episode['id']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Name</b></div><div class="col-md-8">{{$episode['name']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Episode Number</b></div><div class="col-md-8">{{$episode['episode_number']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Episode Type</b></div><div class="col-md-8">{{$episode['episode_type']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Vote Average</b></div><div class="col-md-8">{{$episode['vote_average']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Vote Count</b></div><div class="col-md-8">{{$episode['vote_count']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Runtime</b></div><div class="col-md-8">{{$episode['runtime']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Overview</b></div><div class="col-md-8">{{$episode['overview']}}</div> </div>
                  <div class="row"> <div class="col-md-4"><b>Air Date</b></div><div class="col-md-8">{{ Carbon\Carbon::parse($episode['air_date'])->format('d.m.Y')}}</div> </div>
              </div>                    



          </div>
          
    </div>
  </div>
  </div>
@endforeach

</div>