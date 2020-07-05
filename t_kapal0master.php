<?php
namespace PHPMaker2020\project1;
?>
<?php if ($t_kapal0->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_t_kapal0master" class="table ew-view-table ew-master-table ew-vertical">
	<tbody>
<?php if ($t_kapal0->Nama->Visible) { // Nama ?>
		<tr id="r_Nama">
			<td class="<?php echo $t_kapal0->TableLeftColumnClass ?>"><?php echo $t_kapal0->Nama->caption() ?></td>
			<td <?php echo $t_kapal0->Nama->cellAttributes() ?>>
<span id="el_t_kapal0_Nama">
<span<?php echo $t_kapal0->Nama->viewAttributes() ?>><?php echo $t_kapal0->Nama->getViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>