<?php

namespace KmaExtendedEmotion\Subscriber;

use Doctrine\DBAL\Connection;
use Enlight\Event\SubscriberInterface;
use Shopware\Bundle\AttributeBundle\Service\DataLoader;

class KmaExtendedEmotionSubscriber implements SubscriberInterface
{
    /**
     * @var string
     */
    private $pluginPath;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var DataLoader
     */
    private $attributeLoader;

    /**
     * @param string
     * @param Connection $connection
     */
    public function __construct($pluginPath, Connection $connection, DataLoader $attributeLoader)
    {
        $this->pluginPath = $pluginPath;
        $this->connection = $connection;
        $this->attributeLoader = $attributeLoader;
    }

    /**
     * @return array
     *               Required for adding the register subscriber event before dispatching
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Listing' => 'onListingPostDispatch',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Blog' => 'onBlogPostDispatch',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Detail' => 'onDetailPostDispatch',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Custom' => 'onCustomPagePostDispatch',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend_Forms' => 'onFormPagePostDispatch'
        ];
    }

    /**
     * Extend listing
     *
     * @param \Enlight_Event_EventArgs $args
     */
    public function onListingPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $subject */
        $controller = $args->getSubject();
        $request = $controller->Request();
        $view = $controller->View();

        $categoryId = $request->getParam('sCategory', 0);

        if (!$categoryId) {
            return;
        }

        $categoryAttributes = $this->attributeLoader->load('s_categories_attributes', $categoryId);

        $emotionAbove = $this->selectEmotionData($categoryAttributes['kma_category_emotion_above']);
        $emotionBelow = $this->selectEmotionData($categoryAttributes['kma_category_emotion_below']);

        $view->assign('kmaEmotionCategoryAbove', $emotionAbove);
        $view->assign('kmaEmotionCategoryBelow', $emotionBelow);

        $view->addTemplateDir($this->pluginPath . '/Resources/views/');
    }
    
    /**
     * Extend blog detail page
     *
     * @param \Enlight_Event_EventArgs $args
     */
    public function onBlogPostDispatch(\Enlight_Event_EventArgs $args) {
        
        /** @var \Enlight_Controller_Action $subject */
        $controller = $args->getSubject();
        $request = $controller->Request();
        $view = $controller->View();

        $actionName = strtolower($request->getActionName());

        if($actionName == 'detail') {
            $parameterName = 'blogArticle';
            $attributesTable = 's_blog_attributes';
            $attributeNameAbove = 'kma_blog_emotion_above';
            $attributeNameBelow = 'kma_blog_emotion_below';
            $viewVariableNameEmotionAbove = 'kmaEmotionBlogAbove';
            $viewVariableNameEmotionBelow = 'kmaEmotionBlogBelow';
        }else{
            $parameterName = 'sCategory';
            $attributesTable = 's_categories_attributes';
            $attributeNameAbove = 'kma_category_emotion_above';
            $attributeNameBelow = 'kma_category_emotion_below';
            $viewVariableNameEmotionAbove = 'kmaEmotionBlogCategoryAbove';
            $viewVariableNameEmotionBelow = 'kmaEmotionBlogCategoryBelow';
        }

        $id = $request->getParam($parameterName, 0);
        
        if(!$id) {
            return;
        }

        $attributes = $this->attributeLoader->load($attributesTable, $id);

        $emotionAbove = $this->selectEmotionData($attributes[$attributeNameAbove]);
        $emotionBelow = $this->selectEmotionData($attributes[$attributeNameBelow]);

        $view->assign($viewVariableNameEmotionAbove, $emotionAbove);
        $view->assign($viewVariableNameEmotionBelow, $emotionBelow);    

        $view->addTemplateDir($this->pluginPath . '/Resources/views/');
    }

    /**
     * Extend detail page of product
     *
     * @param \Enlight_Event_EventArgs $args
     */
    public function onDetailPostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $subject */
        $controller = $args->getSubject();
        $request = $controller->Request();
        $view = $controller->View();

        $articleId = $request->getParam('sArticle', 0);

        if (!$articleId) {
            return;
        }

        $articleAttributes = $this->attributeLoader->load('s_articles_attributes', $articleId);

        $emotionAbove = $this->selectEmotionData($articleAttributes['kma_article_emotion_above']);
        $emotionBelow = $this->selectEmotionData($articleAttributes['kma_article_emotion_below']);
        $emotionDescAbove = $this->selectEmotionData($articleAttributes['kma_article_emotion_desc_above']);
        $emotionDescBelow = $this->selectEmotionData($articleAttributes['kma_article_emotion_desc_below']);

        $view->assign('kmaEmotionArticleAbove', $emotionAbove);
        $view->assign('kmaEmotionArticleBelow', $emotionBelow);
        $view->assign('kmaEmotionArticleDescAbove', $emotionDescAbove);
        $view->assign('kmaEmotionArticleDescBelow', $emotionDescBelow);

        $view->addTemplateDir($this->pluginPath . '/Resources/views/');
    }

    /**
     * Extend custom page
     *
     * @param \Enlight_Event_EventArgs $args
     */
    public function onCustomPagePostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $subject */
        $controller = $args->getSubject();
        $request = $controller->Request();
        $view = $controller->View();

        $customPageId = $request->getParam('sCustom', 0);

        if(!$customPageId) {
            return;
        }

        $customPageAttributes = $this->attributeLoader->load('s_cms_static_attributes', $customPageId);

        $emotionAbove = $this->selectEmotionData($customPageAttributes['kma_cms_static_emotion_above']);
        $emotionBelow = $this->selectEmotionData($customPageAttributes['kma_cms_static_emotion_below']);

        $view->assign('kmaEmotionCustomPageAbove', $emotionAbove);
        $view->assign('kmaEmotionCustomPageBelow', $emotionBelow);

        $view->addTemplateDir($this->pluginPath . '/Resources/views/');
    }

    /**
     * Extend form page
     *
     * @param \Enlight_Event_EventArgs $args
     */
    public function onFormPagePostDispatch(\Enlight_Event_EventArgs $args)
    {
        /** @var \Enlight_Controller_Action $subject */
        $controller = $args->getSubject();
        $request = $controller->Request();
        $view = $controller->View();

        $formId = $request->getParam('sFid', 0);

        if(!$formId) {
            return;
        }

        $formAttributes = $this->attributeLoader->load('s_cms_support_attributes', $formId);

        $emotionAbove = $this->selectEmotionData($formAttributes['kma_cms_support_emotion_above']);
        $emotionBelow = $this->selectEmotionData($formAttributes['kma_cms_support_emotion_below']);

        $view->assign('kmaEmotionFormAbove', $emotionAbove);
        $view->assign('kmaEmotionFormBelow', $emotionBelow);

        $view->addTemplateDir($this->pluginPath . '/Resources/views/');
    }

    /**
     * Helper to get the emotion world from the database
     *
     * @param array $attribute
     * @return array
     */
    private function selectEmotionData($attribute)
    {
        $attributes = explode('|', $attribute);
        $attributes = array_filter($attributes);
        $ids = array_values($attributes);

        $emotionWorlds = $this->connection->createQueryBuilder()
            ->select(['id', 'device'])
            ->from('s_emotion')
            ->where('id IN (:ids)')
            ->andWhere('active = 1')
            ->setParameter(':ids', $ids, Connection::PARAM_INT_ARRAY)
            ->orderBy('position', 'ASC')
            ->execute()
            ->fetchAll();

        return $emotionWorlds;
    }
}
