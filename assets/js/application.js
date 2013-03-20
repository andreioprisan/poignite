$(function(){
	$('#dateRequired').daterangepicker(); 
	$('#effectiveDates').daterangepicker(); 
	$('#dateOrdered').daterangepicker(); 
});


var qty = 0;
var cost_total = 0.00;

function lineitems_update()
{
	qty=0;
	cost_total=0.00;
	
	for(var id=1; id<=10; id++)
	{
		var thisqty = 0;
		if ($('#lineitem_'+id+' #qty'+id+'').val() != "")
			thisqty = parseInt($('#lineitem_'+id+' #qty'+id+'').val());
		var thiscost = 0.00;
		if ($('#lineitem_'+id+' #unitd'+id+'').val() != "" && $('#lineitem_'+id+' #unitd'+id+'').val() != "0.00")
			thiscost = thisqty*$('#lineitem_'+id+' #unitd'+id+'').val();
		else
			continue;
			
		$('#lineitem_'+id+' #extd'+id+'').val(thiscost);
		
		qty = parseInt(thisqty)+qty;
		cost_total = cost_total+thiscost;
	}
	
	$('#lineitems_qty_total').html(qty);
	$('#lineitems_cost_total').html("$"+cost_total);

	$('#total_qty').val(qty);
	$('#total_cost').val(cost_total);
	
}

function filedelete(rowid, filepath)
{
	$('#'+rowid).fadeOut();
	$.ajax({
		type: 'POST',
		url: 'http://www.poignite.com/file/delete/'+filepath
	});

}
