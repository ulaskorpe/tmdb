@extends('panel.main_layout');

@section('css-section')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
 
@endsection
@section('main')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                           SERIES DETAIL : {{$series->original_title}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                                <a href="{{route('series-list')}}">Back  <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                   <div class="col-md-3"> 
                                    @if($series['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w500{{ $series['poster_path'] }}" class="series-img" alt="{{ $series['title'] }}"></td>
                                    @endif
                                    <hr>
                                    @if($series['backdrop_path'])
                                    <img src="https://image.tmdb.org/t/p/w500{{ $series['backdrop_path'] }}" class="series-img" alt="{{ $series['title'] }}"></td>
                                    @endif
                                   </div> 
                                   
                                   
                                   <div class="col-md-9">
                                        <div class="row"> <div class="col-md-3"><b>ID</b></div><div class="col-md-9">{{$series['id']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Name</b></div><div class="col-md-9">{{$series['name']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Adult</b></div><div class="col-md-9">@if($series['adult']) Yes @else No @endif</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Original Name</b></div><div class="col-md-9">{{$series['original_name']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Origin Countries</b></div><div class="col-md-9">{{$series['origin_countries']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Language</b></div><div class="col-md-9">{{$series['original_language']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Popularity</b></div><div class="col-md-9">{{$series['popularity']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Vote Count</b></div><div class="col-md-9">{{$series['vote_count']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Vote Average</b></div><div class="col-md-9">{{$series['vote_average']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>First Air Date</b></div><div class="col-md-9">{{ Carbon\Carbon::parse($series['first_air_date'])->format('d.m.Y')}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Overview</b></div><div class="col-md-9">{{$series['overview']}}</div> </div>
                                        <div class="row"> <div class="col-md-3"><b>Genres</b></div><div class="col-md-9">
                                            @foreach($series->genres()->get() as $genre) 
                                            {{$genre['name']}}<br>
                                        @endforeach    
                                        </div> 
                                     

                                    </div>
                                        
                                        

                                    </div> 

                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-5">
                                        @include("panel.series.seasons")
                                </div>
                        </div>

                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('scripts')
    
@endsection
