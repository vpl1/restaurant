<!-- page title -->
      <div class="page-title">
        <h2>Phí vận chuyển theo khu vực</h2>
      </div>
      <!-- /.page title -->
      <!--Filter and search-->
    <div class="pnl panel panel-default">
        <div class="pnl-head" data-toggle="collapse" href="#filterblock" aria-expanded="true" aria-controls="filterblock">
          <h3 class="pnl-title">Bộ lọc dữ liệu <i id="fa-updown" class="fa fa-chevron-up"></i></h3>
          <table class="table tbSearch">
            <thead>
            <tr>
              <th class="Texttb">Tìm kiếm</th>
            </tr>
            <tr>
               <td class="tdSearch">
                 <div class="form-group">
                    <label class="control-label col-md-2 col-sm-2 col-xs-12 lbText">Phí vận chuyển</label>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                    <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
                      <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
                    </div>
                <div class="col-md-3 col-sm-3 col-xs-12 TextSearch">
                  <p>đ</p>
                </div>
                <div class="form-group formSearch">
                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
                   <?php 
                    $input_all = array(
                  'label' => 'Nhập tất cả',
                  
                      'class' => 'btn btn-success btnShip'
                  
                    );
                    echo $this->Form->end($input_all);

                    $free_all = array(
                        'label' => 'Miễn phí toàn bộ',
                        
                            'class' => 'btn btn-success btnShip btnCancel'
                        
                    );
                    echo $this->Form->end($free_all);

                  ?>
                   
                   
                  </div>
                </div>
            </td>
            </tr>
          </thead>
          <tbody>
           
          </tbody>
        </table>
        </div>
       </div> 
      
      <!-- datatable -->
      <table id="datatable" class="table table-bordered">
      
        <thead>
          <tr>
            <th class="Texttb th1">Khu vực</th>
            <th class="Texttb th2">Phí vận chuyển</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
              <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                  <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>
                                        
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
              <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                  <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>           
            </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
             <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                  <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>               
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
             <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
             <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>            
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
              <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                 <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>            
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
             <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
             <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                 <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>           
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
              <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>          
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
              <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                 <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>             
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
              <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                  <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>        
                </div>
            </td>
          </tr>
           <tr>
            <td class="Texttb">Hà Nội</td>
            <td>
            <div class="col-md-9 col-sm-9 col-xs-12 tbCheckbox">
              <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 prForm">
              <?php echo  $this->Form->input('fee',array('div' => false,'label' => false,'class'=>'form-control col-md-10 phone'));?>
              <div id="autocomplete-container" style="margin-top: 35px;"><div class="autocomplete-suggestions" style="position: absolute; display: none; max-height: 300px; z-index: 9999;"></div></div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 tbText">
              <p>đ</p>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12 checkbox_free">
                 <?php echo $this->Form->checkbox('checkbox', array('hiddenField' => false));?><span class="freeText">Miễn Phí</span>            
                </div>
            </td>
          </tr>
        </tbody>
      </table>
      <!-- /.datatable -->
      <div class="form-group svButton">
        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-2">
         <?php 
            $btnSave = array(
          'label' => 'Lưu',
          
              'class' => 'btn btn-success'
          
            );
            echo $this->Form->end($btnSave);

          ?>
        </div>
      </div>

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