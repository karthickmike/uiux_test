<?php require_once('inc/StudentClass.php'); 
$std = new Student();
$students = $std->getAllMarks(); $id = 0;
?>
<!DOCTYPE html>
<html>
<head>
	<title>UItoUX Test</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3 class="text-primary text-center my-4">Student Details</h3>
				<table class="table table-hover mt-2" id="std_tbl">
					<thead>
						<tr>
							<th>Name</th>
							<th>Mark 1</th>
							<th>Mark 2</th>
							<th>Mark 3</th>
							<th>Total</th>
							<th>Result</th>
							<th>Rank</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach (json_decode($students) as $key => $stdnt) { $id=$key+1; ?>
	<tr id="tr<?php echo $id; ?>" tr="<?php echo $id; ?>">
		<td>
			<input type="text" name="name" id="name<?php echo $id; ?>" value="<?php echo $stdnt->name; ?>" class="form-control" placeholder="Name" required>
			<small class="text-danger" id="name-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="mark1" id="mark1<?php echo $id; ?>" value="<?php echo $stdnt->mark_1; ?>" class="form-control" placeholder="Mark 1" required min="0" max="100" onblur="getTotal(<?php echo $id; ?>);">
			<small class="text-danger" id="mark1-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="mark2" id="mark2<?php echo $id; ?>" value="<?php echo $stdnt->mark_2; ?>" class="form-control" placeholder="Mark 2" required min="0" max="100" onblur="getTotal(<?php echo $id; ?>);">
			<small class="text-danger" id="mark2-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="mark3" id="mark3<?php echo $id; ?>" value="<?php echo $stdnt->mark_3; ?>" class="form-control" placeholder="Mark 3" required min="0" max="100" onblur="getTotal(<?php echo $id; ?>);">
			<small class="text-danger" id="mark3-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="total" id="total<?php echo $id; ?>" value="<?php echo $stdnt->total; ?>" class="form-control" placeholder="Total" required readonly min="0" max="300">
			<small class="text-danger" id="total-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<select name="result" id="result<?php echo $id; ?>" class="form-control" style="width:100px">
				<option <?php echo ($stdnt->result == 'Pass')?"selected":""; ?> value="Pass">Pass</option>
				<option <?php echo ($stdnt->result == 'Fail')?"selected":""; ?> value="Fail">Fail</option>
			</select>
			<small class="text-danger" id="result-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="rank" id="rank<?php echo $id; ?>" value="<?php echo $stdnt->rank; ?>" class="form-control" placeholder="Rank" min="1" max="100">
			<small class="text-danger" id="rank-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="button" name="up" id="up<?php echo $id; ?>" onclick="updateStd(<?php echo $id; ?>,<?php echo $stdnt->id; ?>);" value="Update" class="btn btn-sm btn-success">
		</td>
	</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan="8">
								<input type="button" row="<?php echo $id; ?>" name="addRow" id="addRow" class="btn btn-sm btn-primary float-right" value="Add New">
							</td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
$(document).ready(function(){
	$('#addRow').click(function(e){
		var row = $(this).attr('row');
		var run = $.ajax({
			type : 'GET',
			url  : 'getNewRow.php?id='+row
		});
		run.done(function(data){
			if(data.length){
				$("#std_tbl tbody").append(data);
				row = parseInt(row) + 1;
				$('#addRow').attr('row',row);
			}
        });
	});
});

function updateStd(id, user=null){
	var valid = validateRow(id);
	var name = $('#name'+id).val();
	var mark1 = $('#mark1'+id).val();
	var mark2 = $('#mark2'+id).val();
	var mark3 = $('#mark3'+id).val();
	var total = $('#total'+id).val();
	var result = $('#result'+id).val();
	var rank = $('#rank'+id).val();
	if(valid){
		var run = $.ajax({
			type : 'POST',
			url  : 'addStudent.php?id='+user,
			data : {'std' : {
						'name' : name },
						'marks':{
						'mark1':mark1,
						'mark2':mark2,
						'mark3':mark3,
						'total':total,
						'result':result,
						'rank':rank 
					}}
		});
		run.done(function(data){
			data = parseInt(data);
			if(typeof data == "string"){
				$('#name'+id).addClass("border-danger");
				$('#name-error'+id).text('Name already exist');
			}
			else if(data>=1){
				alert("Student mark added..");
				$('#rm'+id).remove(); 
				$('#up'+id).attr('onclick', 'updateStd('+id+','+data+');');
			}
        });
	}
}

function removeStd(id){
	$("#std_tbl tbody #tr"+id).hide();
}

function getTotal(id){
	var mark1 = $('#mark1'+id).val();
	var mark2 = $('#mark2'+id).val();
	var mark3 = $('#mark3'+id).val();
	mark1 = (mark1.length)?parseInt(mark1):0;
	mark2 = (mark2.length)?parseInt(mark2):0;
	mark3 = (mark3.length)?parseInt(mark3):0;
	$('#total'+id).val(mark1 + mark2 + mark3);
	if(mark1 >= 40 && mark2 >= 40 && mark3 >= 40){
		$('#result'+id).val('Pass');
	}
	else{
		$('#result'+id).val('Fail');
	}
}

function validateRow(id){
	var name = $('#name'+id).val();
	var mark1 = $('#mark1'+id).val();
	var mark2 = $('#mark2'+id).val();
	var mark3 = $('#mark3'+id).val();
	var total = $('#total'+id).val();
	var result = $('#result'+id).val();
	var rank = $('#rank'+id).val();
	if(name.length < 5 || name.length > 100){
		$('#name'+id).addClass("border-danger");
		$('#name-error'+id).text('Name must be 5 to 100 characters');
		return false;
	}
	else{
		$('#name'+id).removeClass("border-danger");
		$('#name-error'+id).text('');
	}
	if(parseInt(mark1) < 0 || parseInt(mark1) > 100){
		$('#mark1'+id).addClass("border-danger");
		$('#mark1-error'+id).text('Mark1 must between 0 to 100');
		return false;
	}
	else{
		$('#mark1'+id).removeClass("border-danger");
		$('#mark1-error'+id).text('');
	}
	if(parseInt(mark2) < 0 || parseInt(mark2) > 100){
		$('#mark2'+id).addClass("border-danger");
		$('#mark2-error'+id).text('Mark2 must between 0 to 100');
		return false;
	}
	else{
		$('#mark2'+id).removeClass("border-danger");
		$('#mark2-error'+id).text('');
	}
	if(parseInt(mark3) < 0 || parseInt(mark3) > 100){
		$('#mark3'+id).addClass("border-danger");
		$('#mark3-error'+id).text('Mark3 must between 0 to 100');
		return false;
	}
	else{
		$('#mark3'+id).removeClass("border-danger");
		$('#mark3-error'+id).text('');
	}
	if(parseInt(total) < 0 || parseInt(total) > 300){
		$('#total'+id).addClass("border-danger");
		$('#total-error'+id).text('Total must between 0 to 300');
		return false;
	}
	else{
		$('#total'+id).removeClass("border-danger");
		$('#total-error'+id).text('');
	}
	if((parseInt(mark1) < 40 || parseInt(mark2) < 40 || parseInt(mark3) < 40) && result == 'Pass'){
		$('#result'+id).addClass("border-danger");
		$('#result-error'+id).text('Marks above 40 only consider pass');
		return false;
	}
	else if((parseInt(mark1) >= 40 && parseInt(mark2) >= 40 && parseInt(mark3) >= 40) && result == 'Fail'){
		$('#result'+id).addClass("border-danger");
		$('#result-error'+id).text('Marks above 40 only consider pass');
		return false;
	}
	else{
		$('#result'+id).removeClass("border-danger");
		$('#result-error'+id).text('');
	}
	if(rank.length != '' && parseInt(rank) < 1){
		$('#rank'+id).addClass("border-danger");
		$('#rank-error'+id).text('Rank must be > 0');
		return false;
	}
	else if(parseInt(rank) >= 1 && result == 'Fail'){
		$('#rank'+id).addClass("border-danger");
		$('#rank-error'+id).text('Rank must be only for Passed candidates');
		return false;
	}
	else{
		$('#rank'+id).removeClass("border-danger");
		$('#rank-error'+id).text('');
	}
	return true;
}
</script>
</html>