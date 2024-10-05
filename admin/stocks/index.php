<?php include_once("outofstock.php");
include_once("TwoBin.php");
include_once("customalert.php");
?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Stocks</h3>
        <!-- <div class="card-tools">
			<a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
                    <colgroup>
                        <col width="5%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="15%">
						<col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Supplier</th>
                            <th>Description</th>
                            <th>Available Stocks</th>
							<th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT i.*,s.name as supplier FROM `item_list` i inner join supplier_list s on i.supplier_id = s.id order by `name` desc");
                        while($row = $qry->fetch_assoc()):
                            $in = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 1")->fetch_array()['total'];
                            $out = $conn->query("SELECT SUM(quantity) as total FROM stock_list where item_id = '{$row['id']}' and type = 2")->fetch_array()['total'];
                            $row['available'] = $in - $out;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['supplier'] ?></td>
                                <td><?php echo $row['description'] ?></td>
                                <td class="text-right"><?php echo number_format($row['available']) ?></td>
								<td>
								<?php 
								echo "<script>
								var avNumber = parseInt(".$row['available'].");
								var flag = validate_outOfStock('".$row['name']."',avNumber);
								console.log('flag'+flag);
								if(flag == 1){
									document.write(`<span style='background-color:red;padding:5px;border-radius:5%;color:white;'>Almost out of Stock</span>`);
								}
								else{
									document.write('');
								}
									console.log('minstock:'+Math.abs(150/3));
								var mainBin = new  Bin(150,Math.min(150,avNumber));
								var mainFlag = mainBin.isLowStock(Math.abs(150/3));
								var sub = avNumber-150;
								if(sub <=0){
								var safeBin = new Bin(100,0);
						}
								else{
								var safeBin = new  Bin(100,Math.min(100,sub));
						}
								var safeFlag = safeBin.isLowStock(Math.abs(100/3));
								console.log(mainFlag);
								if(mainFlag){
								showAlert('The stock of ".$row['name']." is below average!');
								}
								else if(safeFlag){
								showAlert('The stock of ".$row['name']." is below average!');
								}
							</script>";
								?>
									</td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Received Orders permanently?","delete_receiving",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Receiving Details","receiving/view_receiving.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable();
	})
	function delete_receiving($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_receiving",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>