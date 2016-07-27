<div class="page-title">
        <h2>Danh sách của hàng</h2>
      </div>  
      <!-- /.page title -->
       <?php echo $this->Flash->render(); ?>
      <!--Filter and search-->
<div class="pnl panel panel-default">
        <div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
          <h3 class="pnl-title">Bộ lọc dữ liệu <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
        </div>
        <div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
          <div class="filter-container">
          <div id="filter-form" class="form-horizontal form-label-left">
            <form class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tên cửa hàng</label>
                <div class="col-md-3 col-sm-3 col-xs-12 sTextBox">
  
                  <input type="text" id="store_name" class="filter-input form-control" placeholder="Nhập tên cửa hàng" />
                  <div id="autocomplete-container"></div>

                </div>
                <!--
                <label class="control-label col-md-2 col-sm-2 col-xs-12"><span class="rSymbol">※</span><span class="text">Tối đa 50 ký tự</span></label>
                -->
              </div>                    
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Tỉnh/Thành</label>
                <div class="col-md-3 col-sm-3 col-xs-12 oTextBox">
                    <select class="select2_single form-control" tabindex="-1" id="address">
                    <option></option>
                    <option value="AK">Hồ Chí Minh</option>
                    <option value="HI">Hà Nội</option>
                    <option value="CA">Đà Nẵng</option>
                    <option value="NV">Huế</option>
                    <option value="OR">Nha Trang</option>
                    <option value="WA">Đà lạt</option>
                    <option value="AZ">Bình Định</option>                          
                  </select>
              </div>
                 <label class="control-label col-md-2 col-sm-2 col-xs-12"><span class="lSymbol">※</span></label>
              </div>   
               <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Trạng thái</label>
                <div class="col-md-9 col-sm-9 col-xs-12 ckBox">
                <?php echo $this->Form->checkbox('Store.stt', array('ifselect'=>'Y','notselect'=>'N'));?>
                <span class="action">Hoạt động</span>

                </div>
              </div>                 
              <div class="ln_solid"></div>
             <div class="form-group">
                <div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-2">
                  <button id="filter-submit" type="button" class="btn btn-success">Lọc và tìm kiếm</button>
                  <button id="filter-clear" type="button" class="btn btn-default">Xóa bộ lọc</button>
                </div>
              </div>
            </form> 
            </div>          
          </div> 
        </div>
      </div>

      <table id="datatable" class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 5%;">ID</th>
            <th >Cửa hàng</th>
            <th>Địa chỉ</th>
            <th >Phone</th>
            <th >Trạng thái</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="dataTables_empty"></td>
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
      </div>
      <!-- /.datatable -->
      <!-- /.datatable -->

     
      <script type="text/javascript">
          $(document).ready(function() { 

            $(".select2_single").select2({
            placeholder: "Select a state",
            allowClear: true
          });
          $(".select2_group").select2({});
          $(".select2_multiple").select2({
            maximumSelectionLength: 4,
            placeholder: "With Max Selection limit 4",
            allowClear: true
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
              "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'stores', 'action' => 'ajaxData')); ?>",
              "aoColumns": [
                { "sName": "id" },
                { "sName": "store_name" },
                { "sName": "address" },
                { "sName": "telephone" },
                { "sName": "stt" }
              ],
              "columnDefs": [
                {
                  // The `data` parameter refers to the data for the cell (defined by the
                  // `data` option, which defaults to the column being worked with, in
                  // this case `data: 0`. btn btn-xs btn-danger
                  "render": function ( data, type, row ) {
                    return "<a href='<?php echo $this->Html->Url(array('controller' => 'stores', 'action' => 'edit')); ?>/" + row[0] + "' class='btn btn-xs btn-success mr10'>Edit</a><a href='<?php echo $this->Html->Url(array('controller' => 'stores', 'action' => 'delete')); ?>/" + row[0] + "' onclick='return confirm(\"Bạn chắc chắn xóa user " + row[1] + " này?\");' class='btn btn-xs btn-danger'>Delete</a>";
                  },                  
                  "targets": 5,
                  "width": "5%"
                }                
              ]
          });

          //oTable.column(0, { filter: 'applied' }).search('admin').draw();     
          //oTable.fnFilter('admin', 1);       
          $('#filter-form').find('#filter-submit').click(function() {            
            //oTable.fnFilter('admin', 1);           
            var v1 = $('#store_name').val();
            var v2 =  $('#stt').val();
            var item = {};
            if($("#StoreStt").attr('checked') == true)
            {
              item["store_name"]= v1;
              item["stt"] = v2;

              oTable.fnMultiFilter(item); 
            }
            else{
              item["store_name"] = v1;
              oTable.fnMultiFilter(item);
            }

            
           });

          $('#filter-form').find('#filter-clear').click(function() {
            $('#store_name').val('');
            oTable.fnMultiFilter({"store_name": ""});
          });
        });
        </script>
         
