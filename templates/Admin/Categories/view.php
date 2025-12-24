<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Category $category
 */
use Cake\Core\Configure;

$prefix = strtolower( $this->request->getParam('prefix') ?? '' );
$controller = $this->request->getParam('controller');
$action = $this->request->getParam('action');

$global_config = (array) Configure::read('Theme.' . $prefix . '.config.template.view');
$local_config = [
	// #################################### More config params in: \JeffAdmin5\config\config.php ####################################
	//'show_related_tables'	=> false,
	//'show_id' 			=> false,	// for view form
	//'show_pos' 	 		=> false,	// for view form
	//'show_counters' 		=> false,	// for view form
	//'index_show_id' 		=> false,	// for related tables
	//'index_show_visible' 	=> false,	// for related tables
	//'index_show_counters'	=> false,	// for related tables
];
$config = array_merge($global_config, $local_config);
?>
				<div class="view row">
					<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">
						<div class="card mb-3">

							<div class="card-header">
								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-eye fa-spin"></i> <?= __('View') ?>: <?= __('Category') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>
								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Categories", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button"]
									) ?>
								</div>

								<div class="form-tab float-end">
									<ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="tab-first" data-bs-toggle="tab" data-bs-target="#tabPanelMain" type="button" role="tab" aria-controls="tabPanelMain" aria-selected="true"><?= __('Basic data') ?></button>
										</li>

										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabDescription" data-bs-toggle="tab" data-bs-target="#tabPanelDescription" type="button" role="tab" aria-controls="tabPanelDescription" aria-selected="false"><?= __('Description') ?></button>
										</li>
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tabDescriptionSlug" data-bs-toggle="tab" data-bs-target="#tabPanelDescriptionSlug" type="button" role="tab" aria-controls="tabPanelDescriptionSlug" aria-selected="false"><?= __('Description Slug') ?></button>
										</li>

<?php /*
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tab-more" data-bs-toggle="tab" data-bs-target="#tab-panel-more" type="button" role="tab" aria-controls="tab-panel-more" aria-selected="false"><?= __('More') ?></button>
										</li>
*/ ?>

										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= __('Related tables') ?></a>
											<ul class="dropdown-menu">
<?php if (!empty($category->ads)) : ?>
												<li><?= $this->Html->link(__('Ads') . '...', ['controller' => 'Ads', 'action' => 'index', 'parent', 'category', $category->id], ['class' => 'dropdown-item']) ?></li>
<?php endif ?>
<?php if (!empty($category->category_stats)) : ?>
												<li><?= $this->Html->link(__('Category Stats') . '...', ['controller' => 'Category Stats', 'action' => 'index', 'parent', 'category', $category->id], ['class' => 'dropdown-item']) ?></li>
<?php endif ?>
<?php if (!empty($category->companies)) : ?>
												<li><?= $this->Html->link(__('Companies') . '...', ['controller' => 'Companies', 'action' => 'index', 'parent', 'category', $category->id], ['class' => 'dropdown-item']) ?></li>
<?php endif ?>
											</ul>
										</li>

									</ul>
								</div>

							</div><!-- /card header -->
							
							<div class="card-body">
								<form>
									<div class="tab-content" id="tabContent"><!-- T.1. -->
										
										<div class="tab-pane fade show active" id="tabPanelMain" role="tabpanel" aria-labelledby="tab-first" tabindex="0">
<?php if($config['show_id']){ ?>
											<div class="row"><!-- 3. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end">#<?= __('id') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $category->id ?><!-- 0.a -->
												</div>
											</div>
<?php } ?>
											<div class="row"><!-- 1. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Icon') ?>:</label>
												<div class="col-sm-10 p-1 link">
													<?= $category->hasValue('icon') ? $this->Html->link($category->icon->name, ['controller' => 'Icons', 'action' => 'view', $category->icon->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span>
												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Name') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($category->name) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Name Slug') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($category->name_slug) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Keywords') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($category->keywords) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Keywords Slug') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($category->keywords_slug) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Action') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($category->action) ?>

												</div>
											</div>
											<div class="row"><!-- 3. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Visible') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $this->Number->format($category->visible) ?><!-- 3.b -->
												</div>
											</div>
