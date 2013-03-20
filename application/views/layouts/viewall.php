<div class="page-header">
  <br><h1>View all Purchase Orders <small>manage and review all purchase orders</small></h1><br>
</div>
<br>

<table class="table table-striped table-bordered table-condensed">
	<th>Date Submitted</th>
	<th>Author</th>
<!--	<th>Title</th> -->
	<th>Amount</th>
	<th>Next Reviewer</th>
	<th>Also Notified</th>
	<th>Review</th>
	<th>Actions</th>
	<th></th>
	<?php foreach($pos_list as $po) { 
		$po = get_object_vars($po);
		$content = get_object_vars(json_decode($po['content']));
		$step1 = get_object_vars($content['step1']);
		$step2 = get_object_vars($content['step2']);
		$step3 = get_object_vars($content['step3']);
		$step4 = get_object_vars($content['step4']);
		?>
	<tr>
		<td><?php $a = explode(" ", $po['timestamp']);
				$b = explode("-", $a[0]);
				echo $b[1]."/".$b[2]."/".$b[0]; 
				?></td>
		<td><?php
		$author = $instance->usersm->getbyid($po['uid']);
		echo "<a href='mailto:".$author->email."'>".$author->name."</a>"; ?></td>
<!--		<td><?= $step1['orgTitle']; ?></td> -->
		<td>$<?= $step2['total_cost']; ?></td>
		<td><?= strtolower($step4['sendtoreviewer']); ?></td>
		<td><?= strtolower(implode("<br>", json_decode($po['approvers_email']))); ?></td>
		<td><a href="" class="btn btn-success">Approve</a> <a href="" class="btn btn-danger">Deny</a></td>
		<td>
			<a href="/po/viewpo/<?= $po['pouid']; ?>" class="btn btn-primary">View</a>
			<a href="/po/loadpo/<?= $po['pouid']; ?>" class="btn btn-primary">Edit</a>
			<a href="/po/deletepo/<?= $po['pouid']; ?>" class="btn btn-danger">Delete</a>
		</td>
		<td>
			<a href="/po/sendemailpo/<?= $po['pouid']; ?>" class="btn btn-primary">Email</a>
		</td>
	</tr>	
	<?php } ?>
</table>
