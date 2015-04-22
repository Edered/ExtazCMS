<?php $this->assign('title', 'Liste des joueurs'); ?>
<script>
$(document).ready(function(){
    $(window).load(function(){
        $(".confirm").confirm({
            text: "Voulez vous vraiment bannir ce joueur ?",
            title: "Confirmation",
            confirmButton: "Oui",
            cancelButton: "Non"
        });
    });

    $('#data-table').dataTable({
        "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "Tout"]],
        "order": [[1, 'DESC']],
        language: {
            processing:     "Traitement en cours...",
            search:         "Rechercher&nbsp;:",
            lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
            info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
            infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
            infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
            infoPostFix:    "",
            loadingRecords: "Chargement en cours...",
            zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
            emptyTable:     "Aucune donnée disponible dans le tableau",
            paginate: {
                first:      "Premier",
                previous:   "Pr&eacute;c&eacute;dent",
                next:       "Suivant",
                last:       "Dernier"
            },
            aria: {
                sortAscending:  ": activer pour trier la colonne par ordre croissant",
                sortDescending: ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });
});
</script>
<?php
$group = $api->call('groups.all')[0]['success'];
//debug($group);
$players = $api->call('players.online')[0]['success'];
$count = count($group);
//debug($names);
//$name = 'DeviLRaziel';
//$banplayer = $api->call('players.name', [$name])[0]['success'];
//debug($banplayer);
?>
<div class="main-content">
    <div class="container">
        <div class="page-content">
            <div class="single-head">
                <h3 class="pull-left"><i class="fa fa-table lblue"></i><?php echo $count; ?> groupes sur le serveur</h3>
                <div class="clearfix"></div>
            </div>
            <div class="page-tables">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th><b>Pseudo</b></th>
                                <th><b>GM</b></th>
                                <th><b>Groupe</b></th>
                                <th><b>Monde</b></th>
                                <th><b>Actions</b></th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
							foreach($players as $p){
								?>
								<tr>
	                                <td>
										<?php
	                                	if($p['op'] == true){
	                                		echo '<span class="text-danger"><i class="fa fa-certificate"></i> '.$p['name'].'</span>';
	                                	}
	                                	else
	                                		{
	                                			$banplayer = $api->call('players.name', [$p['name']])[0]['success'];
	                                			if($banplayer['banned'] == true)
	                                				{
	                                					echo '<s>'.$p['name'].'</s> | Banni';
	                                				}
	                                			else
	                                				{
	                                					echo $p['name'];
	                                				}	                                			
	                                		}
	                                	?>
	                                </td>
	                                <td><?php echo $p['gameMode']; ?></td>
	                                <td>
	                                	<?php
	                                		$group = $api->call('players.name.groups', [$p['name']])['0']['success'];
	                                		echo $group[0];
	                                	?>
	                                </td>
	                                <td>
	                                	<?php
	                                	if($p['worldInfo']['isPVP'] == true){
	                                		echo $this->Html->image('minecraft/pvp.png', ['width' => 16, 'height' => 16, 'class' => 'ui-tooltip', 'data-original-title' => 'PvP activé', ' data-toggle' => 'tooltip', 'data-placement' => 'left']).' '.$p['worldInfo']['name'];
	                                	}
	                                	else{
	                                		echo $this->Html->image('minecraft/nopvp.png', ['width' => 16, 'height' => 16, 'class' => 'ui-tooltip', 'data-original-title' => 'PvP désactivé', ' data-toggle' => 'tooltip', 'data-placement' => 'left']).' '.$p['worldInfo']['name'];
	                                	}
	                                	?>
	                                </td>
	                                <td>
                                        <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'ban', $p['name']]); ?>" class="label label-danger"><i class="fa fa-ban"></i> Ban</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'banip', $p['name']]); ?>" class="label label-danger"><i class="fa fa-globe"></i> Ban IP</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'whois', $p['name']]); ?>" class="label label-success"><i class="fa fa-info-circle"></i> Whois ?</a>
	                                </td>
	                            </tr>
								<?php
								// debug($p);
							}
							?>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>