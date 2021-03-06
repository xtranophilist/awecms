<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/normalize.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/foundation.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/base.css">

    <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/vendor/custom.modernizr.js"></script>
</head>

<body itemscope itemtype="http://schema.org/<?php echo $this->webpageType; ?>">

    <?php include_once '_header.php'; ?>

    <div class="row crumb">
        <?php //TODO: show up some message and breadcrumb like Home /Index when user is not signed in and is in home page  ?>

    </div>

    <div class="row main">

    <!-- Main content comes before left sidebar in HTML such that sidebar can be pushed after it for small screens, also provides SEO advantages-->
     <div itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/WebPageElement" class="column large-13 small-15 content">
        <?php echo $content; ?>
    </div>

    <!-- Add a horizontal line between main content and sidebar pushed to bottom, for small screens-->
    <hr class="show-for-small"/>

    <div itemscope itemtype="http://schema.org/WPSideBar" class="column large-3 sidebar">
     <?php //$this->widget('MenuRenderer', array('id'=>3)); ?>
     <?php $this->widget('Events'); ?>
 </div>

</div>

<?php include_once '_footer.php'; ?>
<?php $this->widget('GAnalytics'); ?>

</body>
</html>