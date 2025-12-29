<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Country $country
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
									<h3><i id="card-icon" class="fa fa-eye fa-spin"></i> <?= __('View') ?>: <?= __('Country') ?></h3>
									<?= __('The data marked with <span class="fw-bold text-danger">*</span> must be provided!') ?>
								</div>
								<div class="float-end ms-5">
									<?= $this->Html->link('<span class="btn btn-outline-secondary mt-1 me-1"><i class="fa fa-times"></i></span>',
										["controller" => "Countries", "action" => "index", "_full" => true],
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
<?php if (!empty($country->cities)) : ?>
												<li><?= $this->Html->link(__('Cities') . '...', ['controller' => 'Cities', 'action' => 'index', 'parent', 'country', $country->id], ['class' => 'dropdown-item']) ?></li>
<?php endif ?>
<?php if (!empty($country->counties)) : ?>
												<li><?= $this->Html->link(__('Counties') . '...', ['controller' => 'Counties', 'action' => 'index', 'parent', 'country', $country->id], ['class' => 'dropdown-item']) ?></li>
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
													<?= $country->id ?><!-- 0.a -->
												</div>
											</div>
<?php } ?>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Name Hu') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($country->name_hu) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Name En') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($country->name_en) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Name De') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($country->name_de) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Shortcode') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($country->shortcode) ?>

												</div>
											</div>
											<div class="row"><!-- 2. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Currency') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= h($country->currency) ?>

												</div>
											</div>
											<div class="row"><!-- 3. -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('Visible') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $this->Number->format($country->visible) ?><!-- 3.b -->
												</div>
											</div>
