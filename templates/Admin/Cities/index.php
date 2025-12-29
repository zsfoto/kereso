<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\City> $cities
 */
use Cake\Core\Configure;

$layoutCitiesLastId = -1;
if($session->check('Layout.Cities.LastId')){
	$layoutCitiesLastId = $session->read('Layout.Cities.LastId');
}

$global_config = (array) Configure::read('Theme.' . $prefix . '.config.template.index');
$local_config = [
	'show_id' 			=> true,
	'show_pos' 			=> false,
	'show_counters'		=> false,
	'action_db_click'	=> 'edit',	// none, edit or view
	// ... more config params in: \JeffAdmin5\config\jeffadmin5.php
];
$config = array_merge($global_config, $local_config);
?>
				<div class="cities index row">
						
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card">
							<div class="card-header">
							
								<div class="float-start">
									<h3><i id="card-icon" class="fa fa-table fa-spin"></i> <?= __('Table') ?>: <?= __('Cities') ?></h3>
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
											<th class="string country-id"><?= $this->Paginator->sort('country_id') ?></th><!-- H.0. -->
											<th class="string county-id"><?= $this->Paginator->sort('county_id') ?></th><!-- H.0. -->
											<th class="string shortname"><?= $this->Paginator->sort('shortname') ?></th><!-- H.1. -->
											<th class="string name"><?= $this->Paginator->sort('name') ?></th><!-- H.1. -->
											<th class="string zip"><?= $this->Paginator->sort('zip') ?></th><!-- H.1. -->
											<th class="string lat"><?= $this->Paginator->sort('lat') ?></th><!-- H.1. -->
											<th class="string lng"><?= $this->Paginator->sort('lng') ?></th><!-- H.1. -->
											<th class="string lat2"><?= $this->Paginator->sort('lat2') ?></th><!-- H.1. -->
											<th class="string lng2"><?= $this->Paginator->sort('lng2') ?></th><!-- H.1. -->
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>
											<th class="actions"><?= __('Actions') ?></th>
<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($cities as $city): ?>
<?php
	//$classLastVisited = ' class="last-visited"';	// later...
	//$classLastVisited = '';
?>

										<tr row-id="<?= $city->id ?>"<?php if($city->id == $layoutCitiesLastId){ echo 'class="table-tr-last-id"'; } ?> prefix="<?= $prefix ?>" controller="<?= $controller ?>" action="<?= $action ?>" aria-expanded="true">
											<td class="row-id-anchor" value="<?= $city->id ?>"><a name="<?= $city->id ?>" class="anchor"></a></td>
<?php if($config['show_id']){ ?>
											<td class="number id" value="<?= $city->id ?>"><?= h($city->id) ?><a name="<?= $city->id ?>"></a></td>
<?php } ?>
											<td class="string link country-id" value="<?= $city->country_id ?>"><?= $city->hasValue('country') ? $this->Html->link($city->country->name_hu, ['controller' => 'Countries', 'action' => 'view', $city->country->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span></td>
											<td class="string link county-id" value="<?= $city->county_id ?>"><?= $city->hasValue('county') ? $this->Html->link($city->county->name, ['controller' => 'Counties', 'action' => 'view', $city->county->id]) : '' ?><span class="external-link-icon"><i class="fa fa-external-link" aria-hidden="true"></i></span></td>
											<td class="string shortname" value="<?= $city->shortname ?>"><?= h($city->shortname) ?></td>
											<td class="string name" value="<?= $city->name ?>"><?= h($city->name) ?></td>
											<td class="string zip" value="<?= $city->zip ?>"><?= h($city->zip) ?></td>
											<td class="string lat" value="<?= $city->lat ?>"><?= h($city->lat) ?></td>
											<td class="string lng" value="<?= $city->lng ?>"><?= h($city->lng) ?></td>
											<td class="string lat2" value="<?= $city->lat2 ?>"><?= h($city->lat2) ?></td>
											<td class="string lng2" value="<?= $city->lng2 ?>"><?= h($city->lng2) ?></td>
<?php if($config['show_button_view'] || $config['show_button_edit'] || $config['show_button_delete'] ){ ?>

											<td class="actions">
<?php if($config['show_button_view']){ ?>
												<?= $this->Html->link('<i class="fa fa-eye"></i>', ['action' => 'view', $city->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-warning btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('View this item'), 'data-original-title' => __('View this item')]) ?>
<?php } ?>

<?php if($config['show_button_edit']){ ?>
												<?= $this->Html->link('<i class="fa fa-edit"></i>', ['action' => 'edit', $city->id], ['escape' => false, 'role' => 'button', 'class' => 'btn btn-primary btn-sm', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => __('Edit this item'), 'data-original-title' => __('Edit this item')]) ?>
<?php } ?>

<?php if($config['show_button_delete']){ ?>
												<?= $this->Form->postLink('', ['action' => 'delete', $city->id], ['class'=>'hide-postlink index-delete-button-class']) ?>
												<a href="javascript:;" class="btn btn-sm btn-danger postlink-delete" data-bs-tooltip="tooltip" data-bs-placement="top" title="<?= __("Delete this record!") ?>" text="<?= h($city->name) ?>" subText="<?= __("You will not be able to revert this!") ?>" confirmButtonText="<?= __("Yes, delete it!") ?>" cancelButtonText="<?= __("Cancel") ?>"><i class="fa fa-minus"></i></a>

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



