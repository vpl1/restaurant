<?php
#test php everything
print_r($bsData);
print_r($dtOrderData);
?>
<!-- page title -->
	<div class="page-title">
	<h2>Chi tiết đơn hàng</h2>
	</div>
	<!-- /.page title -->

	<!-- msg box -->
	<?php echo $this->Flash->render(); ?>  
	<!-- /.msg box -->
	<!-- thongtincoban -->
	<div class="pnl panel panel-default">
		<div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
		<h3 class="pnl-title">Thông tin cơ bản <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
		</div>
		<div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
			<div class="filter-container">
				<div id="filter-form" class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Mã đơn hàng</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="checkbox">
								<span><?php echo $bsData['Order']['order_no']?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Ngày đặt hàng</label>

						<div class="col-md-3 col-sm-3 col-xs-12">
							<div class="checkbox">
						 		<span>
						 			<?php 
					 					$timestamp = strtotime($bsData['Order']['order_date']);
					 					echo date('d-m-Y' , $timestamp);
				 					?>
						 		</span>
						 	</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 col-sm-2 col-xs-12 control-label">PT Thanh toán</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="checkbox">
								<span><?php echo $bsData['0']['paymethod']?></span>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 col-sm-2 col-xs-12 control-label">Trạng thái</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							
							<div class="checkbox">
								<span><?php echo $bsData['0']['status']?></span>
							</div>
							<div class="checkbox">
								<a href="#" data-toggle="modal" data-target="#popup">Cập nhật trạng thái</a>
							</div> 
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Số tiền thanh toán</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<span><?php echo $bsData['Order']['total'].'đ' ?></span>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<!-- /.thongtincoban -->

	<!--noidungdonhang-->
	<div>
		
		<h4 class="pnl-title">Nội dung đơn hàng </h4>
		<table id="datatable" class="table table-bordered">
			<thead>
				<tr>
					<th>Mã sản phẩm</th>
					<th>Tên sản phẩm</th>
					<th>Giá tiền</th>
					<th>Số lượng</th>
					<th>Thành tiền</th>
				</tr>
			</thead>
			<tbody> 
				<?php foreach ($dtOrderData as $key => $value) {
					echo '<tr>
							<td>'.$value['order_item']['item_no'].'</td>
							<td>'.$value['order_item']['item_name'].'</td>
							<td>'.$value['order_item']['item_prc'].'</td>
							<td>'.$value['order_item']['item_cnt'].'</td>
							<td>'.$value['0']['total_price'].'</td>
						</tr>';
					}//end foreach 
				?>
			</tbody>
		</table>
		<div class="moneyDetail" style="float:right">
			<ul>
				<li>
					<label> Tổng số tiền hàng </label>
					<span><?php echo $bsData['Order']['total'].'đ'?></span>
				</li>
				<li>
					<label title=""> Giảm giá <?php echo $bsData['Order']['discount'].'%'?> </label>
					<span><?php echo '-'.$bsData['Order']['discount']*$bsData['Order']['total']/100 .'đ'?> </span>
				</li>
				<li>
					<label title=""> Sử dụng điểm 1điểm =<?php echo $bsData['Order']['recv_point'] ?></label>
					<span>-<?php echo $bsData['Order']['recv_point']*$bsData['Order']['used_point'].'đ' ?> (<?php echo $bsData['Order']['used_point'].'điểm'?>) </span>
				</li>
				<li>
					<label title=""> Phí giao hàng </label> 
					<span>20.000đ</span>
				</li>
				<li>
					<label title=""> Tổng cộng </label> 
					 <strong><?php echo $bsData['Order']['sub_total'].'đ' ?></strong>
				</li>
			</ul>
		</div>
		<div class="clear"></div>
		<!-- thongtinnguoimua -->
		<div class="infor_user">
			<div class="billingInfo flL">
				<div class="title">
					<h2>Thông tin người mua</h2>
				</div>
				<ul>
					<li>
						<label> Họ và tên: </label>
						<span><?php echo $bsData['p']['purchasers_first_name'].' '.$bsData['p']['purchasers_last_name']?></span>
					</li>
					<li>
						<label title=""> Địa chỉ:</label>
						<span><?php echo $bsData['p']['purchaser_add']?></span>
					</li>
					<li>
						<label title=""> Điện thoại:  </label>
						<span><?php echo $bsData['p']['purchaser_phone']?> </span>
					</li>
					<li>
						<label title=""> Email: </label> 
						<span><?php echo $bsData['p']['purchaser_email']?></span>
					</li>
					<li>
						<label title=""> Thành viên từ: </label> 
						<span><?php 
						 			$timestamp = strtotime($bsData['p']['purchaser_created_date']);
					 					echo date('d-m-Y' , $timestamp);
								?>
						</span>
					</li>
				</ul>
			</div>
			<div class="shippingInfo flL">
				<div class="title">
					<h2>Thông tin người nhận</h2>
				</div>
				<ul>
					<li>
						<label> Họ và tên: </label>
						<span><?php echo $bsData['od']['order_delivers_first_name'].' '.$bsData['od']['order_delivers_last_name']?></span>
					</li>
					<li>
						<label title=""> Địa chỉ:</label>
						<span><?php echo $bsData['od']['order_delivers_add']?></span>
					</li>
					<li>
						<label title=""> Điện thoại:  </label>
						<span><?php echo $bsData['od']['order_delivers_phone']?> </span>
					</li>
				</ul>
			</div>
		</div>
	<?php 
					echo $this->Form->create('Order', array(
			          'url'   => array(
			               'controller' => 'orders','action' => 'updateStatus'
			           ), 
			          'id'    => 'update-status', 
			          'class' =>'panel-body wrapper-lg'
			       ));
					echo $this->Form->input('name');
					echo $this->Form->submit('Save');
					echo $this->Form->end(); 
				?>
				<script type="text/javascript">
			    $(document).ready(function () {
			        $('#update-status').submit(function(){
			            //serialize form data
			            var formData = $(this).serialize();
			            //get form action
			            var formUrl = $(this).attr('action');
			            
			            $.ajax({
			                type: 'POST',
			                url: formUrl,
			                data: formData,
			                success: function(data,textStatus,xhr){
			                        alert(data);
			                },
			                error: function(xhr,textStatus,error){
			                        alert(textStatus);
			                }
			            });	
			                
			            return false;
			        });
    });
