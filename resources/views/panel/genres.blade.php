@extends('panel.main_layout');

@section('css-section')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <style>
        .movie-img {
            width: 200px;
            height: 300px;
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
                                         
                                        <th>TMDB ID </th>
                                        <th>Title </th>
                                         
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                 @foreach($genres as $genre)
                                 <tr >
                                   
                                    <td style="width: 10%">{{$genre['id']}}</td>
                                    <td>{{$genre['name']}}</td>
                                     
                            
                             
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

        function deletemovie(id) {
            Swal.fire({
                text: 'movie silinecek, emin misin?',
                //text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {

                if (result.isConfirmed) {
                     
                    $('#deleteform' + id).submit();
                       
                }
            });
        }
    </script>
@endsection