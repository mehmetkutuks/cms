<div class="row">
    <div class="col-md-12">
		<h4 class="m-b-lg">
            Pictures of the <?php echo $item->title; ?> product
        </h4>
	</div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("product/image_upload/$item->id"); ?>" class="dropzone" data-plugin="dropzone" data-options="{ url: '<?php echo base_url("product/image_upload/$item->id"); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Drop files here or click to upload.</h3>
                        <p class="m-b-lg text-muted">(Drag your files or click here to upload.)</p>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <!-- END column -->
</div>


<div class="row">
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <?php if(empty($item_images)) { ?>
                    <div class="alert alert-danger text-center">
                        <p>There are no images here.</p>
                    </div>
                <?php } else { ?>
                <table class="table table-bordered table-striped table-hover pictures-list">
                    <thead>
                        <th class="text-center">#id</th>
                        <th class="text-center">Image</th>
                        <th>Image Name</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Process</th>
                    </thead>
                    <tbody>
                    <?php foreach ($item_images as $image) { ?>
                    <tr>
                        <td class="w100 text-center"><?php echo $image->id ?></td>
                        <td class="w100 text-center">
                            <img src="<?php echo base_url("upload/{$viewFolder}/$image->img_url"); ?>" alt="<?php echo $image->img_url; ?>" width="50" class="img-responsive">
                        </td>
                        <td><?php echo $image->img_url ?></td>
                        <td class="w100 text-center">
                            <input
                                    data-url="<?php echo base_url("product/isActiveSetter/"); ?>"
                                    class="isActive"
                                    data-size="small"
                                    type="checkbox"
                                    data-switchery
                                    data-color="#10c469"
                                <?php echo ($image->id) ? "checked" : "" ?>/>
                        </td>
                        <td class="w100 text-center">
                            <button data-url="" class="btn btn-xs btn-danger btn-block btn-outline remove-btn" title="delete"><i class="fa fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <!-- END column -->
</div>

