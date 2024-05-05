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
        <th class="text-center">Cover</th>
        <th class="text-center">Status</th>
        <th class="text-center">Process</th>
        </thead>
        <tbody>
        <?php foreach ($item_images as $image) { ?>
            <tr>
                <td class="w100 text-center">#<?php echo $image->id ?></td>
                <td class="w100 text-center">
                    <img src="<?php echo base_url("upload/{$viewFolder}/$image->img_url"); ?>" alt="<?php echo $image->img_url; ?>" width="50" class="img-responsive">
                </td>
                <td><?php echo $image->img_url ?></td>
                <td class="w100 text-center">
                    <input
                        data-url="<?php echo base_url("product/isCoverSetter/$image->id/$image->product_id"); ?>"
                        class="isCover"
                        data-size="small"
                        type="checkbox"
                        data-switchery
                        data-color="#ff5b5b"
                        <?php echo ($image->isCover) ? "checked" : "" ?>/>
                </td>
                <td class="w100 text-center">
                    <input
                            data-url="<?php echo base_url("product/isActiveSetter/"); ?>"
                            class="isActive"
                            data-size="small"
                            type="checkbox"
                            data-switchery
                            data-color="#10c469"
                        <?php echo ($image->isActive) ? "checked" : "" ?>/>
                </td>
                <td class="w100 text-center">
                    <button data-url="" class="btn btn-xs btn-danger btn-block btn-outline remove-btn" title="delete"><i class="fa fa-trash"></i> Delete</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php } ?>