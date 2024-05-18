<div class="row">
    <div class="col-md-12">
		<h4 class="m-b-lg">
            News Add
        </h4>
	</div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <hr class="widget-separator">
            <div class="widget-body">
                <form action="<?php echo base_url("news/save"); ?>" method="post">
                    <div class="form-group">
                        <label>news Name</label>
                        <input type="text" class="form-control" placeholder="News Name" name="title" <?php if(isset($form_error)){ if(form_error("title")){ ?>style="border-color: red;" <?php }}?>>
                        <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                    </div>
                    <div class="form-group">
						<label>News Type</label>
						<div id="control-demo-6">
							<select class="form-control" name="news_type">
								<option value="image">Image</option>
								<option value="video">Video</option>
							</select>
						</div>
					</div>
                    <div class="form-group">
						<label for="exampleInputFile">Select Image</label>
						<input type="file" name="img_url" class="form-control">
					</div>
                    <div class="form-group">
                        <label>Video URL</label>
                        <input type="text" class="form-control" placeholder="Paste the video link here." name="video_url">
                        <?php if(isset($form_error)){ ?>
                        <small class="pull-right input-form-error"><?php echo form_error("video_url"); ?></small>
                        <?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                    <a href="<?php echo base_url("news"); ?>" class="btn btn-danger btn-md">Cancel</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
    <!-- END column -->
</div>

