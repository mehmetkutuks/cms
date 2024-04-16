<div class="row">
    <div class="col-md-12">
		<h4 class="m-b-lg">
            Product Add
        </h4>
	</div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("product/save"); ?>" method="post">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" placeholder="Product Name" name="product_name" <?php if(isset($form_error)){ if(form_error("product_name")){ ?>style="border-color: red;" <?php }}?>>
                        <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error("product_name"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                    <a href="<?php echo base_url("product"); ?>" class="btn btn-danger btn-md">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <!-- END column -->
</div>

