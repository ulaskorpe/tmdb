<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
           

 
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true"> <i class="menu-icon fa fa-video-camera"></i>Movies</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list"></i><a href="{{ route( 'movie-list')}}">List Movies</a></li>
                        <li><i class="fa fa-search"></i><a href="{{ route('movie-search')}}">Find Movies</a></li>
                  
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="active dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="true"> <i class="menu-icon fa fa-video-camera"></i>Series</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-list"></i><a href="{{ route( 'series-list')}}">List Series  </a></li>
                        <li><i class="fa fa-search"></i><a href="{{ route( 'movie-list')}}">Find Series</a></li>
                  
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Genres</a>
                    <ul class="sub-menu children dropdown-menu">
                       
                        <li><i class="fa fa-list"></i><a href="{{route('genre-list','movie')}}">Movie Genres</a></li>
                        <li><i class="fa fa-list"></i><a href="{{route('genre-list','tv')}}">Series Genres</a></li>
                  
                    </ul>
                </li>
               

             
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
