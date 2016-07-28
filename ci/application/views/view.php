
<br><br><br>

<?php

  foreach ($photo as $reso => $listt) {

    $image= $listt['image'];
  echo "<br /><br /><img  id='previewing' width='200' height='200' src='".base_url($image)."' alt='Profile Pic'>";

    //$title=$listt['title'];

  }

$image=$news_item['image'];

//  echo "<br /><br /><img  id='previewing' width='200' height='200' src='".base_url($image)."' alt='Profile Pic'>";
echo '<h2>'.$news_item['title'].'</h2>';
echo $news_item['body'];
echo "<br>";

echo"<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
