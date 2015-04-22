<?php $this->assign('title', 'Liste des joueurs ban'); ?>
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
$players = $api->call('players.banned.names')[0]['success'];
//$api->call('server.map.save');
$count = count($players);
//debug($players);
//$m1 = "Env";
//$m2 = "COIN COIN";
//$msg = $m1.' '.$m2;
//$test = $api->call('chat.broadcast', [$msg]);
//$test
?>
<div class="main-content">
    <div class="container">
        <div class="page-content">
            <div class="single-head">
                <h3 class="pull-left"><i class="fa fa-table lblue"></i><?php echo $count; ?> joueurs ban sur le serveur</h3>
                <div class="clearfix"></div>
            </div>
            <div class="page-tables">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" cellpadding="0" cellspacing="0" border="0" id="data-table" width="100%">
                        <thead>
                            <tr>
                                <th><b>Pseudo</b></th>
                                <th><b>UUID</b></th>
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
	                                		echo $p;
	                                	?>
	                                </td>
                                    <td>
                                        <?php
                                            $UUID = file_get_contents('http://api.serveurs-minecraft.com/api_uuid?Pseudo_Vers_UUID&ID='.$p);
                                            $insultes = array("Pseudo incorrect");
                                            //$mot = "f2e06d1bdbaf487ba3d6a8fe1b83f7b1"; UUId de DevilRaziel
                                                if (in_array($UUID, $insultes))
                                                    {
                                                        echo 'CRACK';
                                                    }
                                                else
                                                    {
                                                        echo $UUID;
                                                    }
                                        ?>
                                    </td>
	                                <td>
                                        <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'unban', $p]); ?>" class="label label-danger"><i class="fa fa-ban"></i> UnBan</a>
                                        <a href="<?php echo $this->Html->url(['controller' => 'players', 'action' => 'whois', $p]); ?>" class="label label-success"><i class="fa fa-info-circle"></i> Whois ?</a>
	                                </td>
	                            </tr>
								<?php
								 //debug($p);
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