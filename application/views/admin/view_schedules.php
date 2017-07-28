<div id="wrapper">

    <!-- Navigation -->
    <?php include 'navigation.php'; ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <?php echo $this->session->userdata('msg');
        $this->session->unset_userdata('msg');
        ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                View Schedules
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline"
                                   id="dataTables-example" role="grid" aria-describedby="dataTables-example_info"
                                   style="width: 100%;" width="100%">
                                <thead>
                                    <tr role="row">
                                        <th>Day</th>
                                        <th>Time</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($sch as $row): ?>
                                        <tr class="gradeA odd" role="row">
                                            <td><?php echo $row['day']; ?></td>
                                            <td><?php echo date('h:i A', strtotime($row['time'])); ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['description']; ?></td>
                                            <td>
                                                <a href="<?php echo base_url() . 'admin/editSchedule/' . bin2hex($row['id']); ?>" title="edit">
                                                    <i class="fa fa-edit"></i>
                                                </a> |
                                                <a href="<?php echo base_url() . 'admin/deleteSchedule/' . bin2hex($row['id']); ?>" title="delete">
                                                    <i class="fa fa-remove" style="color: #880000"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

                        <!-- /.panel-body -->
                    </div>

                </div>
                <!-- /#page-wrapper -->

            </div><!-- /#wrapper -->