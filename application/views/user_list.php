<!DOCTYPE html>
<html lang="en">
<head>
	<title>User | List </title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="<?php echo base_url('assets/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
	<script src="<?php echo base_url('assets/bootstrap/bootstrap.bundle.min.js') ?>"></script>
	<script src="<?php echo base_url('assets/jquery-3.6.0.min.js') ?>"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		.title{
			font-weight: 600;
			font-size: 2rem;
		}
		body{
			background: #edf2fa;	
		}
	</style>
</head>
<body >
	<div class="container my-5 ">
		<div class="col-md-12 mt-5">
			<div class="card p-3">
				<div class="text-center"><span class="text-primary title">User Registration List </span><a href="<?= base_url() ?>" class="pull-right btn btn-sm btn-success">Add New User</a></div>
				<hr>
				<table class="table table-striped table-hover table-bordered">
					<thead class="table-dark">
				        <tr>
				          <th>#</th>
				          <th>Name</th>
				          <th>DOB</th>
				          <th>Phone No</th>
				          <th>Email</th>
				          <th>Status</th>
				          <th>Created At</th>
				        </tr>
			      	</thead>
			      	<tbody>
			      		<?php 
			      			$i = 1;
			      			if (!empty($results)) {
			      				foreach ($results as $key) { ?>
			      					<tr>
							          <td><?= $i++ ?></td>
							          <td><?= $key->name ?></td>
							          <td><?= $key->dob ?></td>
							          <td><?= $key->mobile	 ?></td>
							          <td><?= $key->email ?></td>
							          <td><?= ($key->status==1)?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>' ?></td>
							          <td><?= $key->created_at ?></td>
							        
							        </tr>	
			      		<?php } } ?>
			      	</tbody>
				</table>
					
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