<?php

class PageView extends CWidget {

    public $model;
    public $fields = array();
    private $page;

    public function init() {

        //check for required arguments
        if (!$this->model)
            throw new CHttpException('500', '$model must be provided for PageView Widget');

        //users do not tend to use array for single item
        if (!is_array($this->fields)) {
            $tmp = array();
            $tmp[0] = $this->fields;
            $this->fields = $tmp;
        }

        //get Page
        if (get_class($this->model) == 'Page')
            $this->page = $this->model;
        else
            $this->page = $this->model->page; //for update
    }

    public function run() {

        $page = $this->page;

        foreach ($this->fields as $field) {

            switch ($field) {
                case 'title':
                ?>
                <h1 itemprop="headline"><?php echo $page->title; ?></h1>
                <?php
                break;
                case 'content':
                echo '<div class="rte-text" itemprop="articleBody">' . $page->content . "</div>";
                break;
                case 'created_at':
                echo '<div class="post-time">' . Yii::t('app', 'Posted on ') . '<span itemprop="datePublished">' . date('F d, Y h:m A', strtotime($page->created_at)) . "</span></div>";
                break;
                case 'excerpt':
                if (!empty($page->content)) {
                    ?>
                    <div class="field">
                        <div class="field_value">
                            <?php echo $page->getExcerpt(); ?>
                        </div>
                    </div>
                    <?php
                }
                break;
                case 'sub-pages':
                if (count($page->pages)) {
                    ?>
                    <h2><?php echo CHtml::link(Yii::t('app', Awecms::pluralize('Sub-Page', 'Sub-Pages', count($page->pages))), array('/page/page')); ?></h2>
                    <ul class="sub_pages">
                        <?php
                        if (is_array($page->pages))
                            foreach ($page->pages as $foreignobj) {
                                echo '<li>';
                                echo CHtml::link($foreignobj->title, array('/page/page/view', 'id' => $foreignobj->id));
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    break;
                    case 'categories':
                    if (Yii::app()->hasModule('category') && count($page->categories)) {
                        ?>
                        <h2><?php echo CHtml::link(Yii::t('app', Awecms::pluralize('Category', 'Categories', count($page->categories))), array('/category/category')); ?></h2>
                        <ul class="categories">
                            <?php
                            if (is_array($page->categories))
                                foreach ($page->categories as $foreignobj) {
                                    echo '<li>
                                    <a href="' . Yii::app()->createUrl('/category/category/view', array('id' => $foreignobj->id)) . '">
                                    <span itemprop="articleSection">' . $foreignobj->name . '</span>
                                    </a>
                                    </li>';
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        break;
                        case 'views':
                        if (!empty($page->views)) {
                            ?>
                            <div class="field">
                                <?php echo CHtml::encode($page->getAttributeLabel('views')); ?>:
                                <?php echo $page->views; ?>
                            </div>
                            <?php
                        }
                        break;
                        case 'tags':
                        if (Yii::app()->hasModule('tag')) {
                            $tags = $page->getTags();
                            if (!empty($tags)) {
                                ?>
                                <div class="field">
                                    <div class="field-name"><?php echo Yii::t('app', 'Tags'); ?>:</div>
                                    <div class="field-value">
                                        <?php
                                        echo '<span class="tags" itemprop="keywords">' . implode(', ', $tags) . '</span>';
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        break;
                        default :
                        break;
                    }
                }
            }

        }