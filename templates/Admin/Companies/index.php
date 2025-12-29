<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Company> $companies
 */
use Cake\Core\Configure;

$layoutCompaniesLastId = -1;
if($session->check('Layout.Companies.LastId')){
	$layoutCompaniesLastId = $session->read('Layout.Companies.LastId');
}

$global_config = (array) Configure::read('Theme.' . $prefix . '.config.template.index');
$local_config = [
	'show_id' 			=> true,
	'show_pos' 			=> false,
	'show_counters'		=> false,
	'show_created'		=> false,
	'show_modified'		=> false,
	'action_db_click'	=> 'edit',	// none, edit or view
	// ... more config params in: \JeffAdmin5\config\jeffadmin5.php
];
$config = array_merge($global_config, $local_config);
?>
				<div class="companies index row">
						
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-header">
							
								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-table fa-spin"></i> <?= __('Table') ?>: <?= __('Companies') ?></h3>
									<div><?php
										if($config['action_db_click'] == 'edit'){
											echo __('Double clik to edit row');
										}
										if($config['action_db_click'] == 'view'){
											echo __('Double clik to view row');
										}
									?></div>
								</div>
								
								<div class="float-end">
									<!-- Paginator page links -->
									<?= $this->element('JeffAdmin5.paginator') ?>
									<!-- /.Pginator page links -->
								</div>
								
							</div>

<?php ####################################################################################################################################################### ?>
<?php ###################### CARD BODY ###################################################################################################################### ?>
<?php ####################################################################################################################################################### ?>

							<div class="card-body p-0 p-1">
								
								<table class="table table-responsive-xl table-hover table-striped mb-0 text-nowrap" style="">
									<thead class="thead-info">
										<tr>
											<th class="row-id-anchor"></th>
<?php if($config['show_id']){ ?>
											<th class="number id"><?= $this->Paginator->sort('id') ?></th>
<?php } ?>
											<th class="string icon-id"><?= $this->Paginator->sort('icon_id') ?></th><!-- H.0. -->
											<th class="string category-id"><?= $this->Paginator->sort('category_id') ?></th><!-- H.0. -->
											<th class="string"><?= $this->Paginator->sort('logo') ?></th><!-- H.1. -->
											<th class="string banner"><?= $this->Paginator->sort('banner') ?></th><!-- H.1. -->
											<th class="string name">
													<?= $this->Paginator->sort('name') ?><br>
													<?= $this->Paginator->sort('keywords') ?>
											</th><!-- H.1. -->
											<th class="string city-id">
												<?= $this->Paginator->sort('city_id') ?><br>
												<?= $this->Paginator->sort('address') ?>; <?= $this->Paginator->sort('house_number') ?>
											</th><!-- H.1. -->
											<th class="string description"><?= $this->Paginator->sort('description') ?></th><!-- H.1. -->
											<th class="string longitude"><?= $this->Paginator->sort('longitude') ?></th><!-- H.1. -->
											<th class="string latitude"><?= $this->Paginator->sort('latitude') ?></th><!-- H.1. -->
											<th class="integer maximum-distance"><?= $this->Paginator->sort('maximum_distance') ?></th><!-- H.3. -->
											<th class="date date-from"><?= $this->Paginator->sort('date_from') ?></th><!-- H.1. -->
											<th class="date date-to"><?= $this->Paginator->sort('date_to') ?></th><!-- H.1. -->
<?php if($config['show_pos']){ ?>
											<th class="number pos"><?= $this->Paginator->sort('pos') ?></th>
<?php } ?>
<?php if($config['show_visible']){ ?>
											<th class="boolean visible"><?= $this->Paginator->sort('visible') ?></th>
<?php } ?>
<?php if($config['show_counters']){ ?>
											<th class="number counter person_count"><?= $this->Paginator->sort('person_count') ?></th><?php } ?>
<?php if($config['show_created'] || $config['show_modified']){ ?>

											<th class="datetime created modified">
												<?php 
													if($config['show_created']){ 
														echo $this->Paginator->sort('created');
													}
													if($config['show_created'] && $config['show_modified']){
														echo "&nbsp;/&nbsp;";
													}
													if($config['show_modified']){
														echo $this->Paginator->sort('modified');
													} ?>

											</th>
<?php } ?>
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($companies as $company): ?>
<?php
	//$classLastVisited = ' class="last-visited"';	// later...
	//$classLastVisited = '';
?>

										<tr row-id="<?= $company->id ?>"<?php if($company->id == $layoutCompaniesLastId){ echo 'class="table-tr-last-id"'; } ?> prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
											<td class="row-id-anchor" value="<?= $company->id ?>"><a name="<?= $company->id ?>" class="anchor"></a></td>
