<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" sizes="16x16">
	<title>Radio X Live</title>
	<!-- Include the libraries -->
	<script src="js/jquery.min.js"></script>
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/style.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    <div id="dialog" title="Success">
      <p>Email successfully sent, we will get back to you shortly.</p>
    </div>
    <form class="message" id="contact-form" method="POST" action="<?php echo base_url('message_us'); ?>">
        <span>
            <?php echo $this->session->userdata('msg'); $this->session->unset_userdata('msg');
            echo $this->session->userdata('error'); $this->session->unset_userdata('error'); ?>
        </span>
        <div class="inputBox">
            <label>Name:</label>
            <input type="text" id="name" name="name" />
        </div>
        <div class="inputBox">
            <label>Mobile:</label>
            <input type="tel" id="mobile" name="mobile" />
        </div>
        <div class="inputBox">
            <label>Email:</label>
            <input type="email" id="email" name="email" />
        </div>
        <div class="inputBox">
            <label>Message:</label>
            <textarea cols="0" rows="0" id="message" name="message"></textarea>
        </div>
        <input type="submit" value="Submit" name="submit" />
        <div class="clearfix"></div>
    </form>
    
</body>

    <script type="text/javascript">
        $(document).ready(function () {

            $('#dialog').hide();
            var status = $('span').text();
            if (status.length > 40) {
                $("#dialog").dialog();
            }
        });
    </script>
</html>