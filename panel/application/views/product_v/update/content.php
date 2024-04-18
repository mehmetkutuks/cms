<div class="row">
    <div class="col-md-12">
		<h4 class="m-b-lg">
            You are editing the <b><?php echo $item->title; ?></b> product
        </h4>
	</div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("product/save"); ?>" method="post">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" placeholder="Product Name" name="title" value="<?php echo $item->title; ?>" <?php if(isset($form_error)){ if(form_error("title")){ ?>style="border-color: red;" <?php }}?>>
                        <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}">
                            <?php echo $item->description; ?>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                    <a href="<?php echo base_url("product"); ?>" class="btn btn-danger btn-md">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <!-- END column -->
</div>