</script>
	<!-- /.thongtinnguoimua -->
	</div>
	<!--/.noidungdonhang--> 
	<!-- modal -->
	  <div id="popup" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<?php 
					echo $this->form->create('Order',array('action'=>'updateStatus','id'=>'saveForm'));
					echo $this->form->input('name');
					echo $this->form->submit('Save');
					echo $this->form->end(); 
				?>
				<!-- <form>
					<ul>
						<li>
							<label for="name">Trang thái:</label> <span>Chờ xác nhận</span>
						</li>
						<li>
							<label for="update">Cập nhật tới</label>
							<select>
								<option value="2">Đơn hàng xác nhận</option>
								<option value="3">Đơn hàng đang chuyển</option>
								<option value="4">Đơn hàng hoàn thành</option>
							</select>
						</li>
					</ul>
				</form> -->
			</div>
			<div class="modal-footer">
			  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			  <button type="button" class="btn btn-success">Save changes</button>
			</div>
		  </div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	  </div><!-- /.modal -->
	<script type="text/javascript">
		var lst = <?php echo $this->Json->makeJsonAutoCompleteOrderNo($dataOrder); ?>;
		//console.log(lst);
		var llc = <?php echo $this->Json->makeJsonLoadLocation($dataOrder); ?>;
		//console.log(llc);
	</script>
	<script type="text/javascript">
		$(function() {
			'use strict';
			var orderArr = $.map(lst, function(value, key) {
				return {
					value: value,
					data: key
				};
			});
			// Initialize autocomplete with custom appendTo:
			$('#order_no').autocomplete({
				lookup: orderArr,
				appendTo: '#order-autocomplete-container'
			});
			var locationArr = $.map(llc, function(value, key) {
				return {
					value: value,
					data: key
				};
		  	});
		  // Initialize location with custom appendTo:
			$.each(locationArr, function (i, item) {
				$('#location').append($('<option>', { 
				  value: item.value,
				  text : item.value 
				}));
			});
		});
	</script>
	  <!-- select2 -->
	<script type="text/javascript">
		$(document).ready(function() { 
			$('#fromdate').daterangepicker({
				singleDatePicker: true,
				calender_style: "picker_3",
				format: 'DD/MM/YYYY'
				}, function(start, end, label) {
				console.log(start.toISOString(), end.toISOString(), label);
			});

			$('#todate').daterangepicker({
				singleDatePicker: true,
				calender_style: "picker_3",
				format: 'DD/MM/YYYY'
				}, function(start, end, label) {
				console.log(start.toISOString(), end.toISOString(), label);
			});

			var oTable = $('#datatable').dataTable({
				"bProcessing": true,
				"bServerSide": true,
				"sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'orders', 'action' => 'ajaxData')); ?>",
				"aoColumns": [
					{ "sName": "id" },
					{ "sName": "order_no" },
					{ "sName": "status" },
					{ "sName": "total" },
					{ "sName": "order_date" },
					{ "sName": "location_name" },
					{ "sName": "fullname" },
					{ "sName": "payment_method" }
				],
			});

			$('#filter-form').find('#filter-submit').click(function() {            
				//oTable.fnFilter('admin', 1);
				var item = {};
				var v1 = $('#order_no').val();
				var v2 = new Array(); // initialize empty array 
				var v3 = $('#fromdate').val() + '~' + $('#todate').val();
				var v4 = new Array();
				var v5 = $('#location').val();

				item["order_no"] = v1;

				$("input:checkbox[name=status]:checked").each(function() {
					v2.push($(this).val());
				});
				if (v2.length >0){
					item['status'] = v2;
				}else{
					item['status'] = null;
				}

				if($('#fromdate').val() != '' && $('#todate').val() != '') {
					item["order_date"] = v3;
				}

				$("input:checkbox[name=paymentmethod]:checked").each(function() {
					v4.push($(this).val());
				});
				if (v4.length >0){
					item['payment_method'] = v4;
				}else{
					item['payment_method'] = null;
				}

				if (v5 !=''){
					item['location_name'] = v5;
				}
				oTable.fnMultiFilter(item);    
			});
	  
			$('#filter-form').find('#filter-clear').click(function() {
				$('#order_no').val('');
				$('#location').val('');
				$('#fromdate').val('');
				$('#todate').val('');
				oTable.fnMultiFilter({"order_no": "", "location_name": "", "order_date":""});
			});
		});
	</script>