

<?php $__env->startSection('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="card">

            <div class="card-body">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Resim</th>
                            <th>Başlık </th>
                            <th>Kategori</th>
                            <th>Yazar</th>
                            
                           
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                     <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <tr>
                        <td>

                            <form id="deleteform<?php echo e($blog['id']); ?>"
                                action=" <?php echo e(route('blogs-delete')); ?>" method="POST">
                                <input type="hidden" name="_token" id="_token"
                                    value="<?php echo e(csrf_token()); ?>">
                                <input type="hidden" name="id" id="id"
                                    value="<?php echo e($blog['id']); ?>">
                            </form>

                          
                            <?php if(!empty($blog['icon'])): ?>
                            <div class="form-group" id="avatar_pic">
                                <div class="input-group">
                                   <img src="<?php echo e(url("files/blogs/".$blog['slug']."/".$blog['icon'])); ?>" style="width:100px">
                                </div>
                            </div>
                            <?php endif; ?>
                    </td>
                    <td><b><?php echo e($blog['title']); ?></b><br>
                    
                    <?php echo e(substr($blog['prologue'],0,50)); ?>

                    </td>
                    <td><?php echo e($blog->category()->first()->name); ?></td>
                    <td><?php echo e($blog->user()->first()->name); ?></td>
                    
                    
             
                
                    <td style="width: 200px">


                        <button type="button" class="btn btn-primary"
                            onclick="window.open('<?php echo e(route('blog_show',[$blog['slug'],$blog['id']])); ?>','_self')">Görüntüle</button>

 

                    </td>
                </tr>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                    
                    </tbody>
                </table>
            </div>

        </div>
    </div>


</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <?php echo $__env->make("partials.datatable_scripts", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 

 

     
    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });

       
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/vagrant/code/tmdb_project/resources/views/index.blade.php ENDPATH**/ ?>