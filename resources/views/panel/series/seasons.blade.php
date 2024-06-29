<div id="accordion" class="accordion">
    @php
 
 
    $count = 0;
    @endphp
    @foreach($seasons as $season )
    @php 
  
    $collapsed = ($count ==0 )?"show":"";
    $count++;
    @endphp
    <div class="card">
      <div class="card-header" id="heading{{$count}}">
        <h5 class="mb-0">
          <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$count}}" aria-expanded="true" aria-controls="collapse{{$count}}">
            {{$season['name']}} 
          </button>
        </h5>
      </div>
  
      <div id="collapse{{$count}}" class="collapse {{$collapsed}}" aria-labelledby="heading{{$count}}" data-parent="#accordion">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3"> 
                    @if($season['poster_path'])
                    <img src="https://image.tmdb.org/t/p/w500{{ $season['poster_path'] }}" class="series-img" alt="{{ $season['name'] }}"></td>
                    @endif
                    <hr>
                   
                     

                </div>
                <div class="col-md-9">
                    <div class="row"> <div class="col-md-4"><b>ID</b></div><div class="col-md-8">{{$season['id']}}</div> </div>
                    <div class="row"> <div class="col-md-4"><b>Name</b></div><div class="col-md-8">{{$season['name']}}</div> </div>
                    <div class="row"> <div class="col-md-4"><b>Episode Count</b></div><div class="col-md-8">{{$season['episode_count']}}</div> </div>
                    <div class="row"> <div class="col-md-4"><b>Vote Average</b></div><div class="col-md-8">{{$season['vote_average']}}</div> </div>
                    <div class="row"> <div class="col-md-4"><b>Overview</b></div><div class="col-md-8">{{$season['overview']}}</div> </div>
                    <div class="row"> <div class="col-md-4"><b>Air Date</b></div><div class="col-md-8">{{ Carbon\Carbon::parse($season['air_date'])->format('d.m.Y')}}</div> </div>
                </div>                    



            </div>
            <div class="row">
              <div class="col-12 text-center">
                  <button class="btn btn-primary" id="show{{$season['id']}}" onclick="showEpisodes({{$season['id']}})">Show Episodes</button>
                  <button class="btn btn-primary" id="hide{{$season['id']}}"  onclick="hideEpisodes({{$season['id']}})" style="display: none">Hide Episodes</button>
              </div>
          </div>
          <div class="row">
            <div class="col-12" id="episodes_div{{$season['id']}}" style="background: ergb(198, 201, 188)">
          
            </div>
          </div>
      </div>
    </div>
    </div>
    @endforeach
    
  </div>

  <script>
    function showEpisodes(season_id){
       
      $.get( "/admin-panel/series/episode-list/"+season_id, function( data ) {
          $( "#episodes_div"+season_id ).html( data);
     
      });
      $('#hide'+season_id).show();
      $('#show'+season_id).hide();
    }

    function hideEpisodes(season_id){
      $( "#episodes_div"+season_id ).html('');
      $('#hide'+season_id).hide();
      $('#show'+season_id).show();
    }
    
    </script>