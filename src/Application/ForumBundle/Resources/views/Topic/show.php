<?php $view->extend('ForumBundle::layout.php') ?>
<?php $view['slots']->set('title', $topic->getSubject()) ?>
<div class="forum forum_topic">

    <ul class="crumbs">
        <li><a href="<?php echo $view['forum']->urlFor() ?>">Forum</a></li>
        <li><a href="<?php echo $view['forum']->urlForCategory($topic->getCategory()) ?>"><?php echo $topic->getCategory()->getName() ?></a></li>
        <li><?php echo $view['lichess']->escape($topic->getSubject()) ?></li>
    </ul>

    <div class="topic">
        <h2><?php echo $view['lichess']->escape($topic->getSubject()) ?></h2>
        <?php echo $view->render('ForumBundle:Post:list.php', array('posts' => $posts)) ?>
    </div>

    <div class="topic_reply">
        <?php echo $view['actions']->render('ForumBundle:Post:new', array('topicId' => $topic->getId())) ?>
    </div>

</div>