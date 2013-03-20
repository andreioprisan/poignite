<?php if (!$finalreadonly) {?>
<script type="text/javascript">
window.onload = function() {
 $('#fComments').wysihtml5();
};
</script>
<form class="form-horizontal" action="/po/newpo" method="post" enctype="multipart/form-data">
	<input type="hidden" id="step" name="step" value="4">
	<input type="hidden" id="nextstep" name="nextstep" value="5">
	<input type="hidden" id="pouniqueid" name="pouniqueid" value="<?php if (isset($_SESSION['currentpo']['step4']['pouniqueid'])) 
	{ 
		echo $_SESSION['currentpo']['step4']['pouniqueid'];
	} else { 
		echo md5(date('m/d/y G:i:s').$_SESSION['currentpo']['step1']['author_email']); 
	} ?>">
<?php } else { ?>
<?php } ?>
			<h2>Attach Files <small>vendor quotes or other supporting documents, if available (recommended)</small></h2><br/>
			<?php if (isset($files) && count($files) != 0) { ?>
				<table class="table table-striped">
		        <thead>
		          <tr>
		            <th width="72%">File Name</th>
		            <th width="12%">Size</th>
		            <?php if ($step == "4") { ?>
		            <th width="8%" align="right"></th>
		            <?php } ?>
		          </tr>
		        </thead>
		        <tbody>
		        <?php
		        function formatBytes($bytes, $precision = 2) { 
				    $base = log($bytes) / log(1024);
				    $suffixes = array('', 'kB', 'MB', 'GB', 'TB');   
				    return round(pow(1024, $base - floor($base)), $precision) . " ".$suffixes[floor($base)];
				} 
		        ?>
					<?php foreach ($files as $file) { ?>
					<tr id="<?= $file->ufid ?>">
						<td><a href="http://www.poignite.com/file/download/<?= $pouid ?>/<?= $file->ufid ?>"><?= $file->filename ?></a></td>
						<td><?php $f = formatBytes($file->size); echo $f; ?></td>
			            <?php if ($step == "4") { ?>
						<td><a class="btn btn-danger" href="#" onclick="filedelete('<?= $file->ufid ?>','<?= $pouid ?>/<?= $file->ufid ?>/<?php echo md5($pouid.$file->ufid);?>');"><i class="icon-trash icon-white"></i> Delete</a></td>
			            <?php } ?>
					</tr>
					<?php } ?>

				</table>
			<?php } else { ?>
			No files uploaded.<br><br>
			<?php } ?>
		<?php if (!$finalreadonly) {?>
			<input name="attachments[]" id="attachments" type="file" multiple="" />
			<br><br>
		<?php } ?>
		<h2>Comments <small>additional information or concerns about this purchase order (optional)</small></h2><br/>
		<?php if (!$finalreadonly) {?>
			<textarea class="input-xlarge" id="fComments" name="fComments" rows="5" style="width: 90%"><?php 
			if (isset($_SESSION['currentpo']['step4']['fComments']))
			{
				echo $_SESSION['currentpo']['step4']['fComments'];
			}
			?></textarea>
		<?php } else { ?>
			<?php echo $_SESSION['currentpo']['step4']['fComments']; ?>
		<?php } ?>
		<br><br>
		<?php if (!$finalreadonly) {?>
		<h2>Send to Next <small><?= strtolower($sendToReviewer) ?></h2><br/>
		<?php } else { ?>
		<?php if (isset($_SESSION['currentpo']['step4']['sendtoreviewer']) && $_SESSION['currentpo']['step4']['sendtoreviewer'] != "") { ?>
		<h2><font color="red">Send to Next <small><?= strtolower($_SESSION['currentpo']['step4']['sendtoreviewer']); ?></font></h2><br/>
		<?php } ?>
		<?php } ?>
		<br><br>
		
		
	<?php if (!$finalreadonly) {?>
	<div class="form-actions" style="padding: 0 0 15px 10px">
	<b>Step 4 / 5 </b>
	<div class="progress progress-striped active" style="display:inline-block; position: relative; width: 300px; top:20px; left: 20px">
	  <div class="bar" style="width: 80%; "></div>
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
