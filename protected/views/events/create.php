<?php
/* @var $this EventsController */

$form =$this->beginWidget('CActiveForm', array(
    'id'=>'events-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
    )));

echo '<label>Name</label><br>';
echo $form->textField($model, 'name',array('style'=>'')) .'<br>';

echo '<label>Details</label><br>';
echo $form->textArea($model, 'details',array('style'=>'')) . '<br>';

echo '<button type="submit" class="btn">Save</a>';

$this->endWidget();