<?php
/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
?>
<!-- Data Grid ( #dg-<?= ltrim($generator->modelClass, '\\') ?> ) -->
<div style="padding:1px">
	<table id="dg-<?= ltrim($generator->modelClass, '\\') ?>" title="<?= ltrim($generator->modelClass, '\\') ?>"
		class="easyui-datagrid" width="auto" height="auto"
		url="<?php echo  '<?='; ?> Url::to(['<?= strtolower(ltrim($generator->modelClass, '\\')) ?>/data']) ?>"
		toolbar="#tb-<?= ltrim($generator->modelClass, '\\') ?>" pagination="true"
		rownumbers="true" fitColumns="true"
		singleSelect="true" collapsible="true"
	>
		<thead>
			<tr>
		<?php foreach ($generator->getColumnNames() as $attribute) {
			if (in_array($attribute, $safeAttributes)) {
		?>
			<th field='<?= $attribute ?>' sortable='true'><?= $generator->getAttributeLabel($attribute) ?></th>
		<?php
			}
		} ?>
		</tr>
		</thead>
	</table>
</div>


<!-- Toolbar Data Grid ( #tb-<?= ltrim($generator->modelClass, '\\') ?> ) -->
<div id="tb-<?= ltrim($generator->modelClass, '\\') ?>">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="create_data('#df-<?= ltrim($generator->modelClass, '\\') ?>','#f-<?= ltrim($generator->modelClass, '\\') ?>','Create <?= ltrim($generator->modelClass, '\\') ?>','<?php echo  '<?='; ?> Url::to(['<?= ltrim($generator->modelClass, '\\') ?>/update']) ?>')">Create</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="update_data('#df-<?= ltrim($generator->modelClass, '\\') ?>','#f-<?= ltrim($generator->modelClass, '\\') ?>','Update <?= ltrim($generator->modelClass, '\\') ?>','#dg-<?= ltrim($generator->modelClass, '\\') ?>','<?= Url::to(['<?= ltrim($generator->modelClass, '\\') ?>/update']) ?>')">Update</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="remove_data('#dg-<?= ltrim($generator->modelClass, '\\') ?>','<?php echo  '<?='; ?> Url::to(['<?= ltrim($generator->modelClass, '\\') ?>/delete']) ?>')">Delete</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onClick="search_dialog('#ds-<?= ltrim($generator->modelClass, '\\') ?>')">Search</a>
</div>

<!-- Dialog Form ( #df-<?= ltrim($generator->modelClass, '\\') ?> ) -->
<div id="df-<?= ltrim($generator->modelClass, '\\') ?>" class="easyui-dialog" style="width: 400px; height: 240px; padding: 10px 20px" closed="true" modal="true" buttons="#bf-<?= ltrim($generator->modelClass, '\\') ?>">
	<form id="f-<?= ltrim($generator->modelClass, '\\') ?>" method="post" novalidate onSubmit="return false">
		<div class="form-item">
			<label for="type">Type</label><br />
			<input type="text" name="type" class="easyui-validatebox" required="true" maxlength="50" size="53" />
		</div>
		<div class="form-item">
			<label for="barang">Barang</label><br />
			<input type="text" name="barang" class="easyui-validatebox" required="true" maxlength="50" size="53" />
		</div>
		<div class="form-item">
			<label for="harga">Harga</label><br />
			<input type="text" name="harga" class="easyui-validatebox" required="true" maxlength="15" size="53" />
		</div>
			<?php foreach ($generator->getColumnNames() as $attribute) {
					if (in_array($attribute, $safeAttributes)) {
			?>
				<div class="form-item">
					<label for="<?= $attribute ?>"><?= $generator->getAttributeLabel($attribute) ?></label><br />
					<input type="text" name="<?= $attribute ?>" class="easyui-textbox"/>
				</div>
			<?php
					}
				} ?>
	</form>
</div>

<!-- Button Form ( #bf-<?= ltrim($generator->modelClass, '\\') ?> ) -->
<div id="bf-<?= ltrim($generator->modelClass, '\\') ?>">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onClick="save_data('#f-<?= ltrim($generator->modelClass, '\\') ?>','#df-<?= ltrim($generator->modelClass, '\\') ?>','#dg-<?= ltrim($generator->modelClass, '\\') ?>')">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:jQuery('#df-<?= ltrim($generator->modelClass, '\\') ?>').dialog('close')">Batal</a>
</div>

<!-- Dialog Search ( #ds-<?= ltrim($generator->modelClass, '\\') ?> ) -->
<div id="ds-<?= ltrim($generator->modelClass, '\\') ?>" class="easyui-dialog" style="width:400px; height:240px; padding: 10px 20px" closed="true" buttons="#bs-<?= ltrim($generator->modelClass, '\\') ?>" iconCls="IconMagnifier" >
	<?php foreach ($generator->getColumnNames() as $attribute) {
			if (in_array($attribute, $safeAttributes)) {
	?>
		<div class="form-item">
			<label for="search_<?= ltrim($generator->modelClass, '\\') ?>_<?= $attribute ?>"><?= $generator->getAttributeLabel($attribute) ?></label>
			<input type="text" name="search_<?= ltrim($generator->modelClass, '\\') ?>_<?= $attribute ?>" id="fs-<?= ltrim($generator->modelClass, '\\') ?>-<?= $attribute ?>" size="52" class="easyui-textbox" />
		</div>
	<?php
			}
		} ?>

</div>

<!-- Button Search ( #bs-<?= ltrim($generator->modelClass, '\\') ?> ) -->
<div id="bs-<?= ltrim($generator->modelClass, '\\') ?>">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onClick="search_data_<?= ltrim($generator->modelClass, '\\') ?>()">Cari</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:jQuery('#ds-<?= ltrim($generator->modelClass, '\\') ?>').dialog('close')">Tutup</a>
</div>
