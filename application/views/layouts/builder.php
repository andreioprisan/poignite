<div class="row-fluid">
	<div class="span3">
		<div class="well sidebar-nav">
			<ul class="nav nav-list" style="position:relative; right:5px; width:100%; top:-25px">
				<li class="nav-header" style="font-size: 15px; position:relative; left:-20px; color:crimson;">Method List
				</li><?= $apisidemenu ?>
				</ul>
		</div><!--/.well -->
	</div><!--/span-->
	<div class="span9">
		<div style="position: absolute; right: 33px; display:inline;">
		<div class="btn-group" data-toggle="buttons-radio">
		  <button class="btn btn-primary active">run</button>
		  <button class="btn btn-danger">edit</button>
		</div>
		</div>
		<h3>
			Method
		</h3><br>
		<?= $apimethodslide ?>
		<h3>
			Parameters
		</h3><br>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>
						Name
					</th>
					<th>
						Type
					</th>
					<th>
						Description
					</th>
					<th>
						Value
					</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($apiparams as $param) {?>
				<tr id="<?= $param->method_id ?>_<?= $param->param_id ?>">
					<input type="hidden" id="param" value="<?= $param->name ?>">
					<td>
						<?= $param->name ?>
					</td>
					<td width="20%">
						<select id="type" style="width: 140px">
							<?php $types = array(	'int' => 'integer',
													'double' => 'double',
													'float' => 'float',
													'string' => 'string',
													'boolean' => 'boolean',
													'blob' => 'data blob'
												);?>
							<?php foreach ($types as $tval => $ttext) { ?>
							<option value="<?= $tval ?>" <?php if ($param->type == $tval)  echo 'selected' ?>><?= $ttext ?></option>
							<?php } ?>
						</select>
					</td>
					<td>
						<input type="text" size="20" id="description" value="<?= $param->description ?>">
					</td>
					<td>
						<input type="text" size="20" id="value" value="<?= $param->value ?>">
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div><!--/span-->
</div>
