{extends file="parent:frontend/detail/tabs/description.tpl"}

{block name='frontend_detail_description_title'}
	{foreach $kmaEmotionArticleDescAbove as $kmaEmotion}
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
		<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
		</div>
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
	{/foreach}
	{$smarty.block.parent}
{/block}

{block name='frontend_detail_description_properties'}

	{$smarty.block.parent}
	{foreach $kmaEmotionArticleDescBelow as $nbEmotion}
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
		<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
		</div>
		<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
	{/foreach}
{/block}