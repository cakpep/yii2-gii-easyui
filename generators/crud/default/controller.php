<?php
/**
 * This is the template for generating a CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)) { ?>
use <?= ltrim($generator->searchModelClass, '\\') ?>;
<?php } ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;
use yii\filters\VerbFilter;

/**
 * <?= $controllerClass ?> implements the CRUD EasyUi actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends <?= StringHelper::basename($generator->baseControllerClass) . "\n" ?>
{

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save' => ['post'],
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all <?= $modelClass ?> models.
     * @return mixed
     */
    public function actionIndex() {
        Yii::$app->view->title = '<?= $modelClass ?>';
        return $this->render('index');
    }

    /**
     * Displays all data <?= $modelClass ?> model.
     * <?= implode("\n     * ", $actionParamComments) . "\n" ?>
     * @return mixed
     */
    public function actionData() {
        Yii::$app->getResponse()->format = 'json';
        <?php if (!empty($generator->searchModelClass)) { ?>
$searchModel = new <?= isset($searchModelAlias) ? $searchModelAlias : $searchModelClass ?>();
        return $searchModel->loadData(Yii::$app->getRequest());
        <?php } ?>
}

    /**
     * Creates a new <?= $modelClass ?> model.
     * @return mixed
     */
    public function actionCreate($id = NULL)
    {
        Yii::$app->getResponse()->format = 'json';
        $post = Yii::$app->request->post();
        // if id == null create new
        if ($id === null) {
            $model = new <?= $modelClass ?>();
            //set your variable default value here when new
            //$model->nama_kelas = $post['nama_kelas'];
        } else {
            $model = <?= $modelClass ?>::findOne($id);
            if ($model === null) {
                return [
                    'type' => 'error',
                    'message' => 'Data tidak ditemukan'
                ];
            }
            //set your variable default value here when update
            //$model->nama_kelas = $post['nama_kelas'];
        }

        if ($post) {
            $data['<?= $modelClass ?>'] = $post;
            if ($model->load($data) && $model->save(false)) {
                return [
                    'type' => 'success',
                    'message' => 'save success'
                ];
            } else {
                return [
                    'type' => 'failed',
                    'message' => 'save failed'
                ];
            }
        }
        return[
            'type' => 'error',
            'message' => 'data tidak valid',
            'data' => $model->toArray(),
        ];
    }

    /**
     * delete action
     * @return mixed
     */
    public function actionDelete($id) {
        Yii::$app->getResponse()->format = 'json';
        $model = <?= $modelClass ?>::findOne($id);
        if ($model === null) {
            return[
                'type' => 'error',
                'message' => 'Data tidak ditemukan'
            ];
        }
        $model->aktif = 0;
        //if ($model->delete()) {
        if ($model->save(false)) {
            return [
                'type' => 'success',
                'message' => 'delete success'
            ];
        } else {
            return [
                'type' => 'failed',
                'message' => 'delete failed'
            ];
        }
    }
}
