<?php
/*
 * @Author: Dicky Ermawan S., S.T., MTA 
 * @Email: wanasaja@gmail.com 
 * @Linkedin: linkedin.com/in/dickyermawan 
 * @Date: 2018-11-24 14:18:02 
 * @Last Modified by:   Dicky Ermawan S., S.T., MTA 
 * @Last Modified time: 2018-11-24 14:18:02 
 */

namespace dickyermawan\ActionColumn;

use Yii;
use yii\helpers\Html;

/**
 * This is just an example.
 */
class BtnGroup extends \yii\grid\ActionColumn
{
    public $type;
    public $label;

    public function init()
    {
        parent::init();

        $this->template = '<div class="btn-group btn-group-sm" role="group" aria-label="...">{view}{update}{delete}</div>';
        $this->contentOptions = ['class' => 'text-center'];
        $this->options = ['style' => 'width:120px;'];

        if ($this->type) { // for vertical
            $this->options = ['style' => 'width:80px;'];
            $this->template = '<div class="btn-group-' . $this->type . ' btn-group-sm" role="group" aria-label="...">{view}{update}{delete}</div>';
        }
        if (!$this->type && $this->label) // for horizontal with label
        {
            $this->options = ['style' => 'width:220px;'];
        } elseif ($this->type && $this->label) // for vertical with label
        {
            $this->options = ['style' => 'width:120px;'];
        }

    }

    public function initDefaultButtons()
    {
        if (!isset($this->buttons['view'])) {
            $this->buttons['view'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'View'),
                    'aria-label' => Yii::t('yii', 'View'),
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<i title="Lihat" class="glyphicon glyphicon-eye-open"></i>' . (($this->label[0]) ? ' ' . $this->label[0] : ''), $url, ['class' => 'btn btn-info']);
            };
        }
        if (!isset($this->buttons['update'])) {
            $this->buttons['update'] = function ($url, $model, $key) {
                $options = array_merge([
                    'title' => Yii::t('yii', 'Update'),
                    'aria-label' => Yii::t('yii', 'Update'),
                    'data-pjax' => '0',
                ], $this->buttonOptions);
                return Html::a('<i title="Ubah" class="glyphicon glyphicon-pencil"></i>' . (($this->label[1]) ? ' ' . $this->label[1] : ''), $url, ['class' => 'btn btn-primary']);
            };
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = function ($url, $model, $key) {
                return Html::a('<i class="glyphicon glyphicon-trash"></i>' . (($this->label[2]) ? ' ' . $this->label[2] : ''), $url, [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method' => 'post',
                    'data-pjax' => '0',
                    'data-key' => $model->id,
                    'class' => 'btn btn-danger',
                ]);
            };
        }
    }
}
