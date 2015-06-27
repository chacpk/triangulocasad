<?php require_once 'header.php';?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Projects Photos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add Project Photo
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                <form role="form" enctype="multipart/form-data" method="post" id="validate-form">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input class="form-control validate[required]" type="file" name="image" id="image">
                                        </div>
                                        <div class="form-group">
                                            <label>Order</label>
                                            <input class="form-control validate[required, custom[number]]" type="text" name="order" id="order" placeholder="Order">
                                        </div>
                                        <div class="form-group">
                                            <label class="checkbox-inline">
                                                <input name="active" id="active" type="checkbox" checked="checked" disabled="disabled">Activo
                                            </label>
                                        </div>
                                        <input type="hidden" name="hdd_project_id" id="hdd_project_id" value="<?php echo $project_id; ?>">
                                        
                                        <button type="submit" class="btn btn-default">Save</button>
                                        <button type="reset" class="btn btn-default">Reset</button>
                                    </form>
                                </div>
                           </div> 
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
