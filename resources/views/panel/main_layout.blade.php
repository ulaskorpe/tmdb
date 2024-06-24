<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
@include('panel.partials.head')

<body>
    @include('panel.partials.left_menu')

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        @include('panel.partials.header')

        <!-- /#header -->
        <!-- Content -->
         
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">



                @yield("main")
             
                @include("panel.partials.modals");
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        @include("panel.partials.footer")
    
    </div>
    <!-- /#right-panel -->
     @include('panel.partials.scripts')
    <!--Local Stuff-->
    @yield("scripts")

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
