<?php if (!$finalreadonly) {?>
<script type="text/javascript">
$(window).bind("load", function() {
	lineitems_update();
});
</script>
<?php } ?>
<?php if (!$finalreadonly) {?>
<form class="form-horizontal" action="/po/newpo" method="post" enctype="multipart/form-data">
	<input type="hidden" id="step" name="step" value="2">
	<input type="hidden" id="nextstep" name="nextstep" value="3">
	<input type="hidden" id="total_qty" name="total_qty" value="0">
	<input type="hidden" id="total_cost" name="total_cost" value="0">
<?php } ?>
	<h2>Line Items <small>to be reviewed</small></h2><br/>
	<table class="table table-striped">
	        <thead>
	          <tr>
	            <th width="1%">#</th>
	            <th width="32%"><font color="red">Item Description</font></th>
	            <th width="17%">Comments</th>
	            <th width="5%">Part #</th>
	            <!--<th width="8%">Status</th>-->
	            <th width="3%" align=right><font color="red">Qty</font></th>
	            <th width="8%" align="right"><font color="red">Unit $</font></th>
	            <th width="9%" align="right"><font color="navy">Ext $</font></th>
	          </tr>
	        </thead>
	        <tbody>
		<?php if (!$finalreadonly) {?>
			<?php for($i=1; $i<=10; $i++) { ?>
	          <tr id="lineitem_<?= $i ?>" onclick="lineitems_update();" onmouseout="lineitems_update();">
	            <td><b><?= $i ?></b></td>
	            <td><input type="text" id="description<?= $i ?>" name="description[]" placeholder="recommended" value="<?php if(isset($_SESSION['currentpo']['step2']['description'][$i-1])) { echo $_SESSION['currentpo']['step2']['description'][$i-1]; } ?>" style="width:100%" /></td>
	            <td><input type="text" id="comments<?= $i ?>" name="comments[]" placeholder="optional" value="<?php if(isset($_SESSION['currentpo']['step2']['comments'][$i-1])) { echo $_SESSION['currentpo']['step2']['comments'][$i-1]; } ?>" style="width:100%" /></td>
	            <td><input type="text" id="partno<?= $i ?>" name="partno[]" placeholder="optional" value="<?php if(isset($_SESSION['currentpo']['step2']['partno'][$i-1])) { echo $_SESSION['currentpo']['step2']['partno'][$i-1]; } ?>" style="width:100%" /></td>
	            <td><input type="text" id="qty<?= $i ?>" name="qty[]" placeholder="req" value="<?php if(isset($_SESSION['currentpo']['step2']['qty'][$i-1])) { echo $_SESSION['currentpo']['step2']['qty'][$i-1]; } else { echo ''; }?>" style="width:100%" /></td>
	            <td><input type="text" id="unitd<?= $i ?>" name="unitd[]" placeholder="req" value="<?php if(isset($_SESSION['currentpo']['step2']['unitd'][$i-1])) { echo $_SESSION['currentpo']['step2']['unitd'][$i-1]; } else { echo '0.00'; }?>" style="width:100%" /></td>
	            <td><input type="text" id="extd<?= $i ?>" name="extd[]" placeholder="req" value="<?php if(isset($_SESSION['currentpo']['step2']['extd'][$i-1])) { echo $_SESSION['currentpo']['step2']['extd'][$i-1]; } else { echo '0.00'; }?>" style="width:100%" /></td>
	          </tr>
			<?php } ?>
		<?php } else { 
			$total_qty = 0;
			$total_amt = 0;
			?>
			<?php for($i=1; $i<=10; $i++) { ?>
				<?php if($_SESSION['currentpo']['step2']['description'][$i-1] != "" ) { ?>
		          <tr id="lineitem_<?= $i ?>">
		            <td><b><?= $i ?></b></td>
		            <td><?= $_SESSION['currentpo']['step2']['description'][$i-1] ?></td>
		            <td><?= $_SESSION['currentpo']['step2']['comments'][$i-1] ?></td>
		            <td><?= $_SESSION['currentpo']['step2']['partno'][$i-1] ?></td>
		            <td><?= $_SESSION['currentpo']['step2']['qty'][$i-1] ?><?php $total_qty += $_SESSION['currentpo']['step2']['qty'][$i-1]?></td>
		            <td>$<?= $_SESSION['currentpo']['step2']['unitd'][$i-1] ?></td>
		            <td>$<?= $_SESSION['currentpo']['step2']['extd'][$i-1] ?><?php $total_amt += $_SESSION['currentpo']['step2']['extd'][$i-1]?></td>
		          </tr>
				  <?php } ?>
			<?php } ?>
		<?php } ?>
			<?php if (!$finalreadonly) {?>
		      <tr>
	            <td colspan="4"><b>Total</b></td>
	            <td><div id="lineitems_qty_total" style="display:inline; font-style:bold;">0</div></td>
	            <td></td>
	            <td><div id="lineitems_cost_total" style="display:inline; font-style:bold;">$0.00</div></td>
	          </tr>
  			<?php } else { ?>
		      <tr>
	            <td colspan="4"><b>Total</b></td>
	            <td><div id="lineitems_qty_total" style="display:inline; font-style:bold;"><?= $total_qty ?></div></td>
	            <td></td>
	            <td><div id="lineitems_cost_total" style="display:inline; font-style:bold;">$<?= $total_amt ?></div></td>
	          </tr>
			<?php } ?>
	        </tbody>
	      </table>
	<?php if (!$finalreadonly) {?>
	<div class="form-actions" style="padding: 0 0 15px 10px">
	<b>Step 2 / 5 </b>
	<div class="progress progress-striped active" style="display:inline-block; position: relative; width: 300px; top:20px; left: 20px">
	  <div class="bar" style="width: 40%; "></div>
	</div>
	<div style="display:inline; float: right; position:relative; top: 15px; right: 10px">
		<a href="/po/newpo?step=1" class="btn btn-danger">Previous</a>
	    <button type="submit" class="btn btn-primary">Next</button>
	    <button class="btn">Cancel</button>
	</div>
	</div>
	<?php } ?>
<?php if (!$finalreadonly) {?>
</form>
<?php } ?>
