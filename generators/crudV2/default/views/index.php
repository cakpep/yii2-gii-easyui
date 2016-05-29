<?php
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */
/* @var $model \yii\db\ActiveRecord */

$model = new $generator->modelClass();
$controllerClass = StringHelper::basename($generator->controllerClass);
$controllerClass = str_replace('controller', '',$controllerClass);
$urlParams = $generator->generateUrlParams();
$controllerId = $generator->controllerID;
$modelClass = StringHelper::basename($generator->modelClass);
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}
echo "<?php\n";
?>
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model <?= strtolower($modelClass); ?> */
?>
<!-- Data Grid ( #dg-<?= strtolower($modelClass); ?> ) -->
<div style="padding:1px">
	<table id="dg-<?= strtolower($modelClass); ?>" title="<?= strtolower($modelClass); ?>"
		class="easyui-datagrid" width="auto" height="auto"
		url="<?php echo  '<?='; ?> Url::to(['<?= $controllerId ?>/data']) ?>"
		toolbar="#tb-<?= strtolower($modelClass); ?>" pagination="true"
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


<!-- Toolbar Data Grid ( #tb-<?= strtolower($modelClass); ?> ) -->
<div id="tb-<?= strtolower($modelClass); ?>">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onClick="create_data('#df-<?= strtolower($modelClass); ?>','#f-<?= strtolower($modelClass); ?>','Create <?= strtolower($modelClass); ?>','<?php echo  '<?='; ?> Url::to(['<?= $controllerId ?>/save']) ?>')">Create</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onClick="update_data('#df-<?= strtolower($modelClass); ?>','#f-<?= strtolower($modelClass); ?>','Update <?= strtolower($modelClass); ?>','#dg-<?= strtolower($modelClass); ?>','<?php echo  '<?='; ?> Url::to(['<?= $controllerId ?>/save']) ?>')">Update</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onClick="remove_data('#dg-<?= strtolower($modelClass); ?>','<?php echo  '<?='; ?> Url::to(['<?= $controllerId ?>/delete']) ?>')">Delete</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-search" plain="true" onClick="search_dialog('#ds-<?= strtolower($modelClass); ?>')">Search</a>
</div>

<!-- Dialog Form ( #df-<?= strtolower($modelClass); ?> ) -->
<div id="df-<?= strtolower($modelClass); ?>" class="easyui-dialog" style="width: 400px; height: 240px; padding: 10px 20px" closed="true" modal="true" buttons="#bf-<?= strtolower($modelClass); ?>">
	<form id="f-<?= strtolower($modelClass); ?>" method="post" novalidate onSubmit="return false">
			<?php foreach ($generator->getColumnNames() as $attribute) {
					if (in_array($attribute, $safeAttributes)) {
			?>
				<div class="form-item">
					<label for="<?= $attribute ?>"><?= $generator->getAttributeLabel($attribute) ?></label><br />
					<input type="text" name="<?= $attribute ?>" class="easyui-textbox" required="false" maxlength="15" size="15" />
				</div>
			<?php
					}
				} ?>
	</form>
</div>

<!-- Button Form ( #bf-<?= strtolower($modelClass); ?> ) -->
<div id="bf-<?= strtolower($modelClass); ?>">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-save" onClick="save_data('#f-<?= strtolower($modelClass); ?>','#df-<?= strtolower($modelClass); ?>','#dg-<?= strtolower($modelClass); ?>')">Simpan</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:jQuery('#df-<?= strtolower($modelClass); ?>').dialog('close')">Batal</a>
</div>

<!-- Dialog Search ( #ds-<?= strtolower($modelClass); ?> ) -->
<div id="ds-<?= strtolower($modelClass); ?>" class="easyui-dialog" style="width:400px; height:240px; padding: 10px 20px" closed="true" buttons="#bs-<?= strtolower($modelClass); ?>" iconCls="IconMagnifier" >
	<?php foreach ($generator->getColumnNames() as $attribute) {
			if (in_array($attribute, $safeAttributes)) {
	?>
		<div class="form-item">
			<label for="search_<?= strtolower($modelClass); ?>_<?= $attribute ?>"><?= $generator->getAttributeLabel($attribute) ?></label>
			<input type="text" name="search_<?= strtolower($modelClass); ?>_<?= $attribute ?>" id="fs-<?= strtolower($modelClass); ?>-<?= $attribute ?>" size="52" class="easyui-textbox" />
		</div>
	<?php
			}
		} ?>

</div>

<!-- Button Search ( #bs-<?= strtolower($modelClass); ?> ) -->
<div id="bs-<?= strtolower($modelClass); ?>">
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onClick="search_data_<?= strtolower($modelClass); ?>()">Cari</a>
	<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onClick="javascript:jQuery('#ds-<?= strtolower($modelClass); ?>').dialog('close')">Tutup</a>
</div>
