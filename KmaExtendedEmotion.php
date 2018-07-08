<?php

 namespace KmaExtendedEmotion;

 use Shopware\Components\Plugin;
 use Shopware\Components\Plugin\Context\ActivateContext;
 use Shopware\Components\Plugin\Context\DeactivateContext;
 use Shopware\Components\Plugin\Context\InstallContext;
 use Shopware\Components\Plugin\Context\UpdateContext;
 use Shopware\Components\Plugin\Context\UninstallContext;

 class KmaExtendedEmotion extends Plugin {

     /**
      * @param InstallContext $context
      * This method is called on plugin installation
      * @throws \Exception
      */
     public function install(InstallContext $context)
     {

         $attributeService = $this->container->get('shopware_attribute.crud_service');

         $attributeService->update(
             's_articles_attributes',
             'kma_article_emotion_above',
             'multi_selection',
             [
                 'label' => 'Einkaufswelt oberhalb Artikel',
                 'displayInBackend' => true,
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
             's_articles_attributes',
             'kma_article_emotion_below',
             'multi_selection',
             [
                 'label' => 'Einkaufswelt unterhalb Artikel',
                 'displayInBackend' => true,
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
             's_articles_attributes',
             'kma_article_emotion_desc_above',
             'multi_selection',
             [
                 'label' => 'Einkaufswelt über Artikelbeschreibung',
                 'displayInBackend' => true,
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
             's_articles_attributes',
             'kma_article_emotion_desc_below',
             'multi_selection',
             [
                 'label' => 'Einkaufswelt unter Artikelbeschreibung',
                 'displayInBackend' => true,
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
             's_categories_attributes',
             'kma_category_emotion_above',
             'multi_selection',
             [
                 'label' => 'Einkaufswelt oberhalb Kategorielisting',
                 'displayInBackend' => true,
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
             's_categories_attributes',
             'kma_category_emotion_below',
             'multi_selection',
             [
                 'label' => 'Einkaufswelt unterhalb Kategorielisting',
                 'displayInBackend' => true,
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
             's_cms_static_attributes',
             'kma_cms_static_emotion_above',
             'multi_selection',
             [
                 'displayInBackend' => true,
                 'label' => 'Einkaufswelt oberhalb Inhalt',
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
             's_cms_static_attributes',
             'kma_cms_static_emotion_below',
             'multi_selection',
             [
                 'displayInBackend' => true,
                 'label' => 'Einkaufswelt unterhalb Inhalt',
                 'translatable' => true,
                 'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                 'arrayStore' => ""
             ],
             null, true
         );

         $attributeService->update(
            's_blog_attributes',
            'kma_blog_emotion_above',
            'multi_selection',
            [
                'displayInBackend' => true,
                'label' => 'Einkaufswelt oberhalb Inhalt',
                'translatable' => true,
                'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                'arrayStore' => ""
            ],
            null, true
        );

        $attributeService->update(
            's_blog_attributes',
            'kma_blog_emotion_below',
            'multi_selection',
            [
                'displayInBackend' => true,
                'label' => 'Einkaufswelt unterhalb Inhalt',
                'translatable' => true,
                'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                'arrayStore' => ""
            ],
            null, true
        );

        $attributeService->update(
            's_cms_support_attributes',
            'kma_cms_support_emotion_above',
            'multi_selection',
            [
                'displayInBackend' => true,
                'label' => 'Einkaufswelt oberhalb Inhalt',
                'translatable' => true,
                'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                'arrayStore' => ""
            ],
            null, true
        );

        $attributeService->update(
            's_cms_support_attributes',
            'kma_cms_support_emotion_below',
            'multi_selection',
            [
                'displayInBackend' => true,
                'label' => 'Einkaufswelt unterhalb Inhalt',
                'translatable' => true,
                'columnType' => 'single_selection', 'entity' => "Shopware\Models\Emotion\Emotion",
                'arrayStore' => ""
            ],
            null, true
        );

         parent::install($context);

     }


     /**
      * @param UpdateContext $context
      * This method is called on update of the plugin
      */
     public function update(UpdateContext $context)
     {
         $context->scheduleClearCache(UpdateContext::CACHE_LIST_ALL);

         return parent::update($context);
     }

     /**
      * @param ActivateContext $context
      * This method is called on activation of the plugin
      */
     public function activate(ActivateContext $context)
     {
         $context->scheduleClearCache(ActivateContext::CACHE_LIST_ALL);

         return parent::activate($context);
     }

     /**
      * @param DeactivateContext $context
      * This method is called on deactivation of the plugin
      */
     public function deactivate(DeactivateContext $context)
     {
         $context->scheduleClearCache(DeactivateContext::CACHE_LIST_ALL);

         return parent::deactivate($context);
     }

     /**
      * @param UninstallContext $context
      * This method is called once on uninstallation of the plugin
      * @throws \Exception
      */
     public function uninstall(UninstallContext $context)
     {
         if($context->keepUserData()) {
            return;
         }

         $attributeService = $this->container->get('shopware_attribute.crud_service');

         $attributeService->delete('s_articles_attributes', 'kma_article_emotion_above');
         $attributeService->delete('s_articles_attributes', 'kma_article_emotion_below');
         $attributeService->delete('s_articles_attributes', 'kma_article_emotion_desc_above');
         $attributeService->delete('s_articles_attributes', 'kma_article_emotion_desc_below' );

         $attributeService->delete('s_categories_attributes', 'kma_category_emotion_above');
         $attributeService->delete('s_categories_attributes', 'kma_category_emotion_below');

         $attributeService->delete('s_cms_static_attributes', 'kma_cms_static_emotion_above');
         $attributeService->delete('s_cms_static_attributes', 'kma_cms_static_emotion_below');

         $attributeService->delete('s_blog_attributes', 'kma_blog_emotion_above');
         $attributeService->delete('s_blog_attributes'. 'kma_blog_emotion_below');

         $attributeService->delete('s_cms_support_attributes', 'kma_cms_support_emotion_above');
         $attributeService->delete('s_cms_support_attributes', 'kma_cms_support_emotion_below');

         $context->scheduleClearCache(InstallContext::CACHE_LIST_ALL);

         return parent::uninstall($context);
     }
 }