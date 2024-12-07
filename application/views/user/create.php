<!DOCTYPE html>
<html lang="en">
<head>
	<title>User | Registration </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css') ?>">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

</head>
<body >
	<main class="app-content">
      <div class="row">
        <div class="col-md-6 offset-3">
          <div class="tile">

          	<?php if ($this->session->flashdata('success')){ ?>
		       
				<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong>Message!</strong> <?= $this->session->flashdata('success') ?>
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
	        <?php } ?>
    		<?php if ($this->session->flashdata('error')){ ?>
	            <div class="alert alert-danger alert-dismissible fade show" role="alert">
				  <strong>Message!</strong> <?= $this->session->flashdata('error') ?>
				  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
	        <?php } ?>

            <h3 class="tile-title" style="border-bottom: 1px solid #ddd; padding: 0px 0 20px 0;">User Registration</h3>
            <form method="post" action="<?= base_url('user/store') ?>">
            	<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
	            <div class="tile-body">
	              
	                <div class="mb-3">
	                  <label class="form-label">Name:</label>
	                  <input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" />
					  <span class="text-danger nameErr small"><?php echo form_error('name'); ?></span>
	                </div>
	                <div class="mb-3">
	                  <label class="form-label">Date of Birth:</label>
	                  <input type="date" name="dob" id="dob" class="form-control" value="<?php echo set_value('dob'); ?>" >
					  <span class="text-danger dobErr small"><?php echo form_error('dob'); ?></span>
	                </div>
	                <div class="mb-3">
	                  <label class="form-label">Mobile:</label>
	                  <input type="text" name="mobile"  id="mobile" class="form-control" value="<?php echo set_value('mobile'); ?>" >
					  <span class="text-danger mobileErr small"><?php echo form_error('mobile'); ?></span>
	                </div>
	                
	                <div class="mb-3">
	                  <label class="form-label">Email:</label>
	                  <input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" >
					  <span class="text-danger emailErr small"><?php echo form_error('email'); ?></span>
	                </div>
	                
	                <div class="mb-3">
	                  <label class="form-label">Pincode:</label>
	                  <input type="text" name="pin" class="form-control" id="pin" value="<?php echo set_value('pin'); ?>" >
					  <span class="text-danger pinErr small"><?php echo form_error('pin'); ?></span>
	                </div>

	                <div class="mb-3">
	                  <label class="form-label">Captcha:</label>
	                  
	                  <div class="row">
		                  <div class="col-7">
		                  	<input type="text" name="captcha" class="form-control" >
		                  </div>
		                  <div class="col-4 text-end">
	          			 	<span id="captcha-image"><?php echo $captcha['image']; ?></span>
		                  </div>
		                  <div class="col-1">
	          			 	<button class="btn btn-warning" type="button" onclick="refreshCaptcha()"><i class="bi bi-arrow-clockwise mx-0"></i></button>
		                  </div>
	                  </div>
					  <span class="text-danger captchaErr small"><?php echo form_error('captcha'); ?></span>
	                </div>
	              
	            </div>
	            <div class="tile-footer">
	              <button class="btn btn-primary" type="submit"><i class="bi bi-check-circle-fill me-2"></i>Register</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="<?= base_url('user/list') ?>"><i class="bi bi-list me-2"></i>User List</a>
	            </div>
            </form>
          </div>
        </div>
        
        <div class="clearix"></div>
        
      </div>
    </main>
</body>
</html>

<script src="<?php echo base_url('assets/plugins/jquery/src/jquery-3.7.0.min.js') ?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/src/bootstrap.min.js') ?>"></script>
<!-- <script src="<?php echo base_url('assets/src/main.js') ?>"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('form').submit(function(event) {
            var isValid = true;
            $('.nameErr, .dobErr, .mobileErr, .emailErr, .pinErr, .captchaErr').text('');

            if ($('input[name="name"]').val().trim() == '') {
                $('.nameErr').text('Name is required.');
                isValid = false;
            }

            if ($('input[name="dob"]').val().trim() == '') {
                $('.dobErr').text('Date of Birth is required.');
                isValid = false;
            }

            if ($('input[name="mobile"]').val().trim() == '' || $('input[name="mobile"]').val().length != 10 ) {
                $('.mobileErr').text('Mobile number is required and should be 10 digits.');
                isValid = false;
            }

            var email = $('input[name="email"]').val().trim();
            if (email == '') {
                $('.emailErr').text('Email is required.');
                isValid = false;
            } else if (!validateEmail(email)) {
                $('.emailErr').text('Please enter a valid email address.');
                isValid = false;
            }

            var pin = $('input[name="pin"]').val().trim();
            if (pin == '') {
                $('.pinErr').text('PIN is required.');
                isValid = false;
            } else if (pin.length != 6) {
                $('.pinErr').text('PIN must be 6 digits.');
                isValid = false;
            }

            if ($('input[name="captcha"]').val().trim() == '') {
                $('.captchaErr').text('Captcha is required.');
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
            }
        });

      	function validateEmail(email) {
	        var re = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
	        return re.test(email);
	    }
    });

</script>

<script>
    function refreshCaptcha() {
        $.ajax({
            url: "<?php echo base_url('refresh-captcha'); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Update the captcha image with the new one
                $('#captcha-image').html(response.captcha_image);
                // Clear the previous captcha input field
                $('input[name="captcha"]').val('');
            }
        });
    }
</script>