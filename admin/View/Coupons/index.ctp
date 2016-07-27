<!-- page title -->
  <div class="page-title">
    <h2>Danh sách Coupon</h2>
  </div>
<!-- /.page title -->
  
<!-- filter -->
  <div class="pnl panel panel-default">
    <div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
      <h3 class="pnl-title">Danh sách Coupon<i id="fa-updown" class="fa fa-chevron-up"></i></h3>
    </div>
    <div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
      <div class="filter-container">
        <form id="filter-form" class="form-horizontal form-label-left">
          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã Coupon</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" name="code" id="code" class="form-control col-md-10" style="float: left;"/>
              <div id="autocomplete-container" style="margin-top: 35px;"></div>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12">Danh mục sản phẩm</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <select id="category_id" class="select2_single form-control" tabindex="-1">
                <option>Tất cả</option>
                <option value="1">Trà xanh Matcha</option>
                <option value="2">Coffee</option>
                <option value="3">Trà cụ</option>
                <option value="4">Dụng cụ pha coffee</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2 col-sm-2 col-xs-12 control-label">Loại coupon</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <div class="checkbox">
                <input id="discount_fixed_price" name="type" type="radio" value="2" checked="checked"/> Theo số tiền
                <input id="discount_rate" name="type" type="radio" value="1" /> Theo % discount
              </div>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2 col-sm-2 col-xs-12 control-label">Ngày sử dụng</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" id="start_date" class="form-control" placeholder="Dately picker" />
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-2 col-sm-2 col-xs-12 control-label">Ngày hết hạn</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" id="end_date" class="form-control" placeholder="Dately picker" />
            </div>
          </div>

          <div class="form-group">
            <div class="col-md-2 col-sm-2 col-xs-12 control-label"></div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="checkbox">
                  <input type="checkbox" value="0" /> Trong thời hạn sử dụng
              </div>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
              <button id="filter-submit" type="submit" class="btn btn-success">Tìm kiếm</button>
              <button id="filter-clear" type="button" class="btn btn-default">Xóa bộ lọc</button>
            </div>
          </div>
        </form>
      </div> 
    </div>
  </div>
  <!-- /.filter -->

  <div class="">
    <div class="button-action">
      <a href="<?php echo $this->Html->Url(array('controller' => 'coupons', 'action' => 'add')); ?>" class="btn btn-success">Tạo coupon</a>
    </div>
  </div>
  
  <!-- datatable -->
  <table id="datatable" class="table table-bordered clearfix">
    <thead>
      <tr>
        <th>ID</th>
        <th>Mã Coupon</th>
        <th>Loại</th>
        <th>Tên Coupon</th>
        <th>Tuỳ chọn</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td colspan="5" class="dataTables_empty">Loading data from server...</td>
      </tr>
    </tbody>
  </table>
  <!-- /.datatable -->
  
  <!-- Modal -->
  <div class="modal fade" id="detailModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Chi tiết Coupon</h4>
        </div>
        <div class="modal-body">
          <?php echo $this->Form->create('Coupon', array(
            'class' => 'form-horizontal form-label-left', 
            'role' => 'form',
            'inputDefaults' => array(
                'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
                'div' => array('class' => 'form-group'),
                'class' => array('form-control col-md-10'),
                'label' => array('class' => 'col-md-3 col-sm-3 col-xs-12 control-label'),
                'between' => '<div class="col-md-3 col-sm-3 col-xs-12">',
                'after' => '</div>',
                'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline'))
            )));
          ?> 
          <?php 
            echo $this->Form->input('name');
            echo $this->Form->input('code');
            echo $this->Form->input('type', array(
              'options'=> array('2' => 'Theo số tiền', '1' => 'Theo tỷ lệ')
            ));
            echo $this->Form->input('start_date', array('type' => 'datepicker'));
            echo $this->Form->input('end_date', array('type' => 'datepicker'));
            echo $this->Form->input('category_id', array(
              'options' => array('1' => 'Trà xanh Matcha', '2' => 'Cà phê', '3' => 'Trà cụ', '4' => 'Dụng cụ pha cà phê')
            ));
            echo $this->Form->input('description');
          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="button" data-dismiss="modal">Đóng lại</button>
        </div>
      </div>
    </div>
  </div>

 <!-- /.datatable -->
  <script type="text/javascript">
    var lst = <?php echo $this->Json->makeCouponJsonAutoComplete($coupons); ?>
  </script>
  <script type="text/javascript">
    $(function() {
      'use strict';
      var couponArr = $.map(lst, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#code').autocomplete({
        lookup: couponArr,
        appendTo: '#autocomplete-container'
      });
    });
  </script>
  <!-- select2 -->
  <script type="text/javascript">
    $(document).ready(function() { 
      $('#start_date').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_3",
        format: 'DD/MM/YYYY'
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });

      $('#end_date').daterangepicker({
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
          "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'coupons', 'action' => 'ajaxData')); ?>",
          "aoColumns": [
            { "sName": "id" },
            { "sName": "code" },
            { "sName": "type" },
            { "sName": "name" }
          ],
          "columnDefs": [
          {
            // The `data` parameter refers to the data for the cell (defined by the
            // `data` option, which defaults to the column being worked with, in
            // this case `data: 0`. btn btn-xs btn-danger
            "render": function ( data, type, row ) {
              return "<button id='filter-submit' data-toggle='modal' data-target='#detailModal' class='btn btn-xs btn-success mr10'>Chi tiết</button><a href='<?php echo $this->Html->Url(array('controller' => 'coupons', 'action' => 'edit')); ?>/" + row[0] + "' class='btn btn-xs btn-success mr10'>Edit</a><a href='<?php echo $this->Html->Url(array('controller' => 'coupons', 'action' => 'delete')); ?>/" + row[0] + "' onclick='return confirm(\"Bạn chắc chắn xóa coupons " + row[1] + " này?\");' class='btn btn-xs btn-danger'>Delete</a>";
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
        var v1 = $('#code').val();
        var v2 = $('#category_id').val();
        var v3 = $('#type').val();
        var v4 = $('#start_date').val();
        var v5 = $('#end_date').val();
        
        var item = {};

        item["code"] = v1;
        item["category_id"] = v2;
        item["type"] = v3;
        item["start_date"] = v4;
        item["end_date"] = v5;
        
        oTable.fnMultiFilter(item);
      });

      $('#filter-form').find('#filter-clear').click(function() {
        $('#code').val('');
        $('#category_id').val('');
        $('#type').val('');
        $('#start_date').val('');
        $('#end_date').val('');
        oTable.fnMultiFilter({"code": "", "category_id":"", "type": "", "start_date":"", "end_date": "" });
      });
    });
  </script>