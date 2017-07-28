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
        <?php echo validation_errors(); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <?php $url = (isset($track)) ? 'updateTrack' : 'saveTrack';
                echo $page = (isset($track)) ? 'Edit' : 'New'; ?> Track
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url().'admin/'.$url; ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Title*</label>
                                <input class="form-control" name="title" value="<?php echo $track->title; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Movie*</label>
                                <input class="form-control" name="movie" value="<?php echo $track->movie; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Song*</label>
                                <input class="form-control" name="song" value="<?php echo $track->song; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>URL*</label>
                                <input class="form-control" name="url" value="<?php echo $track->url; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Last Week Position*</label>
                                <input class="form-control" name="last_week_position" value="<?php echo $track->last_week_position; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Weeks on Chart*</label>
                                <input class="form-control" name="weeks_on_chart" value="<?php echo $track->weeks_on_chart; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Peak Position*</label>
                                <input class="form-control" name="peak_position" value="<?php echo $track->peak_position; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Thumbnail*</label>
                                <input type="file" class="form-control" name="thumbnail" value="<?php echo $track->image; ?>">
                            </div>
                            <?php if(!empty($track->image)): ?>
                            <img src="<?php echo base_url().'assets/uploads/'.$track->image; ?>" width="100" height="100" />
                            <?php endif; ?>
                            <div class="form-group">
                                <label>Sort*</label>
                                <input class="form-control" name="sort" value="<?php echo $track->sort; ?>" required="required">
                            </div>
                            <?php if(isset($track)){ ?>
                            <input type="hidden" name="track_id" value="<?php echo bin2hex($track->id); ?>">
                            <input type="hidden" name="old_thumbnail" value="<?php echo $track->image; ?>">
                            <?php } ?>
                            <br/>
                            <button type="submit" class="btn btn-default" name="add">Submit</button>
                        </form>
                    </div>
                </div>
                <!-- /.row (nested) -->
            </div>
            <!-- /.panel-body -->
        </div>

    </div>
    <!-- /#page-wrapper -->

</div><!-- /#wrapper -->
