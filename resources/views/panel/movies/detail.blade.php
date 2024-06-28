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
                           MOVIE DETAIL : {{$movie->original_title}}
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                                <a href="{{route('movie-list')}}">Back  <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></a>
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
                                   <div class="col-md-4"> 
                                    @if($movie['poster_path'])
                                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="movie-img" alt="{{ $movie['title'] }}"></td>
                                    @endif
                                    <hr>
                                    @if($movie['backdrop_path'])
                                    <img src="https://image.tmdb.org/t/p/w500{{ $movie['backdrop_path'] }}" class="movie-img" alt="{{ $movie['title'] }}"></td>
                                    @endif
                                   </div> 
                                   
                                   
                                   <div class="col-md-8">
                                        <div class="row"> <div class="col-md-2"><b>ID</b></div><div class="col-md-10">{{$movie['id']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Title</b></div><div class="col-md-10">{{$movie['title']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Adult</b></div><div class="col-md-10">@if($movie['adult']) Yes @else No @endif</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Original Title</b></div><div class="col-md-10">{{$movie['original_title']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Language</b></div><div class="col-md-10">{{$movie['original_language']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Popularity</b></div><div class="col-md-10">{{$movie['popularity']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Vote Count</b></div><div class="col-md-10">{{$movie['vote_count']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Vote Average</b></div><div class="col-md-10">{{$movie['vote_average']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Release Date</b></div><div class="col-md-10">{{ Carbon\Carbon::parse($movie['release_date'])->format('d.m.Y')}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Overview</b></div><div class="col-md-10">{{$movie['overview']}}</div> </div>
                                        <div class="row"> <div class="col-md-2"><b>Genres</b></div><div class="col-md-10">
                                            @foreach($movie->genres()->get() as $genre) 
                                            {{$genre['name']}}<br>
                                        @endforeach    
                                        </div> </div>
                                        
                                        

                                    </div> 

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
