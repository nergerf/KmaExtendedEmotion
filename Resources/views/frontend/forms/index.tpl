{extends file="parent:frontend/forms/index.tpl"}

{* Main content *}
{block name="frontend_index_content"}
	{foreach $kmaEmotionFormAbove as $kmaEmotionAbove}
		<div class="emotion--wrapper kma-wrapper-above" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotionAbove.id}" data-availableDevices="{$kmaEmotionAbove.device}">
		</div>
	{/foreach}

	{$smarty.block.parent}

	{foreach $kmaEmotionFormBelow as $kmaEmotionBelove}
		<div class="emotion--wrapper kma-wrapper-belove" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotionBelove.id}" data-availableDevices="{$kmaEmotionBelove.device}">
		</div>
	{/foreach}
{/block}