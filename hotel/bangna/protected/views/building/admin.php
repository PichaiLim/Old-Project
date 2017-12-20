<?php
/* @var $this BuildingController */
/* @var $model Building */
?>


<div class="container-fluid">

    <div class="row">
        <div id="page-content" class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>อาคาร</h2>
                    <div class="panel-ctrls" style="line-height: normal;">
                        <div class="dataTables_length pull-left" id="DataTables_Table_0_length">
                            <label class="panel-ctrls-center">
                                <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="-1">All</option>
                                </select>
                            </label>
                        </div>
                        <i class="separator pull-left"></i>
                        <div id="DataTables_Table_0_filter" class="dataTables_filter pull-left">
                            <label class="panel-ctrls-center">
                                <input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0">
                            </label>
                        </div>
                        <i class="separator pull-left"></i>
                        <div class="panel-ctrls-center pull-left">
                            <a href="javascript:void(0);" class="btn btn-default mt0 width-64px">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="panel-body panel-no-padding">
                    <table id="example" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Purchased On</th>
                            <th>Customer Name</th>
                            <th>Ship To</th>
                            <th>Base Price</th>
                            <th>Purchased Price</th>
                            <th>Status</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>1</td>
                            <td>19/08/2014</td>
                            <td>Connie Merv</td>
                            <td>Sydney</td>
                            <td>$250</td>
                            <td>$300</td>
                            <td><span class="label label-danger">Declined</span></td>
                            <td style="text-align: right;">
                                <a href="#" class="btn btn-default btn-xs">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>19/08/2014</td>
                            <td>Dyson Crispian</td>
                            <td>Tokyo</td>
                            <td>$250</td>
                            <td>$300</td>
                            <td><span class="label label-info">Pending</span></td>
                            <td style="text-align: right;">
                                <a href="#" class="btn btn-default btn-xs">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>21/08/2014</td>
                            <td>Terry Clement</td>
                            <td>Sydney</td>
                            <td>$250</td>
                            <td>$300</td>
                            <td><span class="label label-warning">Warning</span></td>
                            <td style="text-align: right;">
                                <a href="#" class="btn btn-default btn-xs">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>22/08/2014</td>
                            <td>Ewart Gray</td>
                            <td>Boston</td>
                            <td>$250</td>
                            <td>$300</td>
                            <td><span class="label label-success">Approved</span></td>
                            <td style="text-align: right;">
                                <a href="#" class="btn btn-default btn-xs">View</a>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>26/08/2014</td>
                            <td>Ronnie Gil</td>
                            <td>New York</td>
                            <td>$250</td>
                            <td>$300</td>
                            <td><span class="label label-info">Pending</span></td>
                            <td style="text-align: right;">
                                <a href="#" class="btn btn-default btn-xs">View</a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</div> <!-- .container-fluid -->



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'building-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        'name',
        'remark',
		'created',
		'updated',
		/*
		'active',
		'published',
		'name',
'created_by',
		'updated_by',
		'seo_title',
		'seo_description',
		'seo_keywords',
		'floor_count',
		'room_count',
		'reservation_count',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
