<?php

namespace KmaExtendedEmotion\Subscriber;

use Doctrine\Common\Collections\ArrayCollection;
use \Enlight\Event\SubscriberInterface;

class KmaExtendedEmotionSubscriber implements SubscriberInterface
{
    /**
     * @return array
     * Required for adding the register subscriber event before dispatching
     */
    public static function getSubscribedEvents()
    {
        return [
            'Enlight_Controller_Front_StartDispatch' => 'onRegisterSubscriber',
            'Shopware_Console_Add_Command' => 'onRegisterSubscriber',
            'Enlight_Controller_Action_PostDispatchSecure_Frontend' => 'onPostDispatchSecure',
            'Theme_Compiler_Collect_Plugin_Less' => 'onCollectPluginLess'
        ];
    }

	private function getPlugin()
	{
		if($this->plugin == NULL)
			$this->plugin = Shopware()->Container()->get('kernel')->getPlugins()['KmaCustomEmotion'];
		
		return $this->plugin;
	}
	
    public function onPostDispatchSecure(\Enlight_Event_EventArgs $args) 
	{

        // Fetch the controller
        $controller = $args->get('subject');
		
        // Fetch the view and add the plugins view directory
        $view = $controller->View();
		
        $view->addTemplateDir(
           __DIR__ . '/../Resources/views/'
        );

        $request = $args->getSubject()->Request();

        if(strtolower($request->getControllerName()) == "detail" && !empty($view->getAssign("sArticle")))
        {
            $attributes = $view->getAssign("sArticle")["attributes"]["core"];

            if($attributes != NULL)
            {
                $emotionAbove = $this->selectEmotionData($attributes->get("kma_article_emotion_above"));
                $emotionBelow = $this->selectEmotionData($attributes->get("kma_article_emotion_below"));
                $emotionDescAbove = $this->selectEmotionData($attributes->get("kma_article_emotion_desc_above"));
                $emotionDescBelow = $this->selectEmotionData($attributes->get("kma_article_emotion_desc_below"));

                $view->assign("kmaEmotionArticleAbove", $emotionAbove);
                $view->assign("kmaEmotionArticleBelow", $emotionBelow);
                $view->assign("kmaEmotionArticleDescAbove", $emotionDescAbove);
                $view->assign("kmaEmotionArticleDescBelow", $emotionDescBelow);
            }
        }

        if(strtolower($request->getControllerName()) == "listing" || strtolower($request->getControllerName()) == "blog")
        {
            $attributes = $view->getAssign("sCategoryContent")["attributes"]["core"];

            if($attributes != NULL)
            {
                $emotionAbove = $this->selectEmotionData($attributes->get("kma_category_emotion_above"));
                $emotionBelow = $this->selectEmotionData($attributes->get("kma_category_emotion_below"));

                $view->assign("kmaEmotionCategoryAbove", $emotionAbove);
                $view->assign("kmaEmotionCategoryBelow", $emotionBelow);
            }

        }

        if(strtolower($request->getControllerName()) == "custom")
        {
            $attributes = $view->getAssign("sCustomPage")["attribute"];

            if($attributes != NULL)
            {
                $emotionAbove = $this->selectEmotionData($view->getAssign("sCustomPage")["attribute"]["kma_cms_static_emotion_above"]);
                $emotionBelow = $this->selectEmotionData($view->getAssign("sCustomPage")["attribute"]["kma_cms_static_emotion_below"]);

                $view->assign("kmaEmotionCustomAbove", $emotionAbove);
                $view->assign("kmaEmotionCustomleBelow", $emotionBelow);


            }
        }

    }

    private function selectEmotionData($attribute)
    {
        try
        {
            $attribute = explode("|", $attribute);
            unset($attribute[count($attribute)-1]);
            unset($attribute[0]);
            $attribute = array_values($attribute);//remap array indices
            $placeholders = str_repeat ('?, ',  count ($attribute) - 1) . '?';

            return Shopware()->Db()->query("SELECT id, device
				FROM s_emotion 
				WHERE id IN (".$placeholders.")
				AND active = 1
				ORDER BY position ASC", $attribute)->fetchAll();
        }
        catch(\Exception $e)
        {
            return [];
        }
    }

    public function onCollectPluginLess() 
	{
		
        $less = new \Shopware\Components\Theme\LessDefinition(
            array(
			
			),
            [$this->getPlugin()->getPath() . '/Resources/views/frontend/_public/src/less/all.less'],
			__DIR__
        ); 
		
		return new ArrayCollection(array($less));
    }

}

?>