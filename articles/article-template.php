<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><? echo $title;?> | The News Beat</title>

    <?php $current_url = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
    <meta property="og:site_name" content="The News Beat"/>
    <meta property="og:title" content="<? echo $title;?>"/>
    <meta property="og:image" content="<? echo dirname(dirname($current_url)) .'/articles/'. $featured_img;?>"/>
    <meta property="og:url" content="<? echo $current_url;?>"/>
    <meta property="og:description" content="<? echo strip_tags(substr($article,0,240))?>&hellip;" />

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

<body>

<header class="header container container--wide" role="banner">
    <div class="site-title">The News Beat</div>
</header>

<main id="content" class="container" role="main">
    <article class="article">
        <header class="article-header">
            <h2 class="article-title"><? echo $title;?></h2>
            <p class="byline">By <span class="author"><?echo $author;?></span> <time class="pubdate" pubdate="pubdate"><? echo $pubdate;?></time></p>
        </header>

        <ul class="social-share social-share--top">
            <li class="social-share__item social-share__item--facebook">
                <a class="social-share__link social-share__link--facebook social-share__link--facebook-top" data-action="Facebook Share" data-label="Top" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<? print(urlencode($current_url));?>', 'facebook_share_dialog', 'width=626,height=436');return false;">
                    <span class="icon-social icon-social--facebook" role="presentation" aria-hidden="true">
                        <svg viewBox="0 0 33 33" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M 17.996,32L 12,32 L 12,16 l-4,0 l0-5.514 l 4-0.002l-0.006-3.248C 11.993,2.737, 13.213,0, 18.512,0l 4.412,0 l0,5.515 l-2.757,0 c-2.063,0-2.163,0.77-2.163,2.209l-0.008,2.76l 4.959,0 l-0.585,5.514L 18,16L 17.996,32z"></path></g></svg>
                    </span>
                     Share on Facebook
                </a>
            </li>
            <li class="social-share__item social-share__item--twitter">
                <a class="social-share__link social-share__link--twitter social-share__link--twitter-top" data-action="Twitter Share" data-label="Top" href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?print(urlencode($title));?> <? print(urlencode($current_url));?>', 'twitter-share-dialog', 'width=626,height=436');return false;">
                    <span class="icon-social icon-social--twitter" role="presentation" aria-hidden="true" >
                        <svg viewBox="0 0 33 33" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M 32,6.076c-1.177,0.522-2.443,0.875-3.771,1.034c 1.355-0.813, 2.396-2.099, 2.887-3.632 c-1.269,0.752-2.674,1.299-4.169,1.593c-1.198-1.276-2.904-2.073-4.792-2.073c-3.626,0-6.565,2.939-6.565,6.565 c0,0.515, 0.058,1.016, 0.17,1.496c-5.456-0.274-10.294-2.888-13.532-6.86c-0.565,0.97-0.889,2.097-0.889,3.301 c0,2.278, 1.159,4.287, 2.921,5.465c-1.076-0.034-2.088-0.329-2.974-0.821c-0.001,0.027-0.001,0.055-0.001,0.083 c0,3.181, 2.263,5.834, 5.266,6.438c-0.551,0.15-1.131,0.23-1.73,0.23c-0.423,0-0.834-0.041-1.235-0.118 c 0.836,2.608, 3.26,4.506, 6.133,4.559c-2.247,1.761-5.078,2.81-8.154,2.81c-0.53,0-1.052-0.031-1.566-0.092 c 2.905,1.863, 6.356,2.95, 10.064,2.95c 12.076,0, 18.679-10.004, 18.679-18.68c0-0.285-0.006-0.568-0.019-0.849 C 30.007,8.548, 31.12,7.392, 32,6.076z"></path></g></svg>
                    </span>
                     Share on Twitter
                </a>
            </li>
        </ul>

        <img class="article-img article-img--featured" src="<? echo $featured_img;?>" />

        <? echo $article;?>

        <ul class="social-share social-share--bottom">
            <li class="social-share__item social-share__item--facebook">
                <a class="social-share__link social-share__link--facebook social-share__link--facebook-bottom" data-action="Facebook Share" data-label="Bottom" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<? print(urlencode($current_url));?>', 'facebook_share_dialog', 'width=626,height=436');return false;">
                    <span class="icon-social icon-social--facebook" role="presentation" aria-hidden="true">
                        <svg viewBox="0 0 33 33" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M 17.996,32L 12,32 L 12,16 l-4,0 l0-5.514 l 4-0.002l-0.006-3.248C 11.993,2.737, 13.213,0, 18.512,0l 4.412,0 l0,5.515 l-2.757,0 c-2.063,0-2.163,0.77-2.163,2.209l-0.008,2.76l 4.959,0 l-0.585,5.514L 18,16L 17.996,32z"></path></g></svg>
                    </span>
                     Share on Facebook
                </a>
            </li>
            <li class="social-share__item social-share__item--twitter">
                <a class="social-share__link social-share__link--twitter social-share__link--twitter-bottom" data-action="Twitter Share" data-label="Bottom" href="#" onclick="window.open('http://twitter.com/intent/tweet?status=<?print(urlencode($title));?> <? print(urlencode($current_url));?>', 'twitter-share-dialog', 'width=626,height=436');return false;">
                    <span class="icon-social icon-social--twitter" role="presentation" aria-hidden="true" >
                        <svg viewBox="0 0 33 33" width="25" height="25" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g><path d="M 32,6.076c-1.177,0.522-2.443,0.875-3.771,1.034c 1.355-0.813, 2.396-2.099, 2.887-3.632 c-1.269,0.752-2.674,1.299-4.169,1.593c-1.198-1.276-2.904-2.073-4.792-2.073c-3.626,0-6.565,2.939-6.565,6.565 c0,0.515, 0.058,1.016, 0.17,1.496c-5.456-0.274-10.294-2.888-13.532-6.86c-0.565,0.97-0.889,2.097-0.889,3.301 c0,2.278, 1.159,4.287, 2.921,5.465c-1.076-0.034-2.088-0.329-2.974-0.821c-0.001,0.027-0.001,0.055-0.001,0.083 c0,3.181, 2.263,5.834, 5.266,6.438c-0.551,0.15-1.131,0.23-1.73,0.23c-0.423,0-0.834-0.041-1.235-0.118 c 0.836,2.608, 3.26,4.506, 6.133,4.559c-2.247,1.761-5.078,2.81-8.154,2.81c-0.53,0-1.052-0.031-1.566-0.092 c 2.905,1.863, 6.356,2.95, 10.064,2.95c 12.076,0, 18.679-10.004, 18.679-18.68c0-0.285-0.006-0.568-0.019-0.849 C 30.007,8.548, 31.12,7.392, 32,6.076z"></path></g></svg>
                    </span>
                     Share on Twitter
                </a>
            </li>
        </ul>
    </article>

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
