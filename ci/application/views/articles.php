
<?php echo "<br><br>";
foreach ($articles as $news_item): ?>

       <h3><?php echo $news_item['title']; ?></h3>
     <div class="main">
       <?php
       $string=$news_item['body'];
       if(strlen($string) >= 100){
       // limit it to 5
       $string = substr($string, 0, 270);
       }

       ?>
        <?php echo $string; ?><a href="<?php echo site_url('user_controller/'.$news_item['slug']); ?>">read more</a></p>


            Author:    <?php echo $news_item['name']; ?>

        </div>


    <?php endforeach; ?>
<br><br><br><br><br><br><br>
