<?php if (!$finalreadonly) {?>
<form class="form-horizontal" action="/po/newpo" method="post">
	<input type="hidden" id="step" name="step" value="1" />
	<input type="hidden" id="nextstep" name="nextstep" value="2" />
	<input type="hidden" id="author_id" name="author_id" value="<?= $userdata['id']; ?>" />
	<input type="hidden" id="author_email" name="author_email" value="<?= $userdata['email']; ?>" />
	<input type="hidden" id="pouniqueid" name="pouniqueid" value="<?php if (isset($_SESSION['currentpo']['step4']['pouniqueid'])) 
	{ 
		echo $_SESSION['currentpo']['step4']['pouniqueid'];
	} else { 
		echo md5(date('m/d/y G:i:s').$_SESSION['currentpo']['step1']['author_email']); 
	} ?>">
<?php } ?>
	<div class="row-fluid">
		<div class="span6">
			<h2>Requester Information <small>and approving manager details</small></h2><br/>
			<fieldset>
				<div class="control-group">
				  <label class="control-label">Submitted By</label>
				  <div class="controls"><?= $userdata['name']; ?></div>
				</div>
				<div class="control-group">
					<label class="control-label">Title</label>
					<?php if (!$finalreadonly) {?>
						<?php if (isset($userdetails['orgTitle'])) { ?>
						<div class="controls"><?= $userdetails['orgTitle']; ?></div>
						<input type="hidden" id="orgTitle" name="orgTitle" value="<?= $userdetails['orgTitle']; ?>"/>
						<?php } else { ?>
						<div class="controls"><input type="text" id="orgTitle" name="orgTitle" style="width:280px" /></div>
						<?php } ?>
					<?php } else { ?>
						<div class="controls"><?= $_SESSION['currentpo']['step1']['orgTitle'] ?></div>
					<?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Organization</label>
					<?php if (!$finalreadonly) {?>
						<?php if (isset($userdetails['orgName'])) { ?>
						<div class="controls"><?= $userdetails['orgName']; ?></div>
						<input type="hidden" id="orgName" name="orgName" value="<?= $userdetails['orgName']; ?>"/>
						<?php } else { ?>
						<div class="controls"><input type="text" id="orgName" name="orgName" style="width:280px" /></div>
						<?php } ?>
					<?php } else { ?>
						<div class="controls"><?= $_SESSION['currentpo']['step1']['orgName'] ?></div>
					<?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label" for="submitTo1"><font color="red">Approver</font></label>
				  <div class="controls">
					<?php if (!$finalreadonly) {?>
						<?= $submitTo1 ?>
					<?php } else { ?>
						<?= $_SESSION['currentpo']['step1']['submitTo1'] ?>
					<?php } ?>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label" for="submitCc1">CC to</label>
				  <div class="controls">
					<?php if (!$finalreadonly) {?>
						<?= $submitCc1 ?><br/>
						<?= $submitCc2 ?><br/>
						<?= $submitCc3 ?><br/>
						<?= $submitCc4 ?><br/>
						<?= $submitCc5 ?>
					<?php } else { ?>
						<?php if (isset($_SESSION['currentpo']['step1']['submitCc1'])) { ?>
						<?= $_SESSION['currentpo']['step1']['submitCc1'] ?><br>
						<?php } ?>
						<?php if (isset($_SESSION['currentpo']['step1']['submitCc2'])) { ?>
						<?= $_SESSION['currentpo']['step1']['submitCc2'] ?><br>
						<?php } ?>
						<?php if (isset($_SESSION['currentpo']['step1']['submitCc3'])) { ?>
						<?= $_SESSION['currentpo']['step1']['submitCc3'] ?><br>
						<?php } ?>
						<?php if (isset($_SESSION['currentpo']['step1']['submitCc4'])) { ?>
						<?= $_SESSION['currentpo']['step1']['submitCc4'] ?><br>
						<?php } ?>
						<?php if (isset($_SESSION['currentpo']['step1']['submitCc5'])) { ?>
						<?= $_SESSION['currentpo']['step1']['submitCc5'] ?><br>
						<?php } ?>
					<?php } ?>
				  </div>
				</div>
			</fieldset>
		</div>
		<div class="span6">
			<h2>Request Details</h2><br/>
			<fieldset>
				<div class="control-group">
				  <label class="control-label">Date Required</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="dateRequired" name="dateRequired" value="<?php if (!$finalreadonly) { ?><?= date('m/d/Y') ?><?php } else if (isset($_SESSION['currentpo']['step'.$this->step]['dateRequired'])) { echo $_SESSION['currentpo']['step'.$this->step]['dateRequired']; } else { ?><?= $_SESSION['currentpo']['step1']['dateRequired'] ?><?php } ?>" style="width:80px" /></div>
				  <?php } else { ?>
				  <div class="controls"><?= $_SESSION['currentpo']['step1']['dateRequired'] ?></div>  
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Effective Dates</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="effectiveDates" name="effectiveDates" value="<?php if (!$finalreadonly) {?><?= date('m/d/Y') ?> - <?= date('m/d/Y') ?><?php } else if (isset($_SESSION['currentpo']['step'.$this->step]['effectiveDates'])) { echo $_SESSION['currentpo']['step'.$this->step]['effectiveDates']; } else { ?><?= $_SESSION['currentpo']['step1']['effectiveDates'] ?><?php } ?>"  style="width:220px" /> <?php if (!$finalreadonly) {?><span class="label label-important">select "Date Range"</span><?php } ?></div>
				  <?php } else { ?>
				  <div class="controls"><?= $_SESSION['currentpo']['step1']['effectiveDates'] ?></div>  
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label" for="select01"><font color="red">Request Type</font></label>
					<?php $requestTypeArr = array(
						'0' => '',
						'1' => 'Books and Publications',
						'2' => 'Computer Network Equipment',
						'3' => 'Computer Peripherals',
						'4' => 'Computer Supplies',
						'5' => 'Computers - Personal',
						'6' => 'Computers - Servers',
						'7' => '...'
					);
					?>
  				  <?php if (!$finalreadonly) {?>
				  <div class="controls">
				    <select id="requestType" name="requestType" style="width: 403px">
						<?php foreach ($requestTypeArr as $id => $val) { ?>
							<option value='<?= $id ?>' <?php if (isset($_SESSION['currentpo']['step1']['requestType']) && $_SESSION['currentpo']['step1']['requestType'] == $id) { echo "selected"; }?>><?= $val ?></option>
						<?php } ?>
				    </select>
				  </div>
				  <?php } else { ?>
				  <div class="controls"><?= $requestTypeArr[$_SESSION['currentpo']['step1']['requestType']] ?></div>  
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label" for="description"><font color="red">Description</font></label>
  				  <?php if (!$finalreadonly) {?>
				  <div class="controls">
				    <textarea class="input-xlarge" id="description" name="description" rows="4" style="width: 90%"><?php if (isset($_SESSION['currentpo']['step1']['description'])) { echo $_SESSION['currentpo']['step1']['description']; }?></textarea>
				  </div>
				  <?php } else { ?>
				  <div class="controls"><?= $_SESSION['currentpo']['step1']['description'] ?></div>  
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label" for="paymentMethod"><font color="red">Payment Method</font></label>
					<?php $paymentMethods = array(
						'0' => '',
						'1' => 'Vendor will Invoice',
						'2' => 'Request to Expense After PO# Assigned',
						'3' => 'Check Required AFter PO# Assigned (prepaid)'
					);
					?>
  				  <?php if (!$finalreadonly) {?>
				  <div class="controls">
				    <select id="paymentMethod" name="paymentMethod" style="width: 403px">
						<?php foreach ($paymentMethods as $id => $val) { ?>
							<option value='<?= $id ?>' <?php if (isset($_SESSION['currentpo']['step1']['paymentMethod']) && $_SESSION['currentpo']['step1']['paymentMethod'] == $id) { echo "selected"; }?>><?= $val ?></option>
						<?php } ?>
				    </select>
				  </div>
				  <?php } else { ?>
				  <div class="controls"><?= $paymentMethods[$_SESSION['currentpo']['step1']['paymentMethod']] ?></div>  
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Date Ordered</label>
  				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="dateOrdered" name="dateOrdered" placeholder="if applicable" style="width:80px" /></div>
				  <?php } else { ?>
				  <div class="controls"><?= $_SESSION['currentpo']['step1']['dateOrdered'] ?></div>  
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label" for="lineItem">Line Item</label>
  				  <?php if (!$finalreadonly) {?>
				  <div class="controls">
  				    <input id="lineItem" name="lineItem" class="input-small" type="text" placeholder="if known" style="width:80px" />
				  </div>
				  <?php } else { ?>
				  <div class="controls"><?= $_SESSION['currentpo']['step1']['lineItem'] ?></div>  
				  <?php } ?>
				</div>
			</fieldset>
		</div>
	</div>
	<?php if (!$finalreadonly) {?>
	<div class="form-actions" style="padding: 0 0 15px 10px">
		<b>Step 1 / 5 </b>
		<div class="progress progress-striped active" style="display:inline-block; position: relative; width: 300px; top:20px; left: 20px">
			<div class="bar" style="width: 20%; "></div>
		</div>
		<div style="display:inline; float: right; position:relative; top: 15px; right: 10px">
		    <button type="submit" class="btn btn-primary">Next</button>
		    <button class="btn">Cancel</button>
		</div>
	</div>
	<?php } ?>
<?php if (!$finalreadonly) {?>
</form>
<?php } ?>
