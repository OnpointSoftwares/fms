<!DOCTYPE html>
<?php 
	require 'validator.php';
	require_once 'conn.php'
?>
<html lang = "en">
	<head>
		<title>CAK File Management System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/jquery.dataTables.css" />
		<link rel = "stylesheet" type = "text/css" href = "css/style.css" />
	</head>
<body>
	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
		<div class="container-fluid">
			<label class="navbar-brand">CAK File Management System</label>
			<?php 
				$query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = '$_SESSION[user]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
			?>
			<ul class = "nav navbar-right">	
				<li class = "dropdown">
					<a class = "user dropdown-toggle" data-toggle = "dropdown" href = "#">
						<span class = "glyphicon glyphicon-user"></span>
						<?php 
							echo $fetch['firstname']." ".$fetch['lastname'];
						?>
						<b class = "caret"></b>
					</a>
				<ul class = "dropdown-menu">
					<li>
						<a href = "logout.php"><i class = "glyphicon glyphicon-log-out"></i> Logout</a>
					</li>
				</ul>
				</li>
			</ul>
		</div>
	</nav>
	<?php include 'sidebar.php'?>
	<div id = "content">
		<br /><br /><br />
		<div class="alert alert-info"><h3>Accounts / logs</h3></div> 
		<button class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add incoming mails</button>
		<button class="btn btn-success" data-toggle="modal" data-target="#form_modal"><span class="glyphicon glyphicon-plus"></span> Add incoming mails</button>
		<br>
		<table id = "table" class="table table-bordered">
			<thead>
				<tr>
					<th>date</th><br>
					<th>Office Received From</th><br>
					<th>subject</th><br>
					<th>action taken by</th><br>
					<th>dispatched to</th>
					<th>Forwarded to</th>
					<th>File</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = mysqli_query($conn, "SELECT * FROM `logs`") or die(mysqli_error());
					while($fetch = mysqli_fetch_array($query)){
				?>
					<tr class="del_logs<?php echo $fetch['file_id']?>">
						<td><?php echo $fetch['date']?></td>
						<td><?php echo $fetch['received_from']?></td>
						<td><?php echo $fetch['subject']?></td>
						<td><?php echo $fetch['action_taken_by']?></td>
						<td><?php echo $fetch['dispatched_to']?></td>
						<td><?php echo $fetch['Forwarded_to']?></td>
						<td><?php echo $fetch['file_path']?></td>
						<td><center><button class="btn btn-warning" data-toggle="modal" data-target="#edit_modal<?php echo $fetch['file_id']?>"><span class="glyphicon glyphicon-edit"></span> Edit</button> 
						<button class="btn btn-danger btn-delete" id="<?php echo $fetch['file_id']?>" type="button"><span class="glyphicon glyphicon-trash"></span> Delete</button></center></td>
					</tr>
	<div class="modal fade" id="edit_modal<?php echo $fetch['file_id']?>" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form method="POST" action="update_logs.php">	
					<div class="modal-header">
						<h4 class="modal-title">Update logs</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Student no</label>
								<input type="hidden" name="stud_id" value="<?php echo $fetch['stud_id']?>" class="form-control"/>
								<input type="number" name="stud_no" value="<?php echo $fetch['stud_no']?>" class="form-control" readonly="readonly"/>
							</div>
							<div class="form-group">
								<label>date</label>
								<input type="text" name="date" value="<?php echo $fetch['date']?>" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>department</label>
								<input type="text" name="department" value="<?php echo $fetch['department']?>" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>subject</label>
								<select name="subject" class="form-control" required="required">
									<option value=""></option>
									<option value="Male">Male</option>
									<option value="Female">Female</option>
								</select>
							</div>
							<div class="form-inline">
								<label>Year</label>
								<select name="year" class="form-control" required="required">
									<option value=""></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
								<label>Section</label>
								<select name="section" class="form-control" required="required">
									<option value=""></option>
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
								</select>
							</div>
							<br />
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="password" class="form-control" required="required"/>
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="update" class="btn btn-warning" ><span class="glyphicon glyphicon-save"></span> Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
	<div class="modal fade" id="modal_confirm" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">System</h3>
				</div>
				<div class="modal-body">
					<center><h4 class="text-danger">All files of the student will also be deleted.</h4></center>
					<center><h3 class="text-danger">Are you sure you want to delete this data?</h3></center>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" id="btn_yes">Yes</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="form_modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
			<form method="POST" action="add_logs.php" enctype="multipart/form-data">	
					<div class="modal-header">
						<h4 class="modal-title">Update logs</h4>
					</div>
					<div class="modal-body">
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Office Received From</label>
								<input type="hidden" name="stud_id"  class="form-control"/>
								<input type="text" name="received_from"  class="form-control" />
							</div>
							<div class="form-group">
								<label>Date Received</label>
								<input type="date" name="date"  min="<?php echo date('20y-m-d'); ?>" class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Forwarded To</label>
								<input type="text" name="forwarded_to"  class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Dispatched To</label>
								<input type="text" name="dispatched_to"  class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>Action Taken By</label>
								<input type="text" name="action_taken_by"  class="form-control" required="required"/>
							</div>
							<div class="form-group">
								<label>subject</label>
								<textarea name="subject" class="form-control" required="required">
									
				</textarea>
							</div>
							<br />
							<div class="form-group">
								<label>File attachment</label>
								<input type="file" name="file" class="form-control" required="required">
							</div>
						</div>
					</div>
					<div style="clear:both;"></div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
						<button name="add" id="add" class="btn btn-warning" ><span class="glyphicon glyphicon-save"></span> Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div id = "footer">
		<label class = "footer-title">&copy; CAK File Management System <?php echo date("Y", strtotime("+8 HOURS"))?></label>
	</div>
<?php include 'script.php'?>
<script type="text/javascript">
$(document).ready(function(){
	$('.btn-delete').on('click', function(){
		var stud_id = $(this).attr('id');
		$("#modal_confirm").modal('show');
		$('#btn_yes').attr('name', stud_id);
	});
	$('#btn_yes').on('click', function(){
		var id = $(this).attr('name');
		$.ajax({
			type: "POST",
			url: "delete_student.php",
			data:{
				stud_id: id
			},
			success: function(){
				$("#modal_confirm").modal('hide');
				$(".del_student" + id).empty();
				$(".del_student" + id).html("<td colspan='6'><center class='text-danger'>Deleting...</center></td>");
				setTimeout(function(){
					$(".del_student" + id).fadeOut('slow');
				}, 1000);
			}
		});
	});
});
</script>	
</body>
</html>