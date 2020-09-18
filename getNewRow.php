<?php
if(isset($_GET['id']) && is_numeric($_GET['id'])){
	$id = $_GET['id'] + 1; ?>
	<tr id="tr<?php echo $id; ?>" tr="<?php echo $id; ?>">
		<td>
			<input type="text" name="name" id="name<?php echo $id; ?>" value="" class="form-control" placeholder="Name" required>
			<small class="text-danger" id="name-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="mark1" id="mark1<?php echo $id; ?>" value="" class="form-control" placeholder="Mark 1" required min="0" max="100" onblur="getTotal(<?php echo $id; ?>);">
			<small class="text-danger" id="mark1-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="mark2" id="mark2<?php echo $id; ?>" value="" class="form-control" placeholder="Mark 2" required min="0" max="100" onblur="getTotal(<?php echo $id; ?>);">
			<small class="text-danger" id="mark2-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="mark3" id="mark3<?php echo $id; ?>" value="" class="form-control" placeholder="Mark 3" required min="0" max="100" onblur="getTotal(<?php echo $id; ?>);">
			<small class="text-danger" id="mark3-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="total" id="total<?php echo $id; ?>" value="" class="form-control" placeholder="Total" required readonly min="0" max="300">
			<small class="text-danger" id="total-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<select name="result" id="result<?php echo $id; ?>" class="form-control" style="width:100px">
				<option value="Pass">Pass</option>
				<option value="Fail">Fail</option>
			</select>
			<small class="text-danger" id="result-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="number" name="rank" id="rank<?php echo $id; ?>" value="" class="form-control" placeholder="Rank" min="1" max="100">
			<small class="text-danger" id="rank-error<?php echo $id; ?>"></small>
		</td>
		<td>
			<input type="button" name="up" id="up<?php echo $id; ?>" onclick="updateStd(<?php echo $id; ?>);" value="Update" class="btn btn-sm btn-success">
			<input type="button" name="rm" id="rm<?php echo $id; ?>" onclick="removeStd(<?php echo $id; ?>);" value="Remove" class="btn btn-sm btn-danger">
		</td>
	</tr>
<?php
}