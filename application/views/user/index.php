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
        <div class="col-md-12">
          <div class="tile">
          	<div class="row">
	          	<div class="col-6">
	          		<h3 class="tile-title">User Registration</h3>
	          	</div>
	          	<div class="col-6">
		          	<div class="float-end">
		          		<a class="btn btn-primary" href="<?= base_url() ?>"><i class="bi bi-plus-circle me-2"></i>Create</a>
		          	</div>
	          	</div>
          	</div>
            
            <table class="table table-bordered">
              <thead>
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
	      		<?php } }else{
	      			echo '<tr><td colspan="7" class="text-center text-danger">No Records Found !</td></tr>';
	      		} ?>
	      	</tbody>
            </table>
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



