<!DOCTYPE html>
<html lang="en">
<head>
	<title>User | Registration </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo base_url('assets/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/jquery-3.6.0.min.js') ?>"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		label{
			font-weight: 600;
		}
		.form-group{
			margin-bottom: 16px;
		}
		body{
			background: #edf2fa;	
		}
	</style>
</head>
<body >
	<div class="container ">
		<div class="col-md-5 d-block m-auto mt-5">
			<div class="card p-3">
				<div class="text-center"><h3 class="text-primary">User Registration Form</h3></div>
				<hr>
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
				<form method="post" action="<?= base_url('add-user') ?>">
					<div class="form-group">
						<label for="name">Name: <span class="text-danger">*</span></label>
						<input type="text" name="name" class="form-control" value="<?php echo set_value('name'); ?>" >
						<span class="text-danger nameErr"><?php echo form_error('name'); ?></span>
					</div>
					<div class="form-group">
						<label for="dob">Date of Birth: <span class="text-danger">*</span></label>
						<input type="date" name="dob" id="dob" class="form-control" value="<?php echo set_value('dob'); ?>" >
						 <span class="text-danger dobErr"><?php echo form_error('dob'); ?></span>
					</div>
					<div class="form-group">
						<label for="mobile">Mobile: <span class="text-danger">*</span></label>
						<input type="text" name="mobile"  id="mobile" class="form-control" value="<?php echo set_value('mobile'); ?>" >
						<span class="text-danger mobileErr"><?php echo form_error('mobile'); ?></span>

					</div>
					<div class="form-group">
						<label for="email">Email: <span class="text-danger">*</span></label>
						<input type="email" name="email" class="form-control" value="<?php echo set_value('email'); ?>" >
						<span class="text-danger emailErr"><?php echo form_error('email'); ?></span>
					</div>
					<div class="form-group">
						<label for="pin">PIN (<small style="font-size:14px;font-weight:400" class="text-danger">Please enter a 6-digit number</small>): <span class="text-danger">*</span></label>
						<input type="text" name="pin" class="form-control" id="pin" value="<?php echo set_value('pin'); ?>" >
						<span class="text-danger pinErr"><?php echo form_error('pin'); ?></span>
					</div>
					<div class="row" style="display: flex;   align-items: center;">
					    <div class="col-md-7">						
					        <div class="form-group">
					            <label for="captcha">Captcha: <span class="text-danger">*</span></label>
					            <input type="text" name="captcha" class="form-control" >
					        </div>
					    </div>
					    <div class="col-md-5">
					        <span id="captcha-image"><?php echo $captcha['image']; ?></span>
					        <button type="button" onclick="refreshCaptcha()">
					            <i style="font-size:15px" class="fa">&#xf021;</i>
					        </button>
					    </div>
					    <div class="col-md-12">
					        <span class="text-danger captchaErr"><?php echo form_error('captcha'); ?></span>			
					    </div>
					</div>
					<hr>
					<div class="form-group text-center">
						<input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
						<button type="submit" class="btn btn-primary">Submit</button>
						
					</div>
				</form>	
				<span><a href="<?=base_url('user-list') ?>">Go to User List</a></span>
			</div>
		</div>
	</div>
</body>
</html>


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