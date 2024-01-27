<ul>
    <?php
    $catTable = new \functions\DatabaseTable('category', 'id');
    $categories = $catTable->findAll();
    foreach ($categories as $category){
        echo '<li><a href="../categorylist?categoryId=' . $category['id'] . '">' .$category['name'] .'</a></li>';
    }
    ?>
</ul>