<?php if($config['show_counters']){ ?>
											<div class="row"><!-- counter helper -->
												<label class="col-sm-2 col-form-label p-1 text-start text-sm-end"><?= __('City Count') ?>:</label>
												<div class="col-sm-10 p-1">
													<?= $this->Number->format($country->city_count) ?><!-- 3.b -->
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
<?php if (!empty($country->cities)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-cities-tab" data-bs-toggle="tab" data-bs-target="#nav-cities" type="button" role="tab" aria-controls="nav-cities" aria-selected="true">
												<?= __('Cities') ?>
											</button>
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " active"; ?>
<?php if (!empty($country->counties)): ?>

											<button class="nav-link<?= $acticeClass ?>" id="nav-counties-tab" data-bs-toggle="tab" data-bs-target="#nav-counties" type="button" role="tab" aria-controls="nav-counties" aria-selected="true">
												<?= __('Counties') ?>
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
<?php if (!empty($country->cities)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-cities" role="tabpanel" aria-labelledby="nav-cities-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type country-id"><?= __('Country Id') ?></th>
													<th class="please-change-type county-id"><?= __('County Id') ?></th>
													<th class="please-change-type shortname"><?= __('Shortname') ?></th>
													<th class="string name"><?= __('Name') ?></th>
													<th class="please-change-type zip"><?= __('Zip') ?></th>
													<th class="please-change-type lat"><?= __('Lat') ?></th>
													<th class="please-change-type lng"><?= __('Lng') ?></th>
													<th class="please-change-type lat2"><?= __('Lat2') ?></th>
													<th class="please-change-type lng2"><?= __('Lng2') ?></th>
													<th class="actions"><?= __('Actions') ?></th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($country->cities as $cities) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $cities->id ?>"><?= h($cities->id) ?></td>
<?php } ?>
													<td class="please-change-type country-id" value="<?= $cities->country_id ?>"><?= h($cities->country_id) ?></td>
													<td class="please-change-type county-id" value="<?= $cities->county_id ?>"><?= h($cities->county_id) ?></td>
													<td class="please-change-type shortname" value="<?= $cities->shortname ?>"><?= h($cities->shortname) ?></td>
													<td class="string name" value="<?= $cities->name ?>"><?= h($cities->name) ?></td>
													<td class="please-change-type zip" value="<?= $cities->zip ?>"><?= h($cities->zip) ?></td>
													<td class="please-change-type lat" value="<?= $cities->lat ?>"><?= h($cities->lat) ?></td>
													<td class="please-change-type lng" value="<?= $cities->lng ?>"><?= h($cities->lng) ?></td>
													<td class="please-change-type lat2" value="<?= $cities->lat2 ?>"><?= h($cities->lat2) ?></td>
													<td class="please-change-type lng2" value="<?= $cities->lng2 ?>"><?= h($cities->lng2) ?></td>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'Cities', 'action' => 'view', $cities->id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Cities', 'action' => 'edit', $cities->id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'Cities', 'action' => 'delete', $cities->id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $cities->id)]) ?><!-- delete button -->
													</td>
												</tr>
												<?php endforeach ?>

											</tbody>
										</table>

									</div><!-- /tab pane -->
<?php 	$acticeClass = ""; ?>
<?php endif ?>
<?php $acticeClass = " show active"; ?>
<?php if (!empty($country->counties)): ?>

									<div class="tab-pane fade<?= $acticeClass ?> p-0" id="nav-counties" role="tabpanel" aria-labelledby="nav-counties-tab" tabindex="0">

										<table class="table table-responsive-xl table-hover table-striped" style="">
											<thead class="thead-info">
												<tr>
<?php if($config['index_show_id']){ ?>
													<th class="number id"><?= __('Id') ?></th>
<?php } ?>
													<th class="please-change-type country-id"><?= __('Country Id') ?></th>
													<th class="string name"><?= __('Name') ?></th>
													<th class="please-change-type shortname"><?= __('Shortname') ?></th>
													<th class="please-change-type capitalcity"><?= __('Capitalcity') ?></th>
													<th class="please-change-type region"><?= __('Region') ?></th>
<?php if($config['index_show_pos']){ ?>
													<th class="number pos"><?= __('Pos') ?></th>
<?php } ?>
<?php if($config['index_show_visible']){ ?>
													<th class="boolean visible"><?= __('Visible') ?></th>
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
												<?php foreach ($country->counties as $counties) : ?>

												<tr>
<?php if($config['index_show_id']){ ?>
													<td class="number id" value="<?= $counties->id ?>"><?= h($counties->id) ?></td>
<?php } ?>
													<td class="please-change-type country-id" value="<?= $counties->country_id ?>"><?= h($counties->country_id) ?></td>
													<td class="string name" value="<?= $counties->name ?>"><?= h($counties->name) ?></td>
													<td class="please-change-type shortname" value="<?= $counties->shortname ?>"><?= h($counties->shortname) ?></td>
													<td class="please-change-type capitalcity" value="<?= $counties->capitalcity ?>"><?= h($counties->capitalcity) ?></td>
													<td class="please-change-type region" value="<?= $counties->region ?>"><?= h($counties->region) ?></td>
<?php if($config['index_show_pos']){ ?>
													<td class="number pos" value="<?= $counties->pos ?>"><?= h($counties->pos) ?></td>
<?php } ?>
<?php if($config['index_show_visible']){ ?>
													<td class="boolean visible" value="<?= $counties->visible ?>"><?= h($counties->visible) ?></td>
<?php } ?>
<?php if($config['index_show_created']){ ?>
													<td class="datetime created" value="<?= $counties->created ?>"><?= h($counties->created) ?></td>
<?php } ?>
<?php if($config['index_show_modified']){ ?>
													<td class="datetime modified" value="<?= $counties->modified ?>"><?= h($counties->modified) ?></td>
<?php } ?>
													<td class="actions">
														<?= $this->Html->link('<i class="fa fa-eye"></i>', ['controller' => 'Counties', 'action' => 'view', $counties->id], ["escape" => false, "role" => "button",  "class" => "btn btn-warning btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('View this item'), "data-original-title" => ""]) ?><!-- view button -->
														<?= $this->Html->link('<i class="fa fa-edit"></i>', ['controller' => 'Counties', 'action' => 'edit', $counties->id], ["escape" => false, "role" => "button", "class" => "btn btn-primary btn-sm", "data-toggle" => "tooltip", "data-placement" => "top", "title" => __('Edit this item'), "data-original-title" => ""]) ?><!-- edit button -->
														<?= $this->Form->postLink('<i class="fa fa-times"></i>', ['controller' => 'Counties', 'action' => 'delete', $counties->id], ["escape" => false, "role" => "button", "class" => "btn btn-danger btn-sm", "data-toggle" =>"tooltip", "data-placement" => "top", "title" => __('Delete this item'), "data-original-title" => "", "confirm" => __("Are you sure you want to delete # {0}?", $counties->id)]) ?><!-- delete button -->
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
