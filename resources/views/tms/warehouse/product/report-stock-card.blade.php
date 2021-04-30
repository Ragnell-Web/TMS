<?php ini_set('memory_limit', '-1'); ?>

<style>
  table {
    width: 100%;
    border-collapse: collapse;
  }

  .header{
    width: 50% !important;
  }

  .no-padding{
    padding: 2px 10px 2px 10px;
  }

  table, th, td{
    padding: 4px;
    border: 1px solid #111;
  }

  .align-right{
    text-align: right;
  }

  .align-center{
    text-align: center;
  }
  
  .table-font{
	  font-size: 12px;
  }

  .title-container {
    width: 100%;
    text-align:center;
    font-size: 22px;
  }

  .title {
    text-decoration: underline;
  }
</style>

<div class="title-container">
  <h4 class="title">Detail Stock Card - 92</h4>
</div>

<div>
  <table class="header table-font">
    <tr>
      <td class="no-padding" width="30%">Itemcode</td>
      <td class="no-padding" width="70%"><?php echo $item[0]['ITEMCODE']; ?></td>
    </tr>
    <tr>
      <td class="no-padding" width="30%">Description</td>
      <td class="no-padding" width="70%"><?php echo $item[0]['PART_NO'].' / '.$item[0]['DESCRIPT'].' / '.$item[0]['DESCRIPT1']; ?></td>
    </tr>
	<tr>
      <td class="no-padding" width="30%">Status / Unit</td>
      <td class="no-padding" width="70%"><?php echo $item[0]['STATE'].' / '.$item[0]['UNIT']; ?></td>
    </tr>
  </table>
</div>

<table class="table-font">
  <thead>
    <tr class="align-center">
      <th>No.</th>
      <th>Date</th>
      <th>Description</th>
      <th>In</th>
      <th>Out</th>
      <th>Balance</th>
    </tr>
  </thead>

  <tbody>
  <?php
  $total_in   = 0;
  $total_out  = 0;
  for($i = 0; $i < count($data); $i++){
    echo "<tr>";
    echo "<td>".$data[$i]->rownumber."</td>";
    echo "<td>".$data[$i]->action_date."</td>";
    echo "<td>".$data[$i]->remark."</td>";
    echo "<td class='align-right'>".$data[$i]->debit."</td>";
    echo "<td class='align-right'>".$data[$i]->credit."</td>";
    echo "<td class='align-right'>".$data[$i]->balance."</td>";
    echo "</tr>";
    $total_in = $total_in + $data[$i]->debit;
    $total_out = $total_out + $data[$i]->credit;
    if($i == count($data) - 1){
      echo "<tr>";
      echo "<td colspan=3 class='align-right'><b>Total In / Out</b></td>";
      echo "<td class='align-right'><b>".$total_in."</b></td>";
      echo "<td class='align-right'><b>".$total_out."</b></td>";
      echo "<td class='align-right'></td>";
      echo "</tr>";
    }
  }
  ?>
  </tbody>
</table>
