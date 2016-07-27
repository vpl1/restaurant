<!-- Content Header (Page header) -->
	<section class="content-header">
		<!-- page title -->
		<h1>
		Quản lý Gallery
		</h1>
		<!-- /.page title -->
		<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Index</a></li>
		<li class="active">Dashboard</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<?php echo $this->Flash->render(); ?>
		<!-- filter -->
		<div class="pnl panel panel-default">        
			<div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
				<h3 class="pnl-title">Bộ lọc dữ liệu <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
			</div>
			<div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
			  <div class="filter-container">
				<div id="filter-form" class="form-horizontal form-label-left">
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Username</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" name="username" id="username" class="filter-input form-control col-md-10" style="float: left;" placeholder="" />
							<div id="autocomplete-container" style="margin-top: 35px;"></div>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2 col-sm-2 col-xs-12">Ngày tạo tài khoản</label>

						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" id="fromdate" class="filter-input form-control" placeholder="Ngày bắt đầu" />
						</div>

						<label class="control-label" style="float: left;">~</label>

						<div class="col-md-3 col-sm-3 col-xs-12">
							<input type="text" id="todate" class="filter-input form-control" placeholder="Ngày kết thúc" />
						</div>
					</div>
					<div class="form-group">
					<label class="control-label col-md-2 col-sm-2 col-xs-12">Role</label>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<select id="role" class="filter-select select2_single form-control" tabindex="-1">
								<option value="">Tất cả</option>
								<option value="admin">admin</option>
								<option value="staff">staff</option>
							</select>
						</div>
					</div>
					<div class="ln_solid"></div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2">
								<button id="filter-submit" type="button" class="btn btn-success">Lọc dữ liệu</button>
								<button id="filter-clear" type="button" class="btn btn-default">Xóa bộ lọc</button>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div>
		<!-- /.filter -->
		<a href="<?php echo $this->Html->Url(array('controller'=>"galleries", "action"=>"add")); ?>" class="btn btn-large btn-success btn-add">Add gallery</a>
		<!-- datatable -->
		<table id="datatable" class="table table-bordered">
			<thead>
				<tr>
					<th style="width: 70px;">Id</th>
					<th>Gallery Name</th>
					<th>Gallery Category</th>
					<th>Created Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td colspan="4" class="dataTables_empty">Loading data from server...</td>
				</tr>
			</tbody>
		</table>
		<!-- /.datatable -->
	</section><!-- /.content -->

	<script type="text/javascript">
		
	</script>
	<script type="text/javascript">

	$(document).ready(function() { 
		var DataTable = <?php echo json_encode($gallery); ?>;
		var DataSet = [];
		var detail = [];
		for(var index in DataTable){
			detail = [];
			detail.push(DataTable[index]["Gallery"]["id"]);
			detail.push(DataTable[index]["Gallery"]["title"]);
			detail.push(DataTable[index]["GalleryCategoryJoin"]["title"]);
			detail.push(DataTable[index]["Gallery"]["created_date"]);
			DataSet.push(detail);
		}
		if(DataSet.length != 0){
			var oTable = $('#datatable').dataTable({              
				"data": DataSet,
				"aoColumns": [
				{ "sName": "id" },
				{ "sName": "name" },
				{ "sName": "category" },
				{ "sName": "created" }
				],
				"columnDefs": [
				{
					// The `data` parameter refers to the data for the cell (defined by the
					// `data` option, which defaults to the column being worked with, in
					// this case `data: 0`. btn btn-xs btn-danger
					"render": function ( data, type, row ) {
					return "<a href='<?php echo $this->Html->Url(array('controller' => 'galleries', 'action' => 'edit')); ?>/" + row[0] + "' class='btn btn-xs btn-success mr10'>Edit</a><a href='<?php echo $this->Html->Url(array('controller' => 'galleries', 'action' => 'delete')); ?>/" + row[0] + "' onclick='return confirm(\"Bạn chắc chắn xóa gallery " + row[1] + " này?\");' class='btn btn-xs btn-danger'>Delete</a>";
				  },
				  "targets": 4,
				  "width": "10%"
				}
				],
				"order": [[ 3, "desc" ]]
			});
		}else{
			$("#datatable").find(".dataTables_empty").text("No have Data, Please add gallery");
		}		
	});
	</script>