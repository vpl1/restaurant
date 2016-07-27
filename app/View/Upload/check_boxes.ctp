<table class="table-striped">
    <tr>
        <th><input type="checkbox" name="checkAll" onclick="CheckAllClicked(this)" value="All">All</th>
        <th>Column 1</th>
        <th>Column 1</th>
        <th>Column 1</th>
        <th>Column 1</th>
    </tr>
    <?php
    for ($i=0;$i<10;$i++)
    {
        echo "<tr><td><input type='checkbox' name='checkItem' value='All' style='margin:4px 10px 0px 0px;'>Check</td><td>row ".($i+1)." ;  Column 1</td><td>row ".($i+1)." ;  Column 2</td><td>row ".($i+1)." ;  Column 3</td><td>row ".($i+1)." ;  Column 4</td></tr>";;
    }
    ?>
    
</table>
<input type="button" style="background-color: #0088cc; height: 70px; width: 120px;" value="DeleteAll" onclick="DeleteAllClick()">

<script>
function CheckAllClicked(ctrl)
    {
        

        var checkBoxes= document.getElementsByName("checkItem");


        //count ratio of ctrl check and uncheck

        var checkedNum=0;

        for(var i=0;i<checkBoxes.length;i++){
            if(checkBoxes[i].checked)
                checkedNum++;
        }

        var checkAll=true;
        if(checkedNum>5)
            checkAll=false;

            
        for(var i=0;i<checkBoxes.length;i++)
        {
            checkBoxes[i].checked=checkAll;
        }
        ctrl.checked=checkAll;
    }

function DeleteAllClick()
    {
        var checkBoxes= document.getElementsByName("checkItem");
        for(var i=0;i<checkBoxes.length;i++){
            if(checkBoxes[i].checked)
            {
                checkBoxes[i].parentNode.parentNode.remove();
            }
        }
        if(checkBoxes.length>0)
        {
            DeleteAllClick();
        }
    }
</script>
