{extends file="parent:frontend/blog/index.tpl"}

{* Main content *}
{block name='frontend_index_content'}
	{debug}
	<div class="blog--content block-group">
		{foreach $kmaEmotionCategoryAbove as $kmaEmotion}
			<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
				<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			</div>
		{/foreach}

		{* Blog Sidebar *}
		{block name='frontend_blog_listing_sidebar'}
			{include file='frontend/blog/listing_sidebar.tpl'}
		{/block}

		{* Blog Banner *}
		{block name='frontend_blog_index_banner'}
			{include file="frontend/listing/banner.tpl"}
		{/block}

		{* Blog listing *}
		{block name='frontend_blog_index_listing'}
			{include file="frontend/blog/listing.tpl"}
		{/block}
		{foreach $kmaEmotionCategoryBelow as $kmaEmotion}
			<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			<div class="emotion--wrapper" data-controllerUrl="{url module=widgets controller=emotion action=index emotionId=$kmaEmotion.id}" data-availableDevices="{$kmaEmotion.device}">
				<div style="clear:both;height:0;margin:0;padding:0;background:transparent;border:none;"></div>
			</div>
		{/foreach}
	</div>
{/block}