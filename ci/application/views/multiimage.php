<?php
echo "hello";
?>
<?php
//  $info=array('id'=>'reg',
          //  'name'=>'reg'
          //  );


        //  echo form_open_multipart('User_controller/updateArticleelement/$news_item['id_article'] ');
    echo form_open_multipart(site_url('User_controller/trymulti'));
          ?>



 <input type="file"  name="img[]" multiple />
   <?php echo form_error('img'); ?>
        <input type="submit" class="btn btn-primary" >
</form>
