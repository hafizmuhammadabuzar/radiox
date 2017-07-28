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
                <?php $url = (isset($sch)) ? 'updateSchedule' : 'saveSchedule';
                echo $page = (isset($sch)) ? 'Edit' : 'New'; ?> Schedule
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url().'admin/'.$url; ?>" method="post">
                            <div class="form-group">
                                <label>Day*</label>
                                <select class="form-control" name="day" required="required">
                                    <option value="">-- Select Day --</option>
                                    <option value="Sunday" <?php if($sch->day == 'Sunday') echo 'selected="selected"' ?>>Sunday</option>
                                    <option value="Monday" <?php if($sch->day == 'Monday') echo 'selected="selected"' ?>>Monday</option>
                                    <option value="Tuesday" <?php if($sch->day == 'Tuesday') echo 'selected="selected"' ?>>Tuesday</option>
                                    <option value="Wednesday" <?php if($sch->day == 'Wednesday') echo 'selected="selected"' ?>>Wednesday</option>
                                    <option value="Thursday" <?php if($sch->day == 'Thursday') echo 'selected="selected"' ?>>Thursday</option>
                                    <option value="Friday" <?php if($sch->day == 'Friday') echo 'selected="selected"' ?>>Friday</option>
                                    <option value="Saturday" <?php if($sch->day == 'Saturday') echo 'selected="selected"' ?>>Saturday</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Time*</label>
                                <input class="form-control" name="time" value="<?php if(!empty($sch->time)) echo date('h:i A', strtotime($sch->time)); ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Title*</label>
                                <input class="form-control" name="title" value="<?php echo $sch->title; ?>" required="required">
                            </div>
                            <div class="form-group">
                                <label>Detail*</label>
                                <input class="form-control" name="description" value="<?php echo $sch->description; ?>" required="required">
                            </div>
                            <?php if(isset($sch)){ ?>
                            <input type="hidden" name="sch_id" value="<?php echo bin2hex($sch->id); ?>">
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
