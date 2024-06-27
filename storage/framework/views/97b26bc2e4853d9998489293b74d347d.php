<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
<?php echo $__env->make('panel.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<body>
    <?php echo $__env->make('panel.partials.left_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <?php echo $__env->make('panel.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <!-- /#header -->
        <!-- Content -->
         
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">



                <?php echo $__env->yieldContent("main"); ?>
             
                <?php echo $__env->make("panel.partials.modals", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>;
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <?php echo $__env->make("panel.partials.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    </div>
    <!-- /#right-panel -->
     <?php echo $__env->make('panel.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--Local Stuff-->
    <?php echo $__env->yieldContent("scripts"); ?>

    <script>
        function logoutfx(){
            Swal.fire({
            title: 'Log out ?',
         
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'yes!',
            cancelButtonText: 'no'
        }).then((result) => {
            // If confirmed
            if (result.isConfirmed) {
                    $('#logout-form').submit();
            }
        });
        }
        </script>
</body>
</html>
<?php /**PATH /home/vagrant/code/tmdb_project/resources/views/panel/main_layout.blade.php ENDPATH**/ ?>