<?php if($config['show_id']){ ?>
											<td class="number id" value="<?= $company->id ?>"><?= h($company->id) ?><a name="<?= $company->id ?>"></a></td>
<?php } ?>
											<td class="string link icon-id" value="<?= $company->icon_id ?>"><?= $company->hasValue('icon') ? $this->Html->link($company->icon->name, ['controller' => 'Icons', 'action' => 'view', $company->icon->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span></td>
											<td class="string link category-id" value="<?= $company->category_id ?>"><?= $company->hasValue('category') ? $this->Html->link($company->category->name, ['controller' => 'Categories', 'action' => 'view', $company->category->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span></td>
											<td class="string logo" value="<?= $company->logo ?>"><?= h($company->logo) ?></td>
											<td class="string banner" value="<?= $company->banner ?>"><?= h($company->banner) ?></td>
											<td class="string name" value="<?= $company->name ?>">
												<span class="fw-bold"><?= h($company->name) ?></span><br>
												<?= h($company->keywords) ?>
											</td>
											<td class="string link city-id" value="<?= $company->city_id ?>">
												<?= $company->hasValue('city') ? $this->Html->link($company->city->name, ['controller' => 'Cities', 'action' => 'view', $company->city->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span><br>
												<span class="fw-normal"><?= $company->address ?> <?= $company->house_number ?>.</span>
											</td>
											<td class="string description" value="<?= $company->description ?>"><?= h($company->description) ?></td>
											<td class="string longitude" value="<?= $company->longitude ?>"><?= h($company->longitude) ?></td>
											<td class="string latitude" value="<?= $company->latitude ?>"><?= h($company->latitude) ?></td>
											<td class="integer maximum-distance" value="<?= $company->maximum_distance ?>"><?= $this->Number->format($company->maximum_distance, ['places' => 0, 'precision' => 0, 'before' => '', 'after' => '']) ?></td>
											<td class="date date-from" value="<?= $company->date_from ?>"><?= h($company->date_from) ?></td>
											<td class="date date-to" value="<?= $company->date_to ?>"><?= h($company->date_to) ?></td>
<?php if($config['show_pos']){ ?>
											<td class="number pos" value="<?= $company->pos ?>"><?= h($company->pos) ?></td>
<?php } ?>
<?php if($config['show_visible']){ ?>
											<td class="boolean visible" value="<?= $company->visible ?>"><?= h($company->visible) ?></td>
<?php } ?>
<?php if($config['show_counters']){ ?>
											<td class="number counter person-count" value="<?= $company->person_count ?>"><?= h($company->person_count) ?></td><?php } ?>
<?php if($config['show_created'] || $config['show_modified']){ ?>
											<td class="datetime">
<?php if($config['show_created']){ ?>
												<span class="fw-bold"><?= h($company->created) ?></span>
<?php } ?>
<?php if($config['show_created'] && $config['show_modified']){ ?>
												<br>
<?php } ?>
<?php if($config['show_modified']){ ?>
												<span class="fw-normal"><?= h($company->modified) ?></span>
<?php } ?>
											</td>
<?php } ?>
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>

											<td class="actions">
<?php if($config['show_button_view']){ ?>
												<?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $company->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-warning btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('View this item'), 'data-original-title' => __('View this item')]) ?>
<?php } ?>

<?php if($config['show_button_edit']){ ?>
												<?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $company->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-primary btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('Edit this item'), 'data-original-title' => __('Edit this item')]) ?>
<?php } ?>

<?php if($config['show_button_delete']){ ?>
												<?= $this->Form->postLink('', ['action' => 'delete', $company->id], ['class'=>'hide-postlink index-delete-button-class']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($company->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="fa fa-minus"></i></a>

<?php } ?>

											</td>
<?php } ?>
										</tr>
										<?php endforeach; ?>

									</tbody>
								</table>

							</div>
							<div class="card-footer text-center">
								<div class="float-start">
									<?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
								</div>								
								<div class="float-end mb-1">							
									<?= $this->element('jeffAdmin5.paginator') ?>
									
								</div>								
							</div>
						</div><!-- end card-->					
					</div>

				</div>			

	<?php
	if(isset($config['index_show_actions']) && $config['index_show_actions'] && isset($config['index_enable_delete']) && $config['index_enable_delete']){ 
		$this->Html->script(
			[
				"JeffAdmin5./assets/plugins/sweetalert2/dist/sweetalert2.all.min",
				//"JeffAdmin5./assets/plugins/jquery-copy-to-clipboard-master/jquery.copy-to-clipboard",
			],
			['block' => 'scriptBottom']
		);
	}	
	?>

<?php $this->Html->scriptStart(['block' => 'javaScriptBottom']); ?>

	$(document).ready( function(){
		$('tr').dblclick( function(){
			let id = $(this).attr("row-id")
			window.location.href = '<?= $this->Url->build(['controller' => $controller, 'action' => $config['action_db_click']]) ?>/' + id;
		})

		// Fixing CakePhp's paginator numbers
		$('.page-link').each( function(){
			if($(this).text() == '1'){
				$(this).attr('href', $(this).attr('href') + '?page=1');
			}
		});
		
	})
<?php $this->Html->scriptEnd(); ?>