<?php /*
											<div class="row"><!-- 6. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Description') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $this->Text->autoParagraph(h($category->description)) ?>

												</div>
											</div>
*/ ?>
<?php /*
											<div class="row"><!-- 6. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Description Slug') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $this->Text->autoParagraph(h($category->description_slug)) ?>

												</div>
											</div>
*/ ?>
<?php if($config['show_counters']){ ?>
											<div class="row"><!-- counter helper -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Company Count') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $this->Number->format($category->company_count) ?><!-- 3.b -->
												</div>
											</div>
<?php } ?>


										</div><!-- /.1.TAB -->
										
										<!-- TAB for: Description text field -->
										<div class="tab-pane fade" id="tabPanelDescription" role="tabpanel" aria-labelledby="tabDescription" tabindex="0">
											<div class="row">
												<div class="col-sm-12">
													<div class="row">
														<div id="readMoreDescription" class="col-sm-12 p-2 text read-more">
															<?= $this->Text->autoParagraph($category->description) ?>

														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /.TAB for: Description text field-->
										
										<!-- TAB for: Description Slug text field -->
										<div class="tab-pane fade" id="tabPanelDescriptionSlug" role="tabpanel" aria-labelledby="tabDescriptionSlug" tabindex="0">
											<div class="row">
												<div class="col-sm-12">
													<div class="row">
														<div id="readMoreDescription Slug" class="col-sm-12 p-2 text read-more">
															<?= $this->Text->autoParagraph($category->description_slug) ?>

														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- /.TAB for: Description Slug text field-->
										

<?php /*
											
										<div class="tab-pane fade" id="tab-panel-more" role="tabpanel" aria-labelledby="tab-more" tabindex="0">
											<div class="row"><!-- T.3. -->
												<div class="col-sm-12">
													<h3>Tab 3 content</h3>
													
												</div>
											</div>
										</div><!-- /.3.TAB -->
*/ ?>

									</div><!-- /.TAB PANEL -->

								</form>
							</div><!-- /card body -->
									
						    <div class="card-footer">
								<!--button type="submit" class="btn btn-outline-secondary">&larr;&nbsp;Vissza a listához</button-->
							</div><!-- /card footer -->

						</div><!-- end card-->
                    </div>

				</div>

<?php /*
	############################################################################################################################################################
	#################################################################                  #########################################################################
	#################################################################  Related tebles  #########################################################################
	#################################################################                  #########################################################################
	############################################################################################################################################################
*/ ?>
<?php if($config['show_related_tables']): ?>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card mb-3">

							<div class="card-header">
							
								<div class="float-start">
									<h3><i class="fa fa-table"></i> <?= __('Related tables') ?></h3>
									<?= __('Here you can see the latest records related to the above item.') ?>
								</div>

								<div class="form-tab float-end">
									<nav>
										<div class="nav nav-tabs mt-1" id="nav-tab" role="tablist">
