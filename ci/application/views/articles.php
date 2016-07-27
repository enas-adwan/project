
<?php foreach ($articles as $news_item): ?>

        <h3><?php echo $news_item['title']; ?></h3>
        <div class="main">
                <?php echo $news_item['body']; ?>
                  
        </div>
   <p><a href="<?php echo site_url('user_controller/'.$news_item['slug']); ?>">View article</a></p>
    <?php endforeach; ?>
