<!-- Edit -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Apply Online Loan</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="apply.php">
				<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Company Name:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="companyName" value="<?php echo $row['companyName']; ?>"disabled >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Loan Type:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="sector" value="<?php echo $row['sector']; ?>"disabled >
					</div>
				</div>
				<div class="row form-group">
					<div class="col-sm-2">
						<label class="control-label modal-label">Reference Number:</label>
					</div>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="reference" value="<?php echo "ZW2018"; ?>" disabled>
					</div>
				</div>
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="next" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Next</a></button>
			</form>
            </div>

        </div>
    </div>
</div>

