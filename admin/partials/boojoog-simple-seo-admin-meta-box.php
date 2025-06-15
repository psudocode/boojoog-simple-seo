<?php
wp_nonce_field('bss_meta_box', 'bss_meta_box_nonce');

$meta_title = get_post_meta(get_the_ID(), 'bss_meta_title', true);
$meta_description = get_post_meta(get_the_ID(), 'bss_meta_description', true);
$meta_image = get_post_meta(get_the_ID(), 'bss_meta_image', true);
$meta_author = get_post_meta(get_the_ID(), 'bss_meta_author', true);
?>
<!-- article summaries -->
<div class="bss">
    <h3>Article Summaries</h3>
    <div id="bss-summaries"></div>
</div>
<table class="form-table">
    <tr>
        <th><label for="bss_title">SEO Title</label></th>
        <td>
            <input type="text" id="bss_title" name="bss_title" value="<?php echo esc_attr($meta_title); ?>"
                class="large-text" />
            <p class="description">Leave empty to use the post title.</p>
        </td>
    </tr>
    <tr>
        <th><label for="bss_description">Meta Description</label></th>
        <td>
            <textarea id="bss_description" name="bss_description" rows="3"
                class="large-text"><?php echo esc_textarea($meta_description); ?></textarea>
            <p class="description">Recommended length: 150-160 characters.</p>
        </td>
    </tr>
    <tr>
        <th><label for="bss_image">Meta Image</label></th>
        <td>
            <input type="text" id="bss_image" name="bss_image" value="<?php echo esc_url($meta_image); ?>"
                class="large-text" />
            <button type="button" class="button bss_upload_image_button">Upload Image</button>
            <p class="description">Recommended size: 1200x630 pixels.</p>
        </td>
    </tr>
    <tr>
        <th><label for="bss_author">Author</label></th>
        <td>
            <input type="text" id="bss_author" name="bss_author" value="<?php echo esc_attr($meta_author); ?>"
                class="large-text" />
            <p class="description">Leave empty to use the post author.</p>
        </td>
    </tr>
</table>