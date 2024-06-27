<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"><img src="<?php echo e(url('images/logo.png')); ?>" alt="Logo"></a>
            <a class="navbar-brand hidden" href="./"><img src="<?php echo e(url('images/logo2.png')); ?>" alt="Logo"></a>
            
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">
                

            

   
            </div>

            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php if(Auth::user()->avatar): ?>
                    <img class="user-avatar rounded-circle" src="<?php echo e(url('files/users/'.Auth::id()."/200".Auth::user()->avatar)); ?>" alt="User Avatar">
                    
                    <?php else: ?>
                    <img class="user-avatar rounded-circle" src="<?php echo e(url('images/user-thumbnail.png')); ?>" alt="User Avatar">
                    <?php endif; ?>
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="#"><i class="fa fa- user"></i>My Profile</a>

                    <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count"></span></a>
                 
                    <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a>

                    <form class="form" id="logout-form" name="logout-form" action="<?php echo e(route('logout')); ?>"
                    method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" id="_token" value="<?php echo e(csrf_token()); ?>">
                    <a class="nav-link" href="#" onclick="logoutfx()"><i class="fa fa-power -off"></i>Logout</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</header><?php /**PATH /home/vagrant/code/tmdb_project/resources/views/panel/partials/header.blade.php ENDPATH**/ ?>