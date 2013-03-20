<div class="page-header">
<br><br>
<h1>Welcome, <?= $userdata['name'] ?>! <small>get a quick view of all pending tasks</small></h1>
<br>
</div>
<div class="info" style="margin-left: 10px; height: 110px;width: 432px; float: left;background: white;box-shadow: 1px 2px 3px black;-moz-box-shadow: 1px 2px 3px black;-webkit-box-shadow: 1px 2px 3px black;">
	<div id="flipboard-dash">
		<div class="flipboard-tile">
			<strong><font color="#3A87AD"><div id="dashboard_nutrition_cal" style="display:inline">0</div></font></strong> approved <small>purchase orders</small>
		</div>
		<div class="flipboard-tile">
			<strong><font color="orange"><div id="dashboard_nutrition_cal" style="display:inline">0</div></font></strong> pending 		<small>purchase orders</small>
			</div>
		<div class="flipboard-tile">
			<strong><font color="red"><div id="dashboard_workout_cal" style="display:inline;">0</div></font></strong> rejected
			<small>purchase orders</small>
		</div>
	</div>
</div>

<div style="margin-top: 150px; margin-left:10px">
	<h1>&nbsp;Review</h1><br>
	<div id="history">
		<div class="alert alert-info">&nbsp;&nbsp;No purchase orders that need your approval or review input</div>
	</div>
</div>

<div style=" margin-left:10px">
	<h1>&nbsp;History</h1><br>
	<div id="history">
		<div class="alert alert-info">&nbsp;&nbsp;No purchase orders submitted recently</div>
	</div>
</div>
