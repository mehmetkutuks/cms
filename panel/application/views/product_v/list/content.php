<div class="row">
    <div class="col-md-12">
		<h4 class="m-b-lg">
            Product List
            <a href="<?php echo base_url("product/new_form") ?>" class="btn btn-outline btn-primary btn-xs pull-right"><i class="fa fa-plus"> New Product</i></a>
        </h4>
	</div><!-- END column -->
    <div class="col-md-12">
		<div class="widget p-lg">

        <?php if(empty($items)) { ?>
        <div class="alert alert-danger text-center">
			<p>There is no data here. Please <a href="">click here</a>.</p>
		</div>
        <?php } else { ?>

			<table class="table table-hover table-striped">
                <thead>
                    <th>#id</th>
                    <th>url</th>
                    <th>title</th>
                    <th>description</th>
                    <th>status</th>
                    <th>process</th>
                </thead>
                <tbody>

                    <?php foreach($items as $item) { ?>
                    <tr>
                        <td>#<?php echo $item->id; ?></td>
                        <td><?php echo $item->url ?></td>
                        <td><?php echo $item->title ?></td>
                        <td><?php echo $item->description ?></td>
                        <td>
							<input 
                            data-size="small" 
                            type="checkbox" 
                            data-switchery 
                            data-color="#10c469" 
                            <?php echo ($item->isActive) ? "checked" : "" ?>/>
                        </td>
                        <td>
                            <a href="" class="btn btn-xs btn-danger btn-outline" title="delete"><i class="fa fa-trash"></i> Delete</a>
                            <a href="<?php echo base_url("product/update_form/$item->id"); ?>" class="btn btn-xs btn-info btn-outline" title="edit"><i class="fa fa-pencil-square-o"></i> Edit</a>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
			</table>
        <?php } ?>  
		</div><!-- .widget -->
    </div>
    <!-- END column -->
</div>