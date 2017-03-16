<?php
namespace grozzzny\partners\controllers;

use grozzzny\partners\models\Base;
use Yii;
use yii\data\ActiveDataProvider;
use grozzzny\partners\models\Partners;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

use yii\easyii\components\Controller;


class AController extends Controller
{
    /**
     * Список
     * @return string
     */
    public function actionIndex($model = null)
    {
        $models = Base::allModels();

        $current_model = empty($model) ? current($models) : $models[$model];

        $query = $current_model->find()->desc();

        $data = new ActiveDataProvider(['query' => $query]);

        $current_model::queryFilter($query, Yii::$app->request->get());

        Url::remember();

        return $this->render('index', [
            'data' => $data,
            'models' => $models,
            'current_model' => $current_model
        ]);
    }


    /**
     * Создать
     * @param $type
     * @return array|string|\yii\web\Response
     */
    public function actionCreate($type)
    {
        $modelClass = DraftProfileBase::getModel($type);
        $model = new $modelClass;

        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES)){
                    foreach ($model->getAttributes() as $attribute => $value){
                        if(in_array($attribute, DraftProfileBase::getAttributesImage())) {
                            $model->$attribute = UploadedFile::getInstance($model, $attribute);
                            if ($model->$attribute && $model->validate([$attribute])) {
                                $model->$attribute = Image::upload($model->$attribute, 'draft_profile');
                            } else {
                                $model->$attribute = '';
                            }
                        }
                    }
                }

                if($model->save()){
                    $this->flash('success', 'Запись создана');
                    return $this->redirect(Url::previous());
                }
                else{
                    $this->flash('error', 'Ошибка');
                    return $this->refresh();
                }
            }
        }
        else {
            return $this->render('create', [
                'model' => $model,
                'type' => $type
            ]);
        }
    }


    /**
     * Редактировать
     * @param $type
     * @param $id
     * @param null $title
     * @return array|string|\yii\web\Response
     */
    public function actionEdit($type, $id, $title = null)
    {
        $modelClass = DraftProfileBase::getModel($type);

        $model = $modelClass::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
            return $this->redirect(['/admin/'.$this->module->id]);
        }
        if ($model->load(Yii::$app->request->post())) {
            if(Yii::$app->request->isAjax){
                Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return ActiveForm::validate($model);
            }
            else{
                if(isset($_FILES)){
                    foreach ($model->getAttributes() as $attribute => $value){
                        if(in_array($attribute, DraftProfileBase::getAttributesImage())) {
                            $model->$attribute = UploadedFile::getInstance($model, $attribute);
                            if($model->$attribute && $model->validate([$attribute])){
                                $model->$attribute = Image::upload($model->$attribute, 'draft_profile');
                            }
                            else{
                                $model->$attribute = $model->oldAttributes[$attribute];
                            }
                        }
                    }
                }

                if($model->save()){
                    $this->flash('success', 'Запись отредактирована');
                }
                else{
                    $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
                }
                return $this->refresh();
            }
        }
        else {
            return $this->render('edit', [
                'model' => $model,
                'type' => $type,
                'title' => $title
            ]);
        }
    }


    public function actionPhotos($type, $id)
    {
        $modelClass = DraftProfileBase::getModel($type);

        $model = $modelClass::findOne($id);

        if(!($model)){
            return $this->redirect(['/admin/'.$this->module->id]);
        }

        return $this->render('photos', [
            'model' => $model,
            'type' => $type
        ]);
    }

    /**
     * Удалить
     * @param $type
     * @param $id
     * @return mixed
     */
    public function actionDelete($type, $id)
    {
        $modelClass = DraftProfileBase::getModel($type);

        if(($model = $modelClass::findOne($id))){
            $model->delete();
        } else {
            $this->error =  Yii::t('easyii', 'Not found');
        }
        return $this->formatResponse('Запись удалена');
    }


    /**
     * Удалить изображение
     * @param $attribute
     * @param $type
     * @param $id
     * @return \yii\web\Response
     */
    public function actionClearImage($attribute, $type, $id)
    {
        $modelClass = DraftProfileBase::getModel($type);

        $model = $modelClass::findOne($id);

        if($model === null){
            $this->flash('error', Yii::t('easyii', 'Not found'));
        }
        else{
            $url_img = $model->$attribute;
            $model->$attribute = '';
            if($model->update()){
                @unlink(Yii::getAlias('@webroot').$url_img);
                $this->flash('success', Yii::t('easyii', 'Image cleared'));
            } else {
                $this->flash('error', Yii::t('easyii', 'Update error. {0}', $model->formatErrors()));
            }
        }
        return $this->back();
    }

    /**
     * Активировать
     * @param $type
     * @param $id
     * @return mixed
     */
    public function actionOn($type, $id)
    {
        return $this->changeStatus($type, $id, DraftProfileBase::STATUS_ON);
    }


    /**
     * Деактивировать
     * @param $type
     * @param $id
     * @return mixed
     */
    public function actionOff($type, $id)
    {
        return $this->changeStatus($type, $id, DraftProfileBase::STATUS_OFF);
    }

    /**
     * Изменить статус
     * @param $type
     * @param $id
     * @param $status
     * @return mixed
     */
    public function changeStatus($type, $id, $status)
    {
        $modelClass = DraftProfileBase::getModel($type);

        if($model = $modelClass::findOne($id)){
            $model->status = $status;
            $model->update();
        }else{
            $this->error = Yii::t('easyii', 'Not found');
        }

        return $this->formatResponse(Yii::t('easyii', 'Status successfully changed'));
    }
}