<?php $acticeClass = " active"; ?>
<?php if (!empty($category->ads)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-ads-tab" data-bs-toggle="tab" data-bs-target="#nav-ads" type="button" role="tab" aria-controls="nav-ads" aria-selected="true">
												<?= __('Ads') ?>
											</button>
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " active"; ?>
<?php if (!empty($category->category_stats)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-category_stats-tab" data-bs-toggle="tab" data-bs-target="#nav-category_stats" type="button" role="tab" aria-controls="nav-category_stats" aria-selected="true">
												<?= __('Category Stats') ?>
											</button>
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " active"; ?>
<?php if (!empty($category->companies)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-companies-tab" data-bs-toggle="tab" data-bs-target="#nav-companies" type="button" role="tab" aria-controls="nav-companies" aria-selected="true">
												<?= __('Companies') ?>
											</button>
<?php 	$acticeClass = ""; ?>
<?php endif ?>
										</div>
									</nav>
								</div>

							</div><!-- /card header -->
								
							<div class="card-body p-1 pb-0">

								<div class="tab-content" id="nav-tabContent">

<?php $acticeClass = " show active"; ?>
<?php if (!empty($category->ads)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-ads" role="tabpanel" aria-labelledby="nav-ads-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type category-id"><?= __('Category Id') ?></th>
													<th class="please-change-type icon-id"><?= __('Icon Id') ?></th>
													<th class="string name"><?= __('Name') ?></th>
													<th class="please-change-type description"><?= __('Description') ?></th>
													<th class="please-change-type price"><?= __('Price') ?></th>
													<th class="please-change-type user-id"><?= __('User Id') ?></th>
													<th class="please-change-type status"><?= __('Status') ?></th>
<?php if($config['index_show_counters']){ ?>
													<th class="number views-count"><?= __('Views Count') ?></th>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<th class="number unique-views-count"><?= __('Unique Views Count') ?></th>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<th class="number favorite-count"><?= __('Favorite Count') ?></th>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<th class="number contact-clicks-count"><?= __('Contact Clicks Count') ?></th>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<th class="number clicks-count"><?= __('Clicks Count') ?></th>
<?php } ?>
													<th class="please-change-type match-score"><?= __('Match Score') ?></th>
													<th class="please-change-type activity-score"><?= __('Activity Score') ?></th>
													<th class="please-change-type score-popularity"><?= __('Score Popularity') ?></th>
													<th class="please-change-type last-boost"><?= __('Last Boost') ?></th>
													<th class="please-change-type is-featured"><?= __('Is Featured') ?></th>
													<th class="please-change-type featured-until"><?= __('Featured Until') ?></th>
													<th class="please-change-type priority-level"><?= __('Priority Level') ?></th>
													<th class="please-change-type admin-score-adjustment"><?= __('Admin Score Adjustment') ?></th>
													<th class="please-change-type is-banned"><?= __('Is Banned') ?></th>
<?php if($config['index_show_counters']){ ?>
													<th class="number reported-count"><?= __('Reported Count') ?></th>
<?php } ?>
													<th class="please-change-type created-at"><?= __('Created At') ?></th>
													<th class="please-change-type updated-at"><?= __('Updated At') ?></th>
													<th class="actions"><?= __('Actions') ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($category->ads as $ads) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $ads->id ?>"><?= h($ads->id) ?></td>
<?php } ?>
													<td class="please-change-type category-id" value="<?= $ads->category_id ?>"><?= h($ads->category_id) ?></td>
													<td class="please-change-type icon-id" value="<?= $ads->icon_id ?>"><?= h($ads->icon_id) ?></td>
													<td class="string name" value="<?= $ads->name ?>"><?= h($ads->name) ?></td>
													<td class="please-change-type description" value="<?= $ads->description ?>"><?= h($ads->description) ?></td>
													<td class="please-change-type price" value="<?= $ads->price ?>"><?= h($ads->price) ?></td>
													<td class="please-change-type user-id" value="<?= $ads->user_id ?>"><?= h($ads->user_id) ?></td>
													<td class="please-change-type status" value="<?= $ads->status ?>"><?= h($ads->status) ?></td>
<?php if($config['index_show_counters']){ ?>
													<td class="number views-count" value="<?= $ads->views_count ?>"><?= h($ads->views_count) ?></td>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<td class="number unique-views-count" value="<?= $ads->unique_views_count ?>"><?= h($ads->unique_views_count) ?></td>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<td class="number favorite-count" value="<?= $ads->favorite_count ?>"><?= h($ads->favorite_count) ?></td>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<td class="number contact-clicks-count" value="<?= $ads->contact_clicks_count ?>"><?= h($ads->contact_clicks_count) ?></td>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<td class="number clicks-count" value="<?= $ads->clicks_count ?>"><?= h($ads->clicks_count) ?></td>
<?php } ?>
													<td class="please-change-type match-score" value="<?= $ads->match_score ?>"><?= h($ads->match_score) ?></td>
													<td class="please-change-type activity-score" value="<?= $ads->activity_score ?>"><?= h($ads->activity_score) ?></td>
													<td class="please-change-type score-popularity" value="<?= $ads->score_popularity ?>"><?= h($ads->score_popularity) ?></td>
													<td class="please-change-type last-boost" value="<?= $ads->last_boost ?>"><?= h($ads->last_boost) ?></td>
													<td class="please-change-type is-featured" value="<?= $ads->is_featured ?>"><?= h($ads->is_featured) ?></td>
													<td class="please-change-type featured-until" value="<?= $ads->featured_until ?>"><?= h($ads->featured_until) ?></td>
													<td class="please-change-type priority-level" value="<?= $ads->priority_level ?>"><?= h($ads->priority_level) ?></td>
													<td class="please-change-type admin-score-adjustment" value="<?= $ads->admin_score_adjustment ?>"><?= h($ads->admin_score_adjustment) ?></td>
													<td class="please-change-type is-banned" value="<?= $ads->is_banned ?>"><?= h($ads->is_banned) ?></td>
<?php if($config['index_show_counters']){ ?>
													<td class="number reported-count" value="<?= $ads->reported_count ?>"><?= h($ads->reported_count) ?></td>
<?php } ?>
													<td class="please-change-type created-at" value="<?= $ads->created_at ?>"><?= h($ads->created_at) ?></td>
													<td class="please-change-type updated-at" value="<?= $ads->updated_at ?>"><?= h($ads->updated_at) ?></td>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'Ads', 'action' => 'view', $ads->id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Ads', 'action' => 'edit', $ads->id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'Ads', 'action' => 'delete', $ads->id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $ads->id)]) ?><!-- delete button -->
													</td>
												</tr>
												<?php endforeach ?>

											</tbody>
										</table>

									</div><!-- /tab pane -->
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " show active"; ?>
<?php if (!empty($category->category_stats)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-category_stats" role="tabpanel" aria-labelledby="nav-category_stats-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
													<th class="please-change-type category-id"><?= __('Category Id') ?></th>
<?php if($config['index_show_counters']){ ?>
													<th class="number views-count"><?= __('Views Count') ?></th>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<th class="number search-count"><?= __('Search Count') ?></th>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<th class="number ad-count"><?= __('Ad Count') ?></th>
<?php } ?>
													<th class="please-change-type popularity-score"><?= __('Popularity Score') ?></th>
													<th class="please-change-type updated-at"><?= __('Updated At') ?></th>
													<th class="actions"><?= __('Actions') ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($category->category_stats as $categoryStats) : ?>

												<tr>
													<td class="please-change-type category-id" value="<?= $categoryStats->category_id ?>"><?= h($categoryStats->category_id) ?></td>
<?php if($config['index_show_counters']){ ?>
													<td class="number views-count" value="<?= $categoryStats->views_count ?>"><?= h($categoryStats->views_count) ?></td>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<td class="number search-count" value="<?= $categoryStats->search_count ?>"><?= h($categoryStats->search_count) ?></td>
<?php } ?>
<?php if($config['index_show_counters']){ ?>
													<td class="number ad-count" value="<?= $categoryStats->ad_count ?>"><?= h($categoryStats->ad_count) ?></td>
<?php } ?>
													<td class="please-change-type popularity-score" value="<?= $categoryStats->popularity_score ?>"><?= h($categoryStats->popularity_score) ?></td>
													<td class="please-change-type updated-at" value="<?= $categoryStats->updated_at ?>"><?= h($categoryStats->updated_at) ?></td>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'CategoryStats', 'action' => 'view', $categoryStats->category_id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'CategoryStats', 'action' => 'edit', $categoryStats->category_id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'CategoryStats', 'action' => 'delete', $categoryStats->category_id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $categoryStats->category_id)]) ?><!-- delete button -->
													</td>
												</tr>
												<?php endforeach ?>

											</tbody>
										</table>

									</div><!-- /tab pane -->
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " show active"; ?>
<?php if (!empty($category->companies)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-companies" role="tabpanel" aria-labelledby="nav-companies-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type icon-id"><?= __('Icon Id') ?></th>
													<th class="please-change-type category-id"><?= __('Category Id') ?></th>
													<th class="please-change-type logo"><?= __('Logo') ?></th>
													<th class="string name"><?= __('Name') ?></th>
													<th class="please-change-type banner"><?= __('Banner') ?></th>
													<th class="please-change-type name-slug"><?= __('Name Slug') ?></th>
													<th class="please-change-type keywords"><?= __('Keywords') ?></th>
													<th class="please-change-type keywords-slug"><?= __('Keywords Slug') ?></th>
													<th class="please-change-type city-id"><?= __('City Id') ?></th>
													<th class="please-change-type address"><?= __('Address') ?></th>
													<th class="please-change-type house-number"><?= __('House Number') ?></th>
													<th class="please-change-type description"><?= __('Description') ?></th>
													<th class="please-change-type description-slug"><?= __('Description Slug') ?></th>
													<th class="please-change-type longitude"><?= __('Longitude') ?></th>
													<th class="please-change-type latitude"><?= __('Latitude') ?></th>
													<th class="please-change-type maximum-distance"><?= __('Maximum Distance') ?></th>
													<th class="please-change-type date-from"><?= __('Date From') ?></th>
													<th class="please-change-type date-to"><?= __('Date To') ?></th>
<?php if($config['index_show_visible']){ ?>
													<th class="boolean visible"><?= __('Visible') ?></th>
<?php } ?>
<?php if($config['index_show_pos']){ ?>
													<th class="number pos"><?= __('Pos') ?></th>
<?php } ?>
													<th class="please-change-type action"><?= __('Action') ?></th>
<?php if($config['index_show_counters']){ ?>
													<th class="number person-count"><?= __('Person Count') ?></th>
<?php } ?>
<?php if($config['index_show_created']){ ?>
													<th class="datetime created"><?= __('Created') ?></th>
<?php } ?>
<?php if($config['index_show_modified']){ ?>
													<th class="datetime modified"><?= __('Modified') ?></th>
<?php } ?>
													<th class="actions"><?= __('Actions') ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($category->companies as $companies) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $companies->id ?>"><?= h($companies->id) ?></td>
<?php } ?>
													<td class="please-change-type icon-id" value="<?= $companies->icon_id ?>"><?= h($companies->icon_id) ?></td>
													<td class="please-change-type category-id" value="<?= $companies->category_id ?>"><?= h($companies->category_id) ?></td>
													<td class="please-change-type logo" value="<?= $companies->logo ?>"><?= h($companies->logo) ?></td>
													<td class="string name" value="<?= $companies->name ?>"><?= h($companies->name) ?></td>
													<td class="please-change-type banner" value="<?= $companies->banner ?>"><?= h($companies->banner) ?></td>
													<td class="please-change-type name-slug" value="<?= $companies->name_slug ?>"><?= h($companies->name_slug) ?></td>
													<td class="please-change-type keywords" value="<?= $companies->keywords ?>"><?= h($companies->keywords) ?></td>
													<td class="please-change-type keywords-slug" value="<?= $companies->keywords_slug ?>"><?= h($companies->keywords_slug) ?></td>
													<td class="please-change-type city-id" value="<?= $companies->city_id ?>"><?= h($companies->city_id) ?></td>
													<td class="please-change-type address" value="<?= $companies->address ?>"><?= h($companies->address) ?></td>
													<td class="please-change-type house-number" value="<?= $companies->house_number ?>"><?= h($companies->house_number) ?></td>
													<td class="please-change-type description" value="<?= $companies->description ?>"><?= h($companies->description) ?></td>
													<td class="please-change-type description-slug" value="<?= $companies->description_slug ?>"><?= h($companies->description_slug) ?></td>
													<td class="please-change-type longitude" value="<?= $companies->longitude ?>"><?= h($companies->longitude) ?></td>
													<td class="please-change-type latitude" value="<?= $companies->latitude ?>"><?= h($companies->latitude) ?></td>
													<td class="please-change-type maximum-distance" value="<?= $companies->maximum_distance ?>"><?= h($companies->maximum_distance) ?></td>
													<td class="please-change-type date-from" value="<?= $companies->date_from ?>"><?= h($companies->date_from) ?></td>
													<td class="please-change-type date-to" value="<?= $companies->date_to ?>"><?= h($companies->date_to) ?></td>
<?php if($config['index_show_visible']){ ?>
													<td class="boolean visible" value="<?= $companies->visible ?>"><?= h($companies->visible) ?></td>
<?php } ?>
<?php if($config['index_show_pos']){ ?>
													<td class="number pos" value="<?= $companies->pos ?>"><?= h($companies->pos) ?></td>
<?php } ?>
													<td class="please-change-type action" value="<?= $companies->action ?>"><?= h($companies->action) ?></td>
<?php if($config['index_show_counters']){ ?>
													<td class="number person-count" value="<?= $companies->person_count ?>"><?= h($companies->person_count) ?></td>
<?php } ?>
<?php if($config['index_show_created']){ ?>
													<td class="datetime created" value="<?= $companies->created ?>"><?= h($companies->created) ?></td>
<?php } ?>
<?php if($config['index_show_modified']){ ?>
													<td class="datetime modified" value="<?= $companies->modified ?>"><?= h($companies->modified) ?></td>
<?php } ?>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'Companies', 'action' => 'view', $companies->id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Companies', 'action' => 'edit', $companies->id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'Companies', 'action' => 'delete', $companies->id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $companies->id)]) ?><!-- delete button -->
													</td>
												</tr>
												<?php endforeach ?>

											</tbody>
										</table>

									</div><!-- /tab pane -->
<?php 	$acticeClass = ""; ?>
<?php endif ?>

								</div><!-- /tab content -->

							</div><!-- /card body -->

						    <div class="card-footer">
								<!-- Bottom text! -->
							</div><!-- /card footer -->
							
						</div><!-- end card -->
                    </div><!-- end col -->
				</div><!-- end row -->
<?php endif // $config['show_related_tables'] ?>

<?php
	$this->Html->css(
		[
			//// 'JeffAdmin5./assets/plugins/',
		],
		['block' => true]
	);

	$this->Html->script(
		[
			//// 'JeffAdmin5./assets/plugins/',
			//"JeffAdmin5./assets/plugins/jquery-copy-to-clipboard-master/jquery.copy-to-clipboard",
		],
		['block' => 'scriptBottom']
	);
?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']) ?>

<?php $this->Html->scriptEnd() ?>
