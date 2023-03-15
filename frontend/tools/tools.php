<?php

namespace frontend\tools;

use frontend\models\Department;
use frontend\models\DepartmentBottom;
use frontend\models\DepartmentContent;
use frontend\models\DepartmentMiddle;
use Yii;

class tools
{
    public static function isAuth() { if (!Yii::$app->user->isGuest){ return true; } else { return false; } }

    public static function isAjax() { if (Yii::$app->request->isAjax){ return true; } else { return false; } }

    public static function isPost() { if (Yii::$app->request->isPost){ return true; } else { return false; } }

    public static function isCan($permission) { if (Yii::$app->user->can($permission)){ return true; } else { return false; } }

    public static function idUser() { return Yii::$app->user->id; }

    public static function setNotification($key, $text){
        return [ 'key' => $key, 'id' => rand(1000, 9999), 'text' => $text ];
    }

    public static function isPermission($core)
    {
        $data = [];
        if( $core == 'news' ){
            Yii::$app->user->can('addNews') ? $data['addNews'] = true : $data['addNews'] = false;
            Yii::$app->user->can('updateNews') ? $data['updateNews'] = true : $data['updateNews'] = false;
            Yii::$app->user->can('deleteNews') ? $data['deleteNews'] = true : $data['deleteNews'] = false;
            Yii::$app->user->can('addNewsCategory') ? $data['addNewsCategory'] = true : $data['addNewsCategory'] = false;
            Yii::$app->user->can('updateNewsCategory') ? $data['updateNewsCategory'] = true : $data['updateNewsCategory'] = false;
            Yii::$app->user->can('deleteNewsCategory') ? $data['deleteNewsCategory'] = true : $data['deleteNewsCategory'] = false;
        }
        if( $core == 'talents' ){
            Yii::$app->user->can('addTalents') ? $data['addTalents'] = true : $data['addTalents'] = false;
            Yii::$app->user->can('updateTalents') ? $data['updateTalents'] = true : $data['updateTalents'] = false;
            Yii::$app->user->can('deleteTalents') ? $data['deleteTalents'] = true : $data['deleteTalents'] = false;
            Yii::$app->user->can('addTalentsCategory') ? $data['addTalentsCategory'] = true : $data['addTalentsCategory'] = false;
            Yii::$app->user->can('updateTalentsCategory') ? $data['updateTalentsCategory'] = true : $data['updateTalentsCategory'] = false;
            Yii::$app->user->can('deleteTalentsCategory') ? $data['deleteTalentsCategory'] = true : $data['deleteTalentsCategory'] = false;
        }
        if( $core == 'customer' ){
            Yii::$app->user->can('addCust') ? $data['addCust'] = true : $data['addCust'] = false;
            Yii::$app->user->can('updateCust') ? $data['updateCust'] = true : $data['updateCust'] = false;
            Yii::$app->user->can('deleteCust') ? $data['deleteCust'] = true : $data['deleteCust'] = false;
        }
        if( $core == 'projects' ){
            Yii::$app->user->can('addProjects') ? $data['addProjects'] = true : $data['addProjects'] = false;
            Yii::$app->user->can('updateProjects') ? $data['updateProjects'] = true : $data['updateProjects'] = false;
            Yii::$app->user->can('deleteProjects') ? $data['deleteProjects'] = true : $data['deleteProjects'] = false;
            Yii::$app->user->can('addProjectsGroup') ? $data['addProjectsGroup'] = true : $data['addProjectsGroup'] = false;
            Yii::$app->user->can('updateProjectsGroup') ? $data['updateProjectsGroup'] = true : $data['updateProjectsGroup'] = false;
            Yii::$app->user->can('deleteProjectsGroup') ? $data['deleteProjectsGroup'] = true : $data['deleteProjectsGroup'] = false;
        }
        if( $core == 'docs' ){
            Yii::$app->user->can('addDocs') ? $data['addDocs'] = true : $data['addDocs'] = false;
            Yii::$app->user->can('updateDocs') ? $data['updateDocs'] = true : $data['updateDocs'] = false;
            Yii::$app->user->can('deleteDocs') ? $data['deleteDocs'] = true : $data['deleteDocs'] = false;
        }
        if( $core == 'template' ){
            Yii::$app->user->can('adminTemplateAbout') ? $data['adminTemplateAbout'] = true : $data['adminTemplateAbout'] = false;
            Yii::$app->user->can('adminTemplateCarrier') ? $data['adminTemplateCarrier'] = true : $data['adminTemplateCarrier'] = false;
        }
        if( $core == 'services' ){
            Yii::$app->user->can('addServices') ? $data['addServices'] = true : $data['addServices'] = false;
            Yii::$app->user->can('updateServices') ? $data['updateServices'] = true : $data['updateServices'] = false;
            Yii::$app->user->can('deleteServices') ? $data['deleteServices'] = true : $data['deleteServices'] = false;
        }
        if( $core == 'abs' ){
            Yii::$app->user->can('addAbs') ? $data['addAbs'] = true : $data['addAbs'] = false;
            Yii::$app->user->can('updateAbs') ? $data['updateAbs'] = true : $data['updateAbs'] = false;
            Yii::$app->user->can('deleteAbs') ? $data['deleteAbs'] = true : $data['deleteAbs'] = false;
        }
        if( $core == 'appeals' ){
            Yii::$app->user->can('appealsInitiative') ? $data['appealsInitiative'] = true : $data['appealsInitiative'] = false;
        }
        if( $core == 'initiative' ){
            Yii::$app->user->can('responseInitiative') ? $data['responseInitiative'] = true : $data['responseInitiative'] = false;
        }
        if( $core == 'blog' ){
            Yii::$app->user->can('addBlog') ? $data['addBlog'] = true : $data['addBlog'] = false;
            Yii::$app->user->can('updateBlog') ? $data['updateBlog'] = true : $data['updateBlog'] = false;
            Yii::$app->user->can('deleteBlog') ? $data['deleteBlog'] = true : $data['deleteBlog'] = false;
        }
        if( $core == 'department' ){
            Yii::$app->user->can('adminDepartment') ? $data['adminDepartment'] = true : $data['adminDepartment'] = false;
        }
        if( $core == 'survey' ){
            Yii::$app->user->can('addSurvey') ? $data['addSurvey'] = true : $data['addSurvey'] = false;
            Yii::$app->user->can('updateSurvey') ? $data['updateSurvey'] = true : $data['updateSurvey'] = false;
            Yii::$app->user->can('deleteSurvey') ? $data['deleteSurvey'] = true : $data['deleteSurvey'] = false;
        }
        if( $core == 'foto' ){
            Yii::$app->user->can('addFoto') ? $data['addFoto'] = true : $data['addFoto'] = false;
            Yii::$app->user->can('updateFoto') ? $data['updateFoto'] = true : $data['updateFoto'] = false;
            Yii::$app->user->can('deleteFoto') ? $data['deleteFoto'] = true : $data['deleteFoto'] = false;
        }
        return $data;
    }

    public static function getPost($key){ if( isset($key) ){ return Yii::$app->request->post($key); } else{ return Yii::$app->request->post(); } }

    public static function getDepartments(){
        $modelDepartmentContent = DepartmentContent::find()->all();
        $departments = [];
        foreach ( $modelDepartmentContent as $item ){
            if ( $item['data_key'] == 'top' ){
                if ( Department::find()->where(['id' => $item['department_id']])->one()['status_delete'] == 0 ){ $departments[] = $item; }
            } elseif ( $item['data_key'] == 'middle' ){
                if ( DepartmentMiddle::find()->where(['id' => $item['middle_id']])->one()['status_delete'] == 0 ){ $departments[] = $item; }
            } else{
                if ( DepartmentBottom::find()->where(['id' => $item['bottom_id']])->one()['status_delete'] == 0 ){ $departments[] = $item; }
            }
        }
        return $departments;
    }

}