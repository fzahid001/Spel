<?php
if (!defined('ABSPATH'))
    exit;
if (!current_user_can('edit_others_pages')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
}
wp_enqueue_style('sb-image-bootstrap-style', plugins_url('css/bootstrap.min.css', __FILE__));
wp_enqueue_style('sb-image-font-awesome-style', plugins_url('css/font-awesome.min.css', __FILE__));
wp_enqueue_style('sb-image-vendor-style', plugins_url('css/style.css', __FILE__));
wp_enqueue_script('sb-image-bootstrap-js', plugins_url('js/bootstrap.min.js', __FILE__));
?>
<div class="wrap">
    <?php sb_image_promote_free(); ?>
    <h1> SB Image Hover Effects <a href="<?php echo admin_url("admin.php?page=sb-image-hover-effects-general"); ?>" class="btn btn-primary"> Add New</a></h1>
    <div class="sb-image-admin-wrapper table-responsive" style="margin-top: 20px; margin-bottom: 20px;">
        <table class="table table-hover widefat " style="background-color: #fff; border: 1px solid #ccc">
            <thead>
                <tr>
                    <th style="width: 10%">ID</th>
                    <th style="width: 15%">Name</th>
                    <th style="width: 55%">Shortcode</th>
                    <th style="width: 20%">Edit Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                if (!empty($_POST['delete']) && is_numeric($_POST['id'])) {
                    global $wpdb;
                    $id = $_POST['id'];
                    $table_name = $wpdb->prefix . 'sb_image_hover_effects_style';
                    $wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE id = %d", $id));
                }
                $data = $wpdb->get_results('SELECT * FROM ' . $wpdb->prefix . 'sb_image_hover_effects_style ORDER BY id DESC', ARRAY_A);
                foreach ($data as $value) {
                    $editurl = $value['style_name'];
                    $id = $value['id'];
                    echo ' <tr>';
                    echo ' <td>' . $id . '</td>';
                    echo '  <td >' . $value['name'] . '</td>';
                    echo '<td ><span>Shortcode <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="[sb_image_oxi id=&quot;' . $id . '&quot;]"></span>'
                    . '<span>Php Code <input type="text" onclick="this.setSelectionRange(0, this.value.length)" value="&lt;?php echo do_shortcode(&#039;[sb_image_oxi  id=&quot;' . $id . '&quot;]&#039;); ?&gt;"></span></td>';
                    echo '<td >
                                    <a href="' . admin_url("admin.php?page=$editurl&styleid=$id") . '"  title="Edit"  class="btn btn-info" style="float:left; margin-right: 5px; margin-left: 5px;">Edit</a>
                                    <form method="post">
                                            <input type="hidden" name="id" value="' . $id . '">
                                            <button class="btn btn-danger" style="float:left"  title="Delete"  type="submit" value="delete" name="delete">Delete</button>  
                                    </form>
                                   
                             </td>';
                    echo ' </tr>';
                }
                ?>

            </tbody>
        </table> 
    </div>
</div>