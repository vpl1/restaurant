      <!-- page title -->
      <div class="page-title">
        <h2>Danh sách sản phẩm</h2>        
      </div>
      <!-- /.page title -->
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
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên sản phẩm</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text" name="name" id="name" class="filter-input form-control col-md-10" style="float: left;" placeholder="" />
                  <div id="autocomplete-container" style="margin-top: 35px;"></div>
                </div>
              </div>                                                                                         
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Danh mục sản phẩm</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <select id="role" class="filter-select select2_single form-control" tabindex="-1">
                    <option value="">Root</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Trạng thái</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="radio" name="invisible" id="instock" value="1"><label for="instock">Còn hàng</label>
                  <input type="radio" name="invisible" id="outstock" value="2"><label for="instock">Hết hàng</label>
                  <input type="radio" name="invisible" id="all" value="0"><label for="instock">Tất cả</label>
                </div>
              </div>              
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2">
                  <button id="filter-submit" type="button" class="btn btn-success">Lọc và tìm kiếm</button>
                </div>
              </div>
            </div>           
          </div> 
        </div>
      </div>
      <!-- /.filter -->
      <div class="button-action">
        <a href="<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'add')); ?>" class="btn btn-success">Thêm mới User</a>
      </div>
      <!-- datatable -->
      <table id="datatable" class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 70px;">Id</th>
            <th>Username</th>
            <th>Role</th>
            <th>Ngày tạo</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td colspan="4" class="dataTables_empty">Loading data from server...</td>
          </tr>          
        </tbody>
      </table>
      
      <!-- /.datatable -->
      <script type="text/javascript">
        var lst = <?php echo $this->Json->makeJsonAutoComplete($users); ?>
      </script>
      <script type="text/javascript">
        $(function() {
          'use strict';
          var userArr = $.map(lst, function(value, key) {
            return {
              value: value,
              data: key
            };
          });
          // Initialize autocomplete with custom appendTo:
          $('#username').autocomplete({
            lookup: userArr,
            appendTo: '#autocomplete-container'
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

          $('#filterblock').on('hidden.bs.collapse', function () {          
            $('#fa-updown').removeClass('fa-chevron-up');
            $('#fa-updown').addClass('fa-chevron-down');
          });

          $('#filterblock').on('shown.bs.collapse', function () {          
            $('#fa-updown').removeClass('fa-chevron-down');
            $('#fa-updown').addClass('fa-chevron-up');
          });

          var oTable = $('#datatable').dataTable({              
              "bProcessing": true,
              "bServerSide": true,
              "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'ajaxData')); ?>",
              "aoColumns": [
                { "sName": "id" },
                { "sName": "username" },
                { "sName": "role" },
                { "sName": "created" }
              ],
              "columnDefs": [
                {
                  // The `data` parameter refers to the data for the cell (defined by the
                  // `data` option, which defaults to the column being worked with, in
                  // this case `data: 0`. btn btn-xs btn-danger
                  "render": function ( data, type, row ) {
                    return "<a href='<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'edit')); ?>/" + row[0] + "' class='btn btn-xs btn-success mr10'>Edit</a><a href='<?php echo $this->Html->Url(array('controller' => 'users', 'action' => 'delete')); ?>/" + row[0] + "' onclick='return confirm(\"Bạn chắc chắn xóa user " + row[1] + " này?\");' class='btn btn-xs btn-danger'>Delete</a>";
                  },                  
                  "targets": 4,
                  "width": "10%"
                }                
              ]
          });

          //oTable.column(0, { filter: 'applied' }).search('admin').draw();     
          //oTable.fnFilter('admin', 1);       


          $('#filter-form').find('#filter-submit').click(function() {            
            //oTable.fnFilter('admin', 1);           
            var v1 = $('#username').val();
            var v2 = $('#role').val();
            var v3 = $('#fromdate').val() + '~' + $('#todate').val();
            
            var item = {};

            item["username"] = v1;
            item["role"] = v2;

            if($('#fromdate').val() != '' && $('#todate').val() != '') {
              item["created"] = v3;
            }
            
            oTable.fnMultiFilter(item);    
          });

          $('#filter-form').find('#filter-clear').click(function() {
            $('#username').val('');
            $('#role').val('');
            $('#fromdate').val('');
            $('#todate').val('');
            oTable.fnMultiFilter({"username": "", "role": "", "created":""});
          });
        });
      </script>