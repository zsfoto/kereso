<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Icon $icon
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
									<h3><i id="card-icon" class="fa fa-eye fa-spin"></i> <?= __('View') ?>: <?= __('Icon') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>
								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Icons", "action" => "index", "_full" => true],
										["escape" => false, "role" => "button"]
									) ?>
								</div>

								<div class="form-tab float-end">
									<ul class="nav nav-tabs mt-1" id="myTab" role="tablist">
										<li class="nav-item" role="presentation">
											<button class="nav-link active" id="tab-first" data-bs-toggle="tab" data-bs-target="#tabPanelMain" type="button" role="tab" aria-controls="tabPanelMain" aria-selected="true"><?= __('Basic data') ?></button>
										</li>


<?php /*
										<li class="nav-item" role="presentation">
											<button class="nav-link" id="tab-more" data-bs-toggle="tab" data-bs-target="#tab-panel-more" type="button" role="tab" aria-controls="tab-panel-more" aria-selected="false"><?= __('More') ?></button>
										</li>
*/ ?>

										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?= __('Related tables') ?></a>
											<ul class="dropdown-menu">
<?php if (!empty($icon->categories)) : ?>
												<li><?= $this->Html->link(__('Categories') . '...', ['controller' => 'Categories', 'action' => 'index', 'parent', 'icon', $icon->id], ['class' => 'dropdown-item']) ?></li>
<?php endif ?>
<?php if (!empty($icon->companies)) : ?>
												<li><?= $this->Html->link(__('Companies') . '...', ['controller' => 'Companies', 'action' => 'index', 'parent', 'icon', $icon->id], ['class' => 'dropdown-item']) ?></li>
<?php endif ?>
<?php if (!empty($icon->persons)) : ?>
												<li><?= $this->Html->link(__('Persons') . '...', ['controller' => 'Persons', 'action' => 'index', 'parent', 'icon', $icon->id], ['class' => 'dropdown-item']) ?></li>
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
													<?= $icon->id ?><!-- 0.a -->
												</div>
											</div>
<?php } ?>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Name') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($icon->name) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Filename') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($icon->filename) ?>

												</div>
											</div>
											<div class="row"><!-- 4. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Last Used') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($icon->last_used) ?>

												</div>
											</div>
<?php if($config['show_counters']){ ?>
											<div class="row"><!-- counter helper -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Adcategory Count') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $icon->adcategory_count === null ? '' : $this->Number->format($icon->adcategory_count) ?><!-- 3.a -->
												</div>
											</div>
<?php } ?>

<?php if($config['show_counters']){ ?>
											<div class="row"><!-- counter helper -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Ad Count') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $icon->ad_count === null ? '' : $this->Number->format($icon->ad_count) ?><!-- 3.a -->
												</div>
											</div>
<?php } ?>

<?php if($config['show_counters']){ ?>
											<div class="row"><!-- counter helper -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Category Count') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $icon->category_count === null ? '' : $this->Number->format($icon->category_count) ?><!-- 3.a -->
												</div>
											</div>
<?php } ?>

<?php if($config['show_counters']){ ?>
											<div class="row"><!-- counter helper -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Company Count') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $icon->company_count === null ? '' : $this->Number->format($icon->company_count) ?><!-- 3.a -->
												</div>
											</div>
<?php } ?>

