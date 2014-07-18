<?php

class TestController extends Controller {

    function actionInsertupdate($id = NULL) {
        if (!empty($_POST['BudgetprovinceModels'])) { // ตรวจสอบว่ามีการกดปุ่มบันทึกมาหรือไม่
            $getModel = new BudgetprovinceModels();
            if (!empty($id)) { //ถ้ามีการส่ง id มาแสดงว่าแก้ไข
                $getModel = BudgetprovinceModels::model()->findByPk($id);
            }
            $getModel->_attributes = $_POST['BudgetprovinceModels'];
            if ($getModel->save(false)) { //บันทึกข้อมูล
                $this->redirect(array('index')); // กลับไปหน้าวิทยากร
            }
        } // end if

        $getModel = new BudgetprovinceModels();
        if (!empty($id)) {
            $getModel = BudgetprovinceModels::model()->findByPk($id);
        }

        $this->render('InsertupdateViews', array(
            'model' => $getModel // แสดงช่องให้ระบุค่าเพื่อการเพิ่มหรือแก้ไขรายการ
        ));

        $modelItemAmp = ItemAmpModels::model()->findAllByAttributes(array('budget_province_id' => $model->budget_province_id));
        if ($modelItemAmp == NULL) {

            if (Yii::app()->request->getParam('refresh') != 'true') {
                Yii::app()->user->setState('ItemAmpModels', array());
                $items = array();
            }
            else
                $items = Yii::app()->user->getState('ItemAmpModels');
        } else {

            $items = array();

            foreach ($modelItemAmp as $modelItemAmp) {
                $item = $modelItemAmp->attributes;
                $item['ampur_name'] = $modelItemAmp->ampur->name;
                $items[] = $item;
            }

            if (Yii::app()->request->getParam('refresh') != 'true')
                Yii::app()->user->setState('ItemAmpModels', $items);

            $items = Yii::app()->user->getState('ItemAmpModels');
        }

        $this->render('InsertupdateViews', array(
            'id' => $id,
            'model' => $model,
            'ItemAmpModels' => new CArrayDataProvider($items, array('keys' => array('budget_ampur_id')))
        ));
    }

}

?>
