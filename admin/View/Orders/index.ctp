<?php
#test php everything
//print_r($dataOrder);
?>
<!-- page title -->
	<div class="page-title">
	<h2>Danh sách đơn hàng</h2>
	</div>
	<!-- /.page title -->

	<!-- msg box -->
	<?php echo $this->Flash->render(); ?>
	<!-- /.msg box -->
	<!-- filter -->
	<div class="pnl panel panel-default">
		<div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
		<h3 class="pnl-title">Bộ lọc dữ liệu <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
		</div>
		<div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
			<div class="filter-container">
				<div id="filter-form" class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Mã đơn hàng</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="order_no" id="order_no" class="form-control col-md-10" style="float: left;"/>
							<div id="order-autocomplete-container" style="margin-top: 35px;"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Ngày đặt hàng</label>

						<div class="col-md-3 col-sm-3 col-xs-12">
						  <input type="text" id="fromdate" class="form-control" placeholder="Datetime Picker" />
						</div>

						<label class="control-label" style="float: left;">~</label>

						<div class="col-md-3 col-sm-3 col-xs-12">
						  <input type="text" id="todate" class="form-control" placeholder="Datetime Picker" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 col-sm-2 col-xs-12 control-label">PT Thanh toán</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="paymentmethod" value="1"> Thẻ tín dụng
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="paymentmethod" value="2"> Chuyển khoản
								</label>
							</div>
							<div class="checkbox">
							<label>
							  <input type="checkbox" name="paymentmethod" value="3"> Giao hàng trả tiền
							</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-2 col-sm-2 col-xs-12 control-label">Trạng thái</label>
						<div class="col-md-9 col-sm-9 col-xs-12">
							<div class="checkbox">
								<label>
									<input type="checkbox" name="status" value="1"> Chưa xác nhận
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="status" value="2"> Đã xác nhận
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="status" value="3"> Đang giao hàng
								</label>
							</div>
							<div class="checkbox">
								<label>
									<input type="checkbox" name="status" value="4"> Hoàn thành
								</label>
							</div>
								<div class="checkbox">
								<label>
									<input type="checkbox" name="status" value="5"> Đơn hàng đã hủy
								</label>
							</div> 
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Khu vực</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select id="location" class="select2_single form-control"  tabindex="-1">
							<option></option>
							</select>
						</div>
					</div>
					<div class="ln_solid"></div>
					<div class="form-group">
						<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
							<button type="submit" id="filter-submit" class="btn btn-success">Lọc dữ liệu
							</button>
							<button type="button" class="btn btn-default" data-toggle="modal" data-target="#popup">Demo Show Popup</button>
							<button id="filter-clear" type="submit" class="btn btn-default">Xóa bộ lọc</button>
						</div>
					</div>
				</div>
			</div> 
		</div>
	</div>
	<!-- /.filter -->

	<!-- datatable -->
	<table id="datatable" class="table table-bordered">
		<thead>
			<tr>
				<th>Stt</th>
				<th>Mã đơn hàng</th>
				<th>Trạng thái</th>
				<th>Tổng tiền</th>
				<th>Ngày mua</th>
				<th>Khu vực</th>
				<th>Người mua hàng</th>
				<th>Phương thức thanh toán</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="4" class="dataTables_empty">Loading data from server...</td>
			</tr>
		</tbody>
	</table>
	<!-- /.datatable -->
	  
	<!-- modal -->
	  <div id="popup" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
			  <p>One fine body&hellip;</p>
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