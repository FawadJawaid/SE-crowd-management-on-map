<div id="side-bar">
<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/table_1.png', '', array('id'=>'img-div')),array('dashboard/webStatistics','unqId'=>$_REQUEST['unqId'])); ?>

<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/04_maps.png', '', array('id'=>'img-div') ),array('dashboard/WebStatisticsMap','unqId'=>$_REQUEST['unqId'])); ?>

<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/images/pie_chart.png', '', array('id'=>'img-div') ),array('dashboard/WebStatisticsGraphs','unqId'=>$_REQUEST['unqId'])); ?>

</div>