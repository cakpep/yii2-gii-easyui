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
use yii\web\View;
use yii\helpers\Url;

/* @var $this yii\web\View */
$opts = [
    'dataUrl' => Url::to(['data']),
    'saveUrl' => Url::to(['save']),
    'deleteUrl' => Url::to(['delete']),
];

$this->registerJs('var opts = ' . json_encode($opts) . ';');
$this->registerJs($this->render('js/script.js'));
$css = <<<CSS
#form tr {
    height: 40px;
}
CSS;
$this->registerCss($css);
?>
<table id="dg-listview" style="width: 100%;" toolbar="#dg-toolbar">
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
<div id="dg-toolbar">
    <a id="btn-new" iconCls="icon-add">Add</a>
    <a id="btn-edit" iconCls="icon-edit">Edit</a>
    <a id="btn-delete" iconCls="icon-remove">Delete</a>
    <span><input id="inp-search"></span>
</div>
<div id="dialog" closed="true" modal="true" title="Input/Update">
    <div style="padding:10px 60px 20px 60px">
        <form id="form" method="post">
            <table cellpadding="5">
        <?php foreach ($generator->getColumnNames() as $attribute) {
                if (in_array($attribute, $safeAttributes)) {
        ?>
        <tr>
                    <td><label for="<?= $attribute ?>"><?= $generator->getAttributeLabel($attribute) ?></label></td>
                    <td><input name="<?= $attribute ?>" class="easyui-textbox"></td>
                </tr>
        <?php
                }
            } ?>
    </table>
        </form>
    </div>
</div>