<div id="field_id">ID игрового поля: <b><?php echo $this->Field->getId() ?></b></div>
<table class="field_table" border="1">
    <?php foreach ($field_matrix as $row) : ?>
    <tr>
        <?php foreach ($row as $cell) : ?>
        <td class="field_cell_<?php echo ($cell == 1) ? "busy" : "empty" ?>" >&nbsp;</td>
        <?php endforeach; ?>
    </tr>
    <?php endforeach; /* $field_matrix */ ?>
</table>