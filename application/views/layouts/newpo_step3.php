<?php if (!$finalreadonly) {?>
<form class="form-horizontal" action="/po/newpo" method="post">
	<input type="hidden" id="step" name="step" value="3">
	<input type="hidden" id="nextstep" name="nextstep" value="4">
<?php } ?>
	<div class="row-fluid">
		<div class="span6">
			<h2><span class="label label-info" style="font-size:20px">vendor</span> <small>to purchase from</small></h2><br/>
			<fieldset>
				<div class="control-group">
				  <label class="control-label" for="shipVia"><font color="red">Vendor Name</font></label>
				  <div class="controls">
				    <select id="shipVia" name="shipVia">
				      <option value='1'>Tucows</option>
				      <option value='2'>GoDaddy</option>
				      <option value='3'>Other, please enter below</option>
				    </select>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Organization</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toOrg" name="toOrg" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toOrg'])) { echo $_SESSION['currentpo']['step3']['toOrg'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toOrg'])) { echo $_SESSION['currentpo']['step3']['toOrg'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Attention</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vAttn" name="vAttn" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vAttn'])) { echo $_SESSION['currentpo']['step3']['vAttn'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vAttn'])) { echo $_SESSION['currentpo']['step3']['vAttn'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Address</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vAddress" name="vAddress" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vAddress'])) { echo $_SESSION['currentpo']['step3']['vAddress'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vAddress'])) { echo $_SESSION['currentpo']['step3']['vAddress'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">City</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vCity" name="vCity" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vCity'])) { echo $_SESSION['currentpo']['step3']['vCity'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vCity'])) { echo $_SESSION['currentpo']['step3']['vCity'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">State / Province</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vState" name="vState" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vState'])) { echo $_SESSION['currentpo']['step3']['vState'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vState'])) { echo $_SESSION['currentpo']['step3']['vState'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Zip Code</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vZip" name="vZip" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vZip'])) { echo $_SESSION['currentpo']['step3']['vZip'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vZip'])) { echo $_SESSION['currentpo']['step3']['vZip'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Country Code</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vCountry" name="vCountry" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vCountry'])) { echo $_SESSION['currentpo']['step3']['vCountry'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vCountry'])) { echo $_SESSION['currentpo']['step3']['vCountry'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Email</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vEmail" name="vEmail" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vEmail'])) { echo $_SESSION['currentpo']['step3']['vEmail'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vEmail'])) { echo $_SESSION['currentpo']['step3']['vEmail'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Phone</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vPhone" name="vPhone" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vPhone'])) { echo $_SESSION['currentpo']['step3']['vPhone'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vPhone'])) { echo $_SESSION['currentpo']['step3']['vPhone'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Fax</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vFax" name="vFax" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vFax'])) { echo $_SESSION['currentpo']['step3']['vFax'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vFax'])) { echo $_SESSION['currentpo']['step3']['vFax'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Comments</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="vComments" name="vComments" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['vComments'])) { echo $_SESSION['currentpo']['step3']['vComments'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['vComments'])) { echo $_SESSION['currentpo']['step3']['vComments'];} ?></div>
				  <?php } ?>
				</div>
				
			</fieldset>
		</div>
		<div class="span6">
			<h2><span class="label label-warning" style="font-size:20px">receiver</span> <small>shipping/delivery information</small></h2><br/>
			<fieldset>
				<?php //var_dump($userdata);?>
				<div class="control-group">
				  <label class="control-label" for="shipVia"><font color="red">Ship Via</font></label>
				  <div class="controls">
				    <select id="shipVia" name="shipVia">
				      <option value='1'>Ground</option>
				      <option value='2'>Freight</option>
				      <option value='3'>Overnight Express</option>
				      <option value='4'>Other</option>
				    </select>
				  </div>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Organization</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toOrg" name="toOrg" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toOrg'])) { echo $_SESSION['currentpo']['step3']['toOrg'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toOrg'])) { echo $_SESSION['currentpo']['step3']['toOrg'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Attention</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toAttn" name="toAttn" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toAttn'])) { echo $_SESSION['currentpo']['step3']['toAttn'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toAttn'])) { echo $_SESSION['currentpo']['step3']['toAttn'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Address</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toAddress" name="toAddress" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toAddress'])) { echo $_SESSION['currentpo']['step3']['toAddress'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toAddress'])) { echo $_SESSION['currentpo']['step3']['toAddress'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">City</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toCity" name="toCity" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toCity'])) { echo $_SESSION['currentpo']['step3']['toCity'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toCity'])) { echo $_SESSION['currentpo']['step3']['toCity'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">State / Province</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toState" name="toState" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toState'])) { echo $_SESSION['currentpo']['step3']['toState'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toState'])) { echo $_SESSION['currentpo']['step3']['toState'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Zip Code</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toZip" name="toZip" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toZip'])) { echo $_SESSION['currentpo']['step3']['toZip'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toZip'])) { echo $_SESSION['currentpo']['step3']['toZip'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label"><font color="red">Country</font></label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toCountry" name="toCountry" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toCountry'])) { echo $_SESSION['currentpo']['step3']['toCountry'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toCountry'])) { echo $_SESSION['currentpo']['step3']['toCountry'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Email</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toEmail" name="toEmail" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toEmail'])) { echo $_SESSION['currentpo']['step3']['toEmail'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toEmail'])) { echo $_SESSION['currentpo']['step3']['toEmail'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Phone</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toPhone" name="toPhone" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toPhone'])) { echo $_SESSION['currentpo']['step3']['toPhone'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toPhone'])) { echo $_SESSION['currentpo']['step3']['toPhone'];} ?></div>
				  <?php } ?>
				</div>
				<div class="control-group">
				  <label class="control-label">Fax</label>
				  <?php if (!$finalreadonly) {?>
				  <div class="controls"><input type="text" id="toFax" name="toFax" style="width:280px" value="<?php if (isset($_SESSION['currentpo']['step3']['toFax'])) { echo $_SESSION['currentpo']['step3']['toFax'];} ?>" /></div>
				  <?php } else { ?>
				  <div class="controls"><?php if (isset($_SESSION['currentpo']['step3']['toFax'])) { echo $_SESSION['currentpo']['step3']['toFax'];} ?></div>
				  <?php } ?>
				</div>
			</fieldset>
		</div>
	</div>
	<?php if (!$finalreadonly) {?>
   <div class="form-actions" style="padding: 0 0 15px 10px">
	<b>Step 3 / 5 </b>
	<div class="progress progress-striped active" style="display:inline-block; position: relative; width: 300px; top:20px; left: 20px">
	  <div class="bar" style="width: 60%; "></div>
	</div>
	<div style="display:inline; float: right; position:relative; top: 15px; right: 10px">
		<a href="/po/newpo?step=2" class="btn btn-danger">Previous</a>
	    <button type="submit" class="btn btn-primary">Next</button>
	    <button class="btn">Cancel</button>
	</div>
   </div>
	<?php } ?>
<?php if (!$finalreadonly) {?>
</form>
<?php } ?>
