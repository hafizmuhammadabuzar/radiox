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
                View Tracks
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
                                        <th>Sort</th>
                                        <th>Title</th>
                                        <th>Movie</th>
                                        <th>Song</th>
                                        <th>URL</th>
                                        <th>LWP</th>
                                        <th>WOC</th>
                                        <th>PP</th>
                                        <th>Thumbnail</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($tracks as $row): ?>
                                        <tr class="gradeA odd" role="row">
                                            <td><?php echo $row['sort']; ?></td>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['movie']; ?></td>
                                            <td><?php echo $row['song']; ?></td>
                                            <td><?php echo $row['url']; ?></td>
                                            <td><?php echo $row['last_week_position']; ?></td>
                                            <td><?php echo $row['weeks_on_chart']; ?></td>
                                            <td><?php echo $row['peak_position']; ?></td>
                                            <td>
                                            <?php if(!empty($row['image'])): ?>
                                                <img src="<?php echo base_url(); ?>assets/uploads/<?php echo $row['image']; ?>" alt="image" width="100" height="100" />
                                            <?php else: 
                                                $image = substr($row['url'], -11, 11);
                                            ?>
                                                <img src="https://img.youtube.com/vi/<?php echo $image; ?>/hqdefault.jpg" alt="image" width="100" height="100" />
                                            <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url() . 'admin/editTrack/' . bin2hex($row['id']); ?>" title="edit">
                                                    <i class="fa fa-edit"></i>
                                                </a> |
                                                <a href="<?php echo base_url() . 'admin/deleteTrack/' . bin2hex($row['id']); ?>" title="delete">
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