<main id="content" class="container container--wide" role="main">

    <article class="article">
        <header class="article__header">
            <h2 class="article__title"><?php echo $title;?></h2>

            <div class="author">
                <span class="author__name">By <?php echo $author;?></span>,
                <span class="author__job">The News Beat Staff Reporter
            </div>

            <p class="byline">Posted on <time pubdate="pubdate"><?php echo $pubdate;?></time></p>

            <?php echo social_share($title, 'top');?>

            <p class="lede"><?php echo $lede;?></p>
        </header>


        <?php if(strpos($identifier, '-db') !== false) {
            // replace <!-- balance --> with the balance template
            // this includes the variable $balancedView
            include('balanced-view.php');
            $article = str_replace('<!-- balance -->', $balancedView, $article);
        }

        echo $article;

        echo social_share($title, 'bottom');
        include('comments.php');
        ?>

    </article>
</main>
