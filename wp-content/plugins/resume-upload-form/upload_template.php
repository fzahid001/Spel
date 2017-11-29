<?php
function resume_upload_pageLoad(){
    global $plugin_url;    
    ?>

    <script type="text/javascript">        

        var validations = {
            email: [/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/, 'Please enter a valid email address']
        };

        (function($) {
            $(document).ready(function() {
                // Check all the input fields of type email. This function will handle all the email addresses validations
                $("input[type=email]").change(function() {
                    // Set the regular expression to validate the email 
                    validation = new RegExp(validations['email'][0]);
                    // validate the email value against the regular expression
                    if (!validation.test(this.value)) {
                        // If the validation fails then we show the custom error message
                        this.setCustomValidity(validations['email'][1]);
                        return false;
                    } else {
                        // This is really important. If the validation is successful you need to reset the custom error message
                        this.setCustomValidity('');
                    }
                });

                // Check all the input fields of type file. This function will handle all the email addresses validations
                $("input[type=file]").change(function() {
                    var ext = this.value.match(/\.([^\.]+)$/)[1];
                    switch (ext) {
                        case 'doc':
                        case 'docx':
                        case 'pdf':
                            this.setCustomValidity('');
                            break;
                        default:
                            this.setCustomValidity('Please upload doc, docx or pdf files only');
                            break;
                    }
                });
                
                // Setting comments editor
                tinymce.init({
                  selector: 'textarea',
                  height: 100,
                  menubar: false,
                  plugins: [
                    'lists link'
                  ],
                  toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
                });

                /*editor_id = $("textarea").attr('id');
                tinymce.get(editor_id).show();*/

            });
        })(jQuery);
    </script>
    <?php
} // end of pageLoad function

add_action('wp_head', 'resume_upload_pageLoad');

function html_form_code() {  

    global $wpdb;    
    $table_user_info = $wpdb -> prefix."user_info";
    $sql = "SELECT resume FROM ".$table_user_info." WHERE user_id= '".get_current_user_id()."'";
    $rec_exits = $wpdb -> get_row($sql);
    $file_name = "";
    $file_ext = "";
    $file_link = "";
    if (count($rec_exits) > 0) {        
        $file_name = basename($rec_exits->resume); // to get file name
        $file_ext = pathinfo($rec_exits->resume, PATHINFO_EXTENSION); // to get file extension
        $file_link = $rec_exits->resume;
    }    

    echo '<form id="upload_resume_form" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post" enctype="multipart/form-data">';
    echo '<p>';
    echo 'Your Name <span style="color:red;">*</span><br/>';
    echo '<input required type="text" name="cf-name" pattern="[a-zA-Z ]+" value="' . ( isset( $_POST["cf-name"] ) ? esc_attr( $_POST["cf-name"] ) : '' ) . '" size="40" placeholder="Enter your Name" />';
    echo '</p>';
    echo '<p>';
    echo 'Your Email <span style="color:red;">*</span> <br/>';
    echo '<input required type="email" name="cf-email" value="' . ( isset( $_POST["cf-email"] ) ? esc_attr( $_POST["cf-email"] ) : '' ) . '" size="40" placeholder="Enter your email" />';
    echo '</p>';
    echo '<p>';
    echo 'Comments <br/>';
    echo '<textarea id="mytextarea" name="cf-comments" size="40" rows="4" placeholder="Enter your message" style="resize: none;"/>' . ( isset( $_POST["cf-comments"] ) ? esc_attr( $_POST["cf-comments"] ) : '' ) . '</textarea>';
    echo '</p>';
    echo '<p>';
    echo 'Upload File <span style="color:red;">*</span> <br/>';
    echo '<input required type="file" name="cf-file" size="40" accept=".doc,.docx,.pdf"/>';
    echo '</p>';    
    echo '<p><input type="submit" name="cf-submitted" value="Submit" style="padding: 11px 15px;"></p>';
    echo '</form>';
}

function save_data() {

    // if the submit button is clicked, send the email
    if ( isset( $_POST['cf-submitted'] ) ) {
       
        global $wpdb;

        // Getting old resume file of user
        $table_user_info = $wpdb -> prefix."user_info";
        $sql = "SELECT id, resume FROM ".$table_user_info." WHERE user_id= '".get_current_user_id()."'";
        $rec_exits = $wpdb -> get_row($sql);
        $old_link = "";
        if (count($rec_exits) > 0) {
            $old_link = $rec_exits->resume;
        }

        // sanitize form values
        $name    = sanitize_text_field( $_POST["cf-name"] );
        $email   = sanitize_email( $_POST["cf-email"] );                
        $comments   = sanitize_text_field( $_POST["cf-comments"] );              

        if ( ! function_exists( 'wp_handle_upload' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
        }

        $uploadedfile = $_FILES['cf-file'];
        $upload_overrides = array( 'test_form' => false );

        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

        if ( $movefile && !isset( $movefile['error'] ) ) {
            
            $data = array(
                "name" => $name, 
                "email" => $email, 
                "user_id" => get_current_user_id(), 
                'resume' => strstr($movefile['url'], 'wp-content'),
                'comments' => $comments        
            );

            if (count($rec_exits) > 0) {
                
                // Deleting already saved resume of this user
                if(file_exists($old_link)){
                    unlink($old_link);
                }

                // Updating table
                $where = array( "user_id" => get_current_user_id() );
                $wpdb->update( $table_user_info, $data, $where, $format, $where_format );
                echo "<span style='color:green;'>Resume has been uploaded successfully!</span>";
            } else {
                $rec_result = $wpdb -> insert($table_user_info, $data);
                $lastid = $wpdb -> insert_id;
                echo "<span style='color:green;'>Resume has been uploaded successfully!</span>";
            }

        } else {
            echo "<span style='color:red;'>".$movefile['error']."</span>";
        }        
    }
}

function cf_shortcode() {
    ob_start();
    save_data();
    html_form_code();

    return ob_get_clean();
}
add_shortcode( 'resume_upload_form', 'cf_shortcode' );

function list_data() {  

    global $wpdb;    
    $table_user_info = $wpdb -> prefix."user_info";
    $sql = "SELECT * FROM ".$table_user_info;
    $results = $wpdb -> get_results($sql);
    
    if(count($results) > 0){
        echo '<table>';
        echo '<tr><th>Name</th><th>Email</th><th>Comments</th><th>Resume</th></tr>';
        foreach ($results as $row ) { 
            $row->email;
            $file_name = basename($row->resume); // to get file name
            $file_ext = pathinfo($row->resume, PATHINFO_EXTENSION); 
            $file_link = $row->resume;
            echo '<tr><td>'.$row->name.'</td><td>'.$row->email.'</td><td>'.$row->comments.'</td><td><a href="'.$file_link.'" target="_blank">'.$file_name.'</a></td></tr>';
        }
        echo '</table>';
    }
}

function list_shortcode() {
    ob_start();
    list_data();
    return ob_get_clean();
}
add_shortcode( 'resume_upload_form_list', 'list_shortcode' );

?>