<?php require_once 'header.php';?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
            	<br>
            	<?php if($this->session->flashdata('success')): ?>
                        	<div class="alert alert-danger">
                                <?php echo $this->session->flashdata('success'); ?>
                            </div>
				<?php endif; ?>
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Projects</h1>
                        <div style="float: right; margin-bottom: 30px">
                        	<button type="button" onclick="javascript: document.location = '<?php echo base_url(); ?>admin/add_project';" class="btn btn-outline btn-primary btn-lg">Add Project</button>
                        </div>
                    </div>
                    <!-- /.col-lg-12 -->
                    
                    <div class="row">
                
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Users
                        </div>
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Order</th>
                                            <th>Link</th>
                                            <th>Likes</th>
                                            <th>Active</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach ($rows as $row) { ?>
                                    	<tr>
                                            <td><?php echo $row["id"]; ?></td>
                                            <td><?php echo $row["name"]; ?></td>
                                            <td><?php echo $row["image"]; ?></td>
                                            <td><?php echo $row["order"]; ?></td>
                                            <td><?php echo $row["link"]; ?></td>
                                            <td><?php echo $row["num_likes"]; ?></td>
                                            <td><?php echo $row["active"]; ?></td>
                                            <td>
                                            <a href="<?php echo base_url(); ?>admin/projects_photos/<?php echo $row['id']?>">Capture Images</a>
                                            </td>
                                            <td>
                                            <a href="<?php echo base_url(); ?>admin/edit_project/<?php echo $row['id']?>">Edit</a>
                                            </td>
                                            <td>
                                            <a href="<?php echo base_url(); ?>admin/delete_project/<?php echo $row['id']?>">Delete</a>
                                            </td>
                                        </tr>
                                    	<?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
<?php require_once 'footer.php';?>
