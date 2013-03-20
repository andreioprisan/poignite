<?php if (!isset($_POST['cantsubmit'])) { ?>
<div class="form-actions" style="padding: 0 0 15px 10px">
	<b>Step 5 / 5 </b>
	<div class="progress progress-striped active" style="display:inline-block; position: relative; width: 300px; top:20px; left: 20px">
	  <div class="bar" style="width: 100%; "></div>
	</div>
	<div style="display:inline; float: right; position:relative; top: 15px; right: 10px">
		<a href="/po/newpo?step=4" class="btn btn-danger">Previous</a>
	    <button type="submit" class="btn btn-primary">Submit</button>
	</div>
</div>
</form>
<?php } else { ?>
<?php if (isset($_POST['sendemail'])) { ?>
<div class="page-header">
	<a href="http://www.poignite.com">This purchase order was generated with Purchase Order Ignite. &copy; POignite 2012</a>
</div>
<?php } ?>
<?php } ?>