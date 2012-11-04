<?php

class TagCloud extends AwePortlet {

    public $title;
    public $maxTags = 20;

    public function init() {
        if (!$this->title) $this->title = Yii::t('app','Tag Cloud');
        parent::init();
    }

    protected function findTagWeights($models) {
        $total = 0;
        foreach ($models as $model)
            $total+=$model['count'];

        $tags = array();
        if ($total > 0) {
            foreach ($models as $model)
                $tags[$model['name']] = 8 + (int) (64 * $model['count'] / ($total + 8));
            ksort($tags);
        }
        return $tags;
    }

    public function run() {
        $tags = Page::model()->getAllTagsWithModelsCount(
                array(
                    'order' => 'count DESC',
                    'limit' => $this->maxTags,
                )
        );

        $weight = $this->findTagWeights($tags);
        asort($tags);
        foreach ($tags as $tag) {
            if ($tag['count'] >= 1) {
                $link = CHtml::link(CHtml::encode($tag['name']), array('/tag/'.$tag['name']));
                echo CHtml::tag('span', array(
                    'class' => 'tagcloud',
                    'style' => "font-size:" . (2 + $weight[$tag['name']]) . "pt",
                        ), $link) . CHtml::tag('span', array('style' => "font-size:8pt",), (($tag['count'] > 1) ? '(' . $tag['count'] . ') ' : ' '));
            }
        }
        parent::run();
    }

}