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

			<table class="table table-hover table-striped content-container">
                <thead>
                    <th class="w50 text-center"><i class="fa fa-reorder"></i></th>
                    <th class="text-center">#id</th>
                    <th>title</th>
                    <th>url</th>
                    <th>description</th>
                    <th class="text-center">status</th>
                    <th>process</th>
                </thead>
                <tbody class="sortable" data-url="<?php echo base_url("product/rankSetter"); ?>">

                    <?php foreach($items as $item) { ?>
                    <tr id="ord-<?php echo $item->id; ?>">
                        <td class="w50 text-center"><i class="fa fa-reorder"></i></td>
                        <td class="w50 text-center">#<?php echo $item->id; ?></td>
                        <td><?php echo $item->title ?></td>
                        <td><?php echo $item->url ?></td>
                        <td><?php echo $item->description ?></td>
                        <td class="w100 text-center">
							<input
                            data-url="<?php echo base_url("product/isActiveSetter/$item->id"); ?>"
                            class="isActive"
                            data-size="small" 
                            type="checkbox" 
                            data-switchery 
                            data-color="#10c469" 
                            <?php echo ($item->isActive) ? "checked" : "" ?>/>
                        </td>
                        <td>
                            <button
                                    data-url="<?php echo base_url("product/delete/$item->id"); ?>"
                                    class="btn btn-xs btn-danger btn-outline remove-btn" title="delete">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                            <a href="<?php echo base_url("product/update_form/$item->id"); ?>" class="btn btn-xs btn-info btn-outline" title="edit"><i class="fa fa-pencil-square-o"></i> Edit</a>
                            <a href="<?php echo base_url("product/image_form/$item->id"); ?>" class="btn btn-xs btn-dark btn-outline" title="images"><i class="fa fa-image"></i> Pictures</a>
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