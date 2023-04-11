<main id="content" class="container container--wide" role="main">

    <article class="article">
        <header class="article__header">
            <h2 class="article__title"><?php echo $title;?></h2>

            <?php
            // featured image
            if(isset($img) && !empty($img)) {
                echo 
                    '<figure class="featured-image">
                        <img src="'.get_site_url().'/dist/img/'.$img['src'].'"" alt="'.$img['alt'].'"/>
                        '.(!empty($img['caption']) ? '<figcaption><span class="featured-image__caption">'.$img['caption'].'</span><span class="featured-image__credit">'.$img['credit'].'</span></figcaption>' : '')
                    .'</figure>';
            }

            ?>
            <div class="byline-container">
                <div class="author">
                    <span class="author__name">By <?php echo $author;?></span>,
                    <span class="author__job">The News Beat Staff Reporter
                    <p class="byline">Posted on <time pubdate="pubdate"><?php echo $pubdate;?></time></p>
                </div>

                

                <?php echo social_share($title, 'top');?>
            </span>

        </header>


        <?php 
        
        // article
        echo $article;

        // eyp section
        if(isset($eyp)) {
            include 'eyp.php';
        }

        echo social_share($title, 'bottom');
        include('comments.php');
        ?>

    </article>
</main>
