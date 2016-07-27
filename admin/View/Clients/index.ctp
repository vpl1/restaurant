      <!-- page title -->
      <div class="page-title">
        <h2>Danh sách khách hàng</h2>        
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
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text" name="name" id="name" class="filter-input form-control col-md-10" style="float: left;" placeholder="" />
                  <div id="autocomplete-container" style="margin-top: 35px;"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Email</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text" name="email" id="email" class="filter-input form-control col-md-10" style="float: left;" placeholder="" />
                  <div id="autocomplete-container" style="margin-top: 35px;"></div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Số điện thoại</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text" name="tel" id="tel" class="filter-input form-control col-md-10" style="float: left;" placeholder="" />
                  <div id="autocomplete-container" style="margin-top: 35px;"></div>
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

      <!-- datatable -->
      <table id="datatable" class="table table-bordered">
        <thead>
          <tr>
            <th>Stt</th>
            <th>Họ tên</th>        
            <th>Từ năm</th>
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

      <div id="popup" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Thông tin thành viên</h4>
            </div>
            <div class="modal-body">
              <div class="form-horizontal form-label-left">
                <?php echo $this->Form->create('Client', array(
                  'class' => 'form-horizontal form-label-left', 
                  'role' => 'form',
                  'inputDefaults' => array(
                      'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                      'div' => array('class' => 'form-group'),
                      'class' => array('form-control col-md-10'),
                      'label' => array('class' => 'col-md-2 col-sm-2 col-xs-12 control-label'),
                      'between' => '<div class="col-md-3 col-sm-3 col-xs-12">',
                      'after' => '</div>',
                      'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
                  ))); ?>
                  <?php echo $this->Form->input('last_name');
                        echo $this->Form->input('email');                
                  ?>
                <?php echo $this->Form->end(); ?>
            </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->

      <script type="text/javascript">
        var lst = <?php echo $this->Json->makeClientJsonAutoComplete($clients); ?>
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
          $('#name').autocomplete({
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

          var oTable=$('#datatable').dataTable({              
              "bProcessing": true,
              "bServerSide": true,
              "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'ajaxData')); ?>",
              "aoColumns": [
                { "sName": "id" },
                { "sName": "first_name" },
                { "sName": "created_date" }
              ],
              "columnDefs": [
                {
                  // The `data` parameter refers to the data for the cell (defined by the
                  // `data` option, which defaults to the column being worked with, in
                  // this case `data: 0`. btn btn-xs btn-danger
                  "render": function ( data, type, row ) {
                    return "<a href= '<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'view')); ?>/" + row[0] + "' class='btn btn-xs btn-success mr10' >Chi tiết</a><a href='<?php echo $this->Html->Url(array('controller' => 'clients', 'action' => 'delete')); ?>/" + row[0] + "' onclick='return confirm(\"Bạn chắc chắn xóa khách hàng " + row[1] + " này?\");' class='btn btn-xs btn-danger'>Delete</a>";
                  },                  
                  "targets": 3,
                  "width": "10%"
                }                
              ]
          });
          $('#filter-form').find('#filter-submit').click(function() {            
            //oTable.fnFilter('admin', 1);           
            var v1 = $('#name').val();
            var v2 = $('#email').val();
            var v3 = $('#tel').val();
            
            var item = {};

            item["last_name"] = v1;
            item["email"] = v2;
            item["phone1"] = v3;
            //item["phone2"] = v3;
            oTable.fnMultiFilter(item);    
          });

          $('#filter-form').find('#filter-clear').click(function() {
            $('#name').val('');
            $('#email').val('');
            $('#tel').val('');
            oTable.fnMultiFilter({"last_name": "", "email": "", "phone1":""});
          });
        
        });
      </script>