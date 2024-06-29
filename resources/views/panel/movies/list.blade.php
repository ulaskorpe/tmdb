@extends('panel.main_layout');

@section('css-section')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        .movie-img {
            width: 300px;
            height: auto;
        }
        </style>
@endsection
@section('main')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                           
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            MOVIES
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
                            <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Poster</th>
                                        <th>TMDB ID </th>
                                        <th>Title </th>
                                        <th>Genres</th>
                                        <th>Language</th>
                                        <th>Release Date</th>
                                        <th>Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                 @foreach($movies as $movie)
                                 <tr style="cursor:pointer" onclick="window.open('/admin-panel/movies/detail/{{$movie['slug']}}','_self')">
                                   
                                    <td>
                                        @if($movie['poster_path'])
                                        <img src="https://image.tmdb.org/t/p/w500{{ $movie['poster_path'] }}" class="movie-img" alt="{{ $movie['title'] }}"></td>
                                        @endif
                                    </td>
                                    <td>{{$movie['id']}}</td>
                                    <td>{{$movie['original_title']}}</td>
                                    <td>
                                            @foreach($movie->genres()->get() as $genre) 
                                                {{$genre['name']}}<hr>
                                            @endforeach

                                    </td>
                                    <td>{{$movie['original_language']}}</td>
                                    <td>{{ Carbon\Carbon::parse($movie['release_date'])->format('d.m.Y')}}</td>
                                        <td>Vote Count : {{$movie['vote_count']}}<br>
                                            Average : {{$movie['vote_average']}}
                                        </td>
                            
                             
                            </tr>
                                 @endforeach
                               
                                
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div><!-- .content -->
@endsection

@section('scripts')
    @include("panel.partials.datatable_scripts")
 

 

     
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });

        
    </script>
@endsection
