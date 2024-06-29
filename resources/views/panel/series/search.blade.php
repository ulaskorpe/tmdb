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
                           SERIES SEARCH 
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
                            <div class="search-form">
                    
                                <form class="form" id="search-form" name="search-form" action="{{route('series-search-post')}}"
                                method="post" enctype="multipart/form-data">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                
                                    <div class="form-group">
                                        <label>Search For :</label>
                                        <input type="text" id="keyword" name="keyword" class="form-control" placeholder="Series name .. ">
                                    </div>
                              
                                    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Search</button>
                                  
                                </form>
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