<?php if($config['show_counters']){ ?>
											<div class="row"><!-- counter helper -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Person Count') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $icon->person_count === null ? '' : $this->Number->format($icon->person_count) ?><!-- 3.a -->
												</div>
											</div>
<?php } ?>


										</div><!-- /.1.TAB -->
										

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
<?php if (!empty($icon->categories)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-categories-tab" data-bs-toggle="tab" data-bs-target="#nav-categories" type="button" role="tab" aria-controls="nav-categories" aria-selected="true">
												<?= __('Categories') ?>
											</button>
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " active"; ?>
<?php if (!empty($icon->companies)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-companies-tab" data-bs-toggle="tab" data-bs-target="#nav-companies" type="button" role="tab" aria-controls="nav-companies" aria-selected="true">
												<?= __('Companies') ?>
											</button>
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " active"; ?>
<?php if (!empty($icon->persons)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-persons-tab" data-bs-toggle="tab" data-bs-target="#nav-persons" type="button" role="tab" aria-controls="nav-persons" aria-selected="true">
												<?= __('Persons') ?>
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
<?php if (!empty($icon->categories)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-categories" role="tabpanel" aria-labelledby="nav-categories-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type icon-id"><?= __('Icon Id') ?></th>
													<th class="string name"><?= __('Name') ?></th>
													<th class="please-change-type name-slug"><?= __('Name Slug') ?></th>
													<th class="please-change-type description"><?= __('Description') ?></th>
													<th class="please-change-type description-slug"><?= __('Description Slug') ?></th>
													<th class="please-change-type keywords"><?= __('Keywords') ?></th>
													<th class="please-change-type keywords-slug"><?= __('Keywords Slug') ?></th>
<?php if($config['index_show_visible']){ ?>
													<th class="boolean visible"><?= __('Visible') ?></th>
<?php } ?>
<?php if($config['index_show_pos']){ ?>
													<th class="number pos"><?= __('Pos') ?></th>
<?php } ?>
													<th class="please-change-type action"><?= __('Action') ?></th>
<?php if($config['index_show_counters']){ ?>
													<th class="number company-count"><?= __('Company Count') ?></th>
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
												<?php foreach ($icon->categories as $categories) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $categories->id ?>"><?= h($categories->id) ?></td>
<?php } ?>
													<td class="please-change-type icon-id" value="<?= $categories->icon_id ?>"><?= h($categories->icon_id) ?></td>
													<td class="string name" value="<?= $categories->name ?>"><?= h($categories->name) ?></td>
													<td class="please-change-type name-slug" value="<?= $categories->name_slug ?>"><?= h($categories->name_slug) ?></td>
													<td class="please-change-type description" value="<?= $categories->description ?>"><?= h($categories->description) ?></td>
													<td class="please-change-type description-slug" value="<?= $categories->description_slug ?>"><?= h($categories->description_slug) ?></td>
													<td class="please-change-type keywords" value="<?= $categories->keywords ?>"><?= h($categories->keywords) ?></td>
													<td class="please-change-type keywords-slug" value="<?= $categories->keywords_slug ?>"><?= h($categories->keywords_slug) ?></td>
<?php if($config['index_show_visible']){ ?>
													<td class="boolean visible" value="<?= $categories->visible ?>"><?= h($categories->visible) ?></td>
<?php } ?>
<?php if($config['index_show_pos']){ ?>
													<td class="number pos" value="<?= $categories->pos ?>"><?= h($categories->pos) ?></td>
<?php } ?>
													<td class="please-change-type action" value="<?= $categories->action ?>"><?= h($categories->action) ?></td>
<?php if($config['index_show_counters']){ ?>
													<td class="number company-count" value="<?= $categories->company_count ?>"><?= h($categories->company_count) ?></td>
<?php } ?>
<?php if($config['index_show_created']){ ?>
													<td class="datetime created" value="<?= $categories->created ?>"><?= h($categories->created) ?></td>
<?php } ?>
<?php if($config['index_show_modified']){ ?>
													<td class="datetime modified" value="<?= $categories->modified ?>"><?= h($categories->modified) ?></td>
<?php } ?>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'Categories', 'action' => 'view', $categories->id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Categories', 'action' => 'edit', $categories->id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'Categories', 'action' => 'delete', $categories->id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $categories->id)]) ?><!-- delete button -->
													</td>
												</tr>
												<?php endforeach ?>

											</tbody>
										</table>

									</div><!-- /tab pane -->
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " show active"; ?>
<?php if (!empty($icon->companies)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-companies" role="tabpanel" aria-labelledby="nav-companies-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type icon-id"><?= __('Icon Id') ?></th>
													<th class="please-change-type category-id"><?= __('Category Id') ?></th>
													<th class="string name"><?= __('Name') ?></th>
													<th class="please-change-type name-slug"><?= __('Name Slug') ?></th>
													<th class="please-change-type description"><?= __('Description') ?></th>
													<th class="please-change-type description-slug"><?= __('Description Slug') ?></th>
													<th class="please-change-type keywords"><?= __('Keywords') ?></th>
													<th class="please-change-type keywords-slug"><?= __('Keywords Slug') ?></th>
													<th class="please-change-type longitude"><?= __('Longitude') ?></th>
													<th class="please-change-type latitude"><?= __('Latitude') ?></th>
													<th class="please-change-type maximum-distance"><?= __('Maximum Distance') ?></th>
													<th class="please-change-type date-from"><?= __('Date From') ?></th>
													<th class="please-change-type date-to"><?= __('Date To') ?></th>
													<th class="please-change-type logo"><?= __('Logo') ?></th>
													<th class="please-change-type banner"><?= __('Banner') ?></th>
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
												<?php foreach ($icon->companies as $companies) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $companies->id ?>"><?= h($companies->id) ?></td>
<?php } ?>
													<td class="please-change-type icon-id" value="<?= $companies->icon_id ?>"><?= h($companies->icon_id) ?></td>
													<td class="please-change-type category-id" value="<?= $companies->category_id ?>"><?= h($companies->category_id) ?></td>
													<td class="string name" value="<?= $companies->name ?>"><?= h($companies->name) ?></td>
													<td class="please-change-type name-slug" value="<?= $companies->name_slug ?>"><?= h($companies->name_slug) ?></td>
													<td class="please-change-type description" value="<?= $companies->description ?>"><?= h($companies->description) ?></td>
													<td class="please-change-type description-slug" value="<?= $companies->description_slug ?>"><?= h($companies->description_slug) ?></td>
													<td class="please-change-type keywords" value="<?= $companies->keywords ?>"><?= h($companies->keywords) ?></td>
													<td class="please-change-type keywords-slug" value="<?= $companies->keywords_slug ?>"><?= h($companies->keywords_slug) ?></td>
													<td class="please-change-type longitude" value="<?= $companies->longitude ?>"><?= h($companies->longitude) ?></td>
													<td class="please-change-type latitude" value="<?= $companies->latitude ?>"><?= h($companies->latitude) ?></td>
													<td class="please-change-type maximum-distance" value="<?= $companies->maximum_distance ?>"><?= h($companies->maximum_distance) ?></td>
													<td class="please-change-type date-from" value="<?= $companies->date_from ?>"><?= h($companies->date_from) ?></td>
													<td class="please-change-type date-to" value="<?= $companies->date_to ?>"><?= h($companies->date_to) ?></td>
													<td class="please-change-type logo" value="<?= $companies->logo ?>"><?= h($companies->logo) ?></td>
													<td class="please-change-type banner" value="<?= $companies->banner ?>"><?= h($companies->banner) ?></td>
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
<?php $acticeClass = " show active"; ?>
<?php if (!empty($icon->persons)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-persons" role="tabpanel" aria-labelledby="nav-persons-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type icon-id"><?= __('Icon Id') ?></th>
													<th class="please-change-type company-id"><?= __('Company Id') ?></th>
													<th class="string name"><?= __('Name') ?></th>
													<th class="please-change-type name-slug"><?= __('Name Slug') ?></th>
													<th class="please-change-type description"><?= __('Description') ?></th>
													<th class="please-change-type keywoords"><?= __('Keywoords') ?></th>
													<th class="please-change-type keywoords-slug"><?= __('Keywoords Slug') ?></th>
													<th class="please-change-type phone"><?= __('Phone') ?></th>
													<th class="please-change-type phone2"><?= __('Phone2') ?></th>
													<th class="please-change-type phone3"><?= __('Phone3') ?></th>
													<th class="please-change-type phone4"><?= __('Phone4') ?></th>
													<th class="please-change-type phone5"><?= __('Phone5') ?></th>
													<th class="please-change-type email"><?= __('Email') ?></th>
													<th class="please-change-type email2"><?= __('Email2') ?></th>
													<th class="please-change-type web"><?= __('Web') ?></th>
													<th class="please-change-type facebook"><?= __('Facebook') ?></th>
													<th class="please-change-type youtube"><?= __('Youtube') ?></th>
													<th class="please-change-type logo"><?= __('Logo') ?></th>
													<th class="please-change-type banner"><?= __('Banner') ?></th>
<?php if($config['index_show_visible']){ ?>
													<th class="boolean visible"><?= __('Visible') ?></th>
<?php } ?>
<?php if($config['index_show_pos']){ ?>
													<th class="number pos"><?= __('Pos') ?></th>
<?php } ?>
													<th class="please-change-type action"><?= __('Action') ?></th>
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
												<?php foreach ($icon->persons as $persons) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $persons->id ?>"><?= h($persons->id) ?></td>
<?php } ?>
													<td class="please-change-type icon-id" value="<?= $persons->icon_id ?>"><?= h($persons->icon_id) ?></td>
													<td class="please-change-type company-id" value="<?= $persons->company_id ?>"><?= h($persons->company_id) ?></td>
													<td class="string name" value="<?= $persons->name ?>"><?= h($persons->name) ?></td>
													<td class="please-change-type name-slug" value="<?= $persons->name_slug ?>"><?= h($persons->name_slug) ?></td>
													<td class="please-change-type description" value="<?= $persons->description ?>"><?= h($persons->description) ?></td>
													<td class="please-change-type keywoords" value="<?= $persons->keywoords ?>"><?= h($persons->keywoords) ?></td>
													<td class="please-change-type keywoords-slug" value="<?= $persons->keywoords_slug ?>"><?= h($persons->keywoords_slug) ?></td>
													<td class="please-change-type phone" value="<?= $persons->phone ?>"><?= h($persons->phone) ?></td>
													<td class="please-change-type phone2" value="<?= $persons->phone2 ?>"><?= h($persons->phone2) ?></td>
													<td class="please-change-type phone3" value="<?= $persons->phone3 ?>"><?= h($persons->phone3) ?></td>
													<td class="please-change-type phone4" value="<?= $persons->phone4 ?>"><?= h($persons->phone4) ?></td>
													<td class="please-change-type phone5" value="<?= $persons->phone5 ?>"><?= h($persons->phone5) ?></td>
													<td class="please-change-type email" value="<?= $persons->email ?>"><?= h($persons->email) ?></td>
													<td class="please-change-type email2" value="<?= $persons->email2 ?>"><?= h($persons->email2) ?></td>
													<td class="please-change-type web" value="<?= $persons->web ?>"><?= h($persons->web) ?></td>
													<td class="please-change-type facebook" value="<?= $persons->facebook ?>"><?= h($persons->facebook) ?></td>
													<td class="please-change-type youtube" value="<?= $persons->youtube ?>"><?= h($persons->youtube) ?></td>
													<td class="please-change-type logo" value="<?= $persons->logo ?>"><?= h($persons->logo) ?></td>
													<td class="please-change-type banner" value="<?= $persons->banner ?>"><?= h($persons->banner) ?></td>
<?php if($config['index_show_visible']){ ?>
													<td class="boolean visible" value="<?= $persons->visible ?>"><?= h($persons->visible) ?></td>
<?php } ?>
<?php if($config['index_show_pos']){ ?>
													<td class="number pos" value="<?= $persons->pos ?>"><?= h($persons->pos) ?></td>
<?php } ?>
													<td class="please-change-type action" value="<?= $persons->action ?>"><?= h($persons->action) ?></td>
<?php if($config['index_show_created']){ ?>
													<td class="datetime created" value="<?= $persons->created ?>"><?= h($persons->created) ?></td>
<?php } ?>
<?php if($config['index_show_modified']){ ?>
													<td class="datetime modified" value="<?= $persons->modified ?>"><?= h($persons->modified) ?></td>
<?php } ?>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'Persons', 'action' => 'view', $persons->id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Persons', 'action' => 'edit', $persons->id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'Persons', 'action' => 'delete', $persons->id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $persons->id)]) ?><!-- delete button -->
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
