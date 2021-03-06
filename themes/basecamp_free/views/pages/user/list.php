<?php defined('SYSPATH') or die('No direct script access.');?>
<div class="pad_10tb">
	<div class="container">
		<div class="row">
			<div class="<?=(Theme::get('sidebar_position')!='none')?'col-xs-9':'col-xs-12'?> <?=(Theme::get('sidebar_position')=='left')?'pull-right':'pull-left'?>">
				<div class="page-header">
					<h3>
						<?if(count($users)):?>
							<div class="btn-group pull-right">
								<button type="button" id="sort" data-sort="<?=core::request('sort')?>" class="btn btn-base-dark btn-sm dropdown-toggle" data-toggle="dropdown">
									<span class="glyphicon glyphicon-list-alt"></span> <?=__('Sort')?> <span class="caret"></span>
								</button>
								<ul class="dropdown-menu" role="menu" id="sort-list">
								 <?if (Core::config('advertisement.reviews')==1):?>
									<li><a href="?<?=http_build_query(['sort' => 'rating'] + Request::current()->query())?>"><?=__('Rating')?></a></li>
								<?endif?>
									<li><a href="?<?=http_build_query(['sort' => 'name-asc'] + Request::current()->query())?>"><?=__('Name (A-Z)')?></a></li>
									<li><a href="?<?=http_build_query(['sort' => 'name-desc'] + Request::current()->query())?>"><?=__('Name (Z-A)')?></a></li>
									<li><a href="?<?=http_build_query(['sort' => 'created-desc'] + Request::current()->query())?>"><?=__('Newest')?></a></li>
									<li><a href="?<?=http_build_query(['sort' => 'created-asc'] + Request::current()->query())?>"><?=__('Oldest')?></a></li>
									<li><a href="?<?=http_build_query(['sort' => 'ads-desc'] + Request::current()->query())?>"><?=__('More Ads')?></a></li>
									<li><a href="?<?=http_build_query(['sort' => 'ads-asc'] + Request::current()->query())?>"><?=__('Less Ads')?></a></li>
								</ul>
							</div>
						 <?endif?>			
						<?=__('Users')?>
					</h3>
				</div>

					<?=Form::errors()?>
					<?= FORM::open(Route::url('profiles'), array('class'=>'', 'method'=>'GET', 'action'=>''))?>
					<div class="input-group">
						<input type="text" class="form-control" id="search" name="search" placeholder="<?=__('Search')?>" type="search" value="<?=core::request('search')?>" />
							<div class="input-group-btn">
								<?= FORM::button('submit', __('Search'), array('type'=>'submit', 'class'=>'btn btn-default', 'action'=>Route::url('profiles')))?> 
							</div>
					</div>
					<?= FORM::close()?>

					<?if(count($users)):?>

					<div class="clearfix"><br></div>
					<div id="users">
						<?$i = 1; foreach($users as $user ):?>
							<div class="user-block">
								<div class="ub-inner">
									<div class="thumbnail">
										<div class="thumb-img">
											 <span class="badge badge-success"><?=$user->ads_count?> <?=__('Ads')?></span>
											<a title="<?=HTML::chars($user->name)?>" href="<?=Route::url('profile',  array('seoname'=>$user->seoname))?>">
												<img class="img-responsive" style="width: 100%;" src="<?=$user->get_profile_image()?>" alt="<?=__('Profile Picture')?>">
											</a>
											<p class="u-name">
												<?=$user->name?>
											</p>
											
										</div>	
									</div>
								</div>
							</div>
							<?if ($i%4 == 0) :?>
								<div class="clearfix"></div>
							<?endif?>
						<?$i++; endforeach?>
					</div>

					<div class="text-center pad_10">
						<?=$pagination?>
					</div>

					<?elseif (count($users) == 0):?>
						<div class="no_results text-center">
							<span class="nr_badge"><i class="glyphicon glyphicon-info-sign glyphicon"></i></span>
							<p class="nr_info"><?=__('We do not have any users matching your search')?></p>
						</div>
					<?endif?>

			</div>
		
			<?if(Theme::get('sidebar_position')!='none'):?>
	            <?=(Theme::get('sidebar_position')=='left')?View::fragment('sidebar_front','sidebar'):''?>
	            <?=(Theme::get('sidebar_position')=='right')?View::fragment('sidebar_front','sidebar'):''?>
	        <?endif?>
	    </div>
	</div>
</div>	