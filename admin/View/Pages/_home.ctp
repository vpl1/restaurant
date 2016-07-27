<!-- page title -->
      <div class="page-title">
        <h2>Danh sách đơn hàng</h2>        
      </div>
      <!-- /.page title -->

      <!-- msg box -->
      <div class="alert alert-success" role="alert">
        <strong>Well done!</strong> Thông báo hiển thị khi tương tác thành công
      </div>
      <div class="alert alert-danger" role="alert">
        <strong>Oh snap!</strong> Thông báo hiển thị khi tương tác bị lỗi
      </div>
      <!-- /.msg box -->
      
      <!-- filter -->
      <div class="pnl panel panel-default">
        <div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
          <h3 class="pnl-title">Bộ lọc dữ liệu <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
        </div>
        <div id="filterblock" class="pnl-body collapse in" aria-expanded="true">
          <div class="filter-container">
            <form class="form-horizontal form-label-left">
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Mã đơn hàng</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <input type="text" name="country" id="autocomplete-custom-append" class="form-control col-md-10" style="float: left;" placeholder="#00001 (Autocomplete Input)" />
                  <div id="autocomplete-container" style="margin-top: 35px;"></div>
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
                      <input type="checkbox" value=""> Thẻ tín dụng
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> Chuyển khoản
                    </label>
                  </div>                       
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> Giao hàng trả tiền
                    </label>
                  </div>                       
                </div>
              </div>  
              <div class="form-group">
                <label class="col-md-2 col-sm-2 col-xs-12 control-label">Trạng thái</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> Chưa xác nhận
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> Đã xác nhận
                    </label>
                  </div>                       
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> Đang giao hàng
                    </label>
                  </div>                       
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> Hoàn thành
                    </label>
                  </div>                       
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> Đơn hàng đã hủy
                    </label>
                  </div>                       
                </div>
              </div>   
              <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Khu vực</label>
                <div class="col-md-3 col-sm-3 col-xs-12">
                  <select class="select2_single form-control" tabindex="-1">
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
              </div>                 
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                  <button type="submit" class="btn btn-success">Lọc dữ liệu</button>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#popup">Demo Show Popup</button>
                </div>
              </div>
            </form>           
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
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>00001</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>2</td>
            <td>00002</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr class="order-cancel">
            <td>3</td>
            <td>00003</td>
            <td>Hủy</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>4</td>
            <td>00004</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>5</td>
            <td>00005</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>6</td>
            <td>00006</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>7</td>
            <td>00007</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>8</td>
            <td>00008</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>9</td>
            <td>00009</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>10</td>
            <td>00010</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>11</td>
            <td>00011</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>12</td>
            <td>00012</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>13</td>
            <td>00013</td>
            <td>Hủy</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>14</td>
            <td>00014</td>
            <td>Chưa xác nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>15</td>
            <td>00015</td>
            <td>Đã nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>16</td>
            <td>00016</td>
            <td>Đã nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>17</td>
            <td>00017</td>
            <td>Đã nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>18</td>
            <td>00018</td>
            <td>Đã nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>19</td>
            <td>00019</td>
            <td>Đã nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
          </tr>
          <tr>
            <td>20</td>
            <td>00020</td>
            <td>Đã nhận</td>
            <td>100000 đ</td>
            <td>04/26/2016</td>
            <td>TP Hồ Chí Minh</td>
            <td>Nguyễn Văn A</td>
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

      <div class="footer">
        Copyright by Bonakitchen 2016
      </div>