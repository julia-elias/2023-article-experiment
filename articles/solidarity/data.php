
<?php

// Everything ends up in one $article array to make it easier to dump everything and see what we're working with. Makes it easier to transition
// to a class or database in the future as well since things are more organized.

$featuredImage = array(
    'caption' => '',
    'src' => getDistURL().'/img/e-coli-bacteria.jpg',
);

$article = array(
    'author' => getAuthor(),
    'pubdate' => PUBDATE,
    'title' => 'Women\'s March calls for reproductive rights',
    'featuredImage' => '',
    'content' => '<p>Samantha Ripple was tattooed with a single word—“JUSTICE”—as she marched with about 500 people through the streets of Seattle Saturday in the latest Women’s March to demand reproductive rights and access to safe, legal abortions.</p>

    <p>“I came out because of the precarity of our democracy,” said Ripple, 22.</p>
    
    <p>Ripple was one of the three demonstrators charged with disturbing the peace, Seattle police said. They were accused of violating a city noise ordinance by using megaphones without a permit. Also charged were Michelle Johnson, 72, and Suzann Brown, 45.</p>
    
    <p>“We have to make our voices heard,” said Johnson, “The Supreme Court is a bunch of men trying to control our bodies, which violates our Constitutional rights.”</p>
    
    <p>The march is one of thousands of demonstrations that have swept the nation following the Supreme Court in June 2022 overturned Roe v. Wade, which had guaranteed a constitutional right to abortion since 1973. These marches are part of a groundswell of grassroots activism fighting for reproductive rights and asking for states to protect access to abortion.</p>
    
    <p>After the Court decision, a number of Republican-led states, mostly in the South and Midwest, implemented laws banning or restricting abortions, while many Democrat-led states have moved forward with measures to protect abortion access. According to the White House, almost 30 million women of reproductive age live in states with an ongoing abortion ban.</p>
    
    <p>Johnson recalled that before Roe v. Wade, her close friend nearly bled to death in a sorority house because she was afraid she could die or get arrested if she sought an illegal abortion.</p>
    
    <p>“I am marching for my friends and others like her,” Johnson said.</p>
    
    <p>Brown said she has marched in a half dozen rallies for abortion rights since Roe was overturned. She became pregnant at age 15. “I agonized about whether to have an abortion,” said Brown, who ultimately put her baby up for adoption. “I’m marching because I can’t imagine not having a choice at that time.”</p>
    
    <p>“Everybody has the right to their own body,” Brown said. “It’s not up to anyone else.”</p>',
    'comments' => array(),
);
?>


