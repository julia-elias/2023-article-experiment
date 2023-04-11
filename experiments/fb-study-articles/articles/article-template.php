<!DOCTYPE html>
<html>
<head>
    <?php
        function get_the_ip() {
            //Just get the headers if we can or else use the SERVER global
            if ( function_exists( 'apache_request_headers' ) ) {
                $headers = apache_request_headers();
            } else {
                $headers = $_SERVER;
            }
            //Get the forwarded IP if it exists
            if ( array_key_exists( 'X-Forwarded-For', $headers ) && filter_var( $headers['X-Forwarded-For'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 ) ) {
                $the_ip = $headers['X-Forwarded-For'];
            } elseif ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $headers ) && filter_var( $headers['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 )) {
                $the_ip = $headers['HTTP_X_FORWARDED_FOR'];
            } else {
                $the_ip = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
            }
            if(!empty($the_ip)){
                return $the_ip;
            } else {
                return false;
            }
        }

        $user_ip = get_the_ip();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $title_tag;?></title>

    <?php $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
    <link rel="stylesheet" href="../style.css" />
    <!-- Typekit Fonts -->
    <script src="https://use.typekit.net/rca2zto.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>

    <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
    <![endif]-->
    <?php
    // only show analytics if not on dev
    if(!strpos($current_url, '://dev')) :?>
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-52471115-3', 'auto');
          ga('send', 'pageview');

        </script>
    <? endif;?>

</head>

<body class="<?php echo $identifier;?>">
    <div id="user-ip" class="hidden" data-ip="<? echo $user_ip;?>"></div>

<header class="header" role="banner">
    <div class="container container--wide">
        <div class="site-title"><?php echo $logo;?></div>
    </div>
</header>

<main id="content" class="container" role="main">
    <article class="article">
        <header class="article-header">
            <h2 class="article-title"><? echo $title;?></h2>
            <p class="byline">By <span class="author"><?echo $author;?></span> <time class="pubdate" pubdate="pubdate"><? echo $pubdate;?></time></p>
        </header>



        <!--<img class="article-img article-img--featured" src="<? echo $featured_img;?>" />-->

        <? echo $article;?>

    </article>
    <?php
        if($identifier === 'hillary-cross-check' || $identifier === 'trump-cross-check') { ?>
            <aside class="sidebar">
                <h4 class="aside--title">Crosschecked by</h4>
                <img src="img/badges/usa-today.png"/>
                <img src="img/badges/msnbc.png"/>
                <img src="img/badges/fox-news.png"/>
            </aside>
        <?php } ?>


    <? if(!empty($comments)) {?>
        <div class="show-comments-wrap"><a class="show-comments btn" href="#">Show Comments</a></div>
        <section class="comments-section">
            <h2 class="comment-section-title">Comments</h2>
            <ul class="comments">
            <? foreach($comments as $comment) {?>
                <li class="comment">
                    <p class="comment-info">
                        <span class="comment-name"><? echo $comment['name'];?></span>
                        <span class="comment-time"><? echo $comment['time'];?></span>
                    </p>
                    <div class="comment-content">
                        <? echo $comment['comment'];?>
                    </div>
                </li>
            <? }?>
            </ul>

            <div class="new-comment">
                <h3 class="add-comment-title">Add Comment</h3>
                <form class="add-comment">
                    <label for="commenter-name">Name</label>
                    <input type="text" class="form-control" name="commenter-name" id="commenter-name" placeholder="Enter Name" value="" >

                    <label for="commenter-comment">Comment</label>
                    <textarea class="form-control" rows="3" name="commenter-comment" id="commenter-comment" placeholder="Enter Comment"></textarea>

                    <input type="hidden" id="comment-identifier" name="comment-identifier" value="<? echo $identifier;?>" />
                    <input id="submit-comment" type="button" class="btn btn-submit" value="Submit">
                </form>
            </div>
        </section>
    <? } ?>







</main>
<footer class="colophon container container--wide">
    <div class="row row--wide">
        <p class="copyright center">This material may not be published, broadcast, rewritten, or redistributed.<br/>&copy; <? echo Date('Y');?> The News Beat, LLC. All Rights Reserved.</p>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../js/scripts.js"></script>
<script src="../js/post-with-comments.js"></script>
</body>
</html>
