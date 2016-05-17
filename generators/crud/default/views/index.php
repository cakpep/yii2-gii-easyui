<?php

echo "<?php\n";
?>

use yii\web\View;
use frontend\assets\EasyUiAsset;
use yii\helpers\Url;

/* @var $this View */
$opts = [
    'dataUrl' => Url::to(['data']),
    'saveUrl' => Url::to(['save']),
    'deleteUrl' => Url::to(['delete']),
];

$this->registerJs('var opts = ' . json_encode($opts) . ';');
//EasyUiAsset::register($this);
$this->registerJs($this->render('js/script.js'));
$css = <<<CSS
#form tr {
    height: 40px;
}
CSS;
$this->registerCss($css);
?>
<table id="dg-kelas" style="width: 100%;" toolbar="#dg-toolbar">
    <thead>
        <tr>
            <th field="id" sortable="true" width="180">id</th>
            <th field="nama_kelas" sortable="true" width="160">Nama Kelas</th>
            <th field="tingkat" sortable="true" width="260">Tingkat</th>
            <th field="aktif" sortable="true" width="260">Status</th>
            <th field="time_create" sortable="true" width="160">Time Create</th>
            
        </tr>
    </thead>
</table>
<div id="dg-toolbar">
    <a id="btn-new" iconCls="icon-add">Add</a>
    <a id="btn-edit" iconCls="icon-edit">Edit</a>
    <a id="btn-delete" iconCls="icon-remove">Delete</a>
    <span><input id="inp-search"></span>
</div>
<div id="dialog" closed="true" modal="true" title=""
     style="width: 400px;height: auto;">
    <form id="form" method="post">
        <table width="100%">            
            <tr>
                <th>Nama Kelas</th>
                <td><input name="nama_kelas" class="easyui-textbox" required="true"></td>
            </tr>
            <tr>
                <th>Tingkat</th>
                <td><input name="tingkat" class="easyui-textbox" required="true"></td>
            </tr>
        </table>
    </form>
</div>