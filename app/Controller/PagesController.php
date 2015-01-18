<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');
App::uses('AYAH', 'Lib/AYAH');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = ['Informations', 'shopHistory', 'starpassHistory', 'paypalHistory', 'Team', 'Support', 'supportComments', 'donationLadder'];
	public $components = ['Highcharts.Highcharts'];
    public $Highcharts = null;

/**
 * Displays a view
 *
 * @return void
 * @throws NotFoundException When the view file could not be found
 *	or MissingViewException in debug mode.
 */

	public function beforeFilter(){
	    parent::beforeFilter();
        $this->Auth->allow();
	}

	public function admin_chat(){
		if($this->Auth->user('role') > 0){
			if($this->request->is('ajax')){
				$informations = $this->Informations->find('first');
	    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
				$m = $api->call('streams.chat.latest', [20])[0]['success'];
				$result = '
				<input id="update" type="checkbox" checked="checked" class="update"></input>
				<label for="update">Mise à jour automatique ?</label><br>
				<i class="fa fa-clock-o"></i> Dernière mise à jour '.date('H:i:s').'<hr>
				['.date('H:i:s', $m[0]['time']).'] <b class="player" id="'.$m[0]['player'].'" style="cursor: pointer"> '.$m[0]['player'].' :</b> '.$m[0]['message'].'<br>
				['.date('H:i:s', $m[1]['time']).'] <b class="player" id="'.$m[1]['player'].'" style="cursor: pointer"> '.$m[1]['player'].' :</b> '.$m[1]['message'].'<br>
				['.date('H:i:s', $m[2]['time']).'] <b class="player" id="'.$m[2]['player'].'" style="cursor: pointer"> '.$m[2]['player'].' :</b> '.$m[2]['message'].'<br>
				['.date('H:i:s', $m[3]['time']).'] <b class="player" id="'.$m[3]['player'].'" style="cursor: pointer"> '.$m[3]['player'].' :</b> '.$m[3]['message'].'<br>
				['.date('H:i:s', $m[4]['time']).'] <b class="player" id="'.$m[4]['player'].'" style="cursor: pointer"> '.$m[4]['player'].' :</b> '.$m[4]['message'].'<br>
				['.date('H:i:s', $m[5]['time']).'] <b class="player" id="'.$m[5]['player'].'" style="cursor: pointer"> '.$m[5]['player'].' :</b> '.$m[5]['message'].'<br>
				['.date('H:i:s', $m[6]['time']).'] <b class="player" id="'.$m[6]['player'].'" style="cursor: pointer"> '.$m[6]['player'].' :</b> '.$m[6]['message'].'<br>
				['.date('H:i:s', $m[7]['time']).'] <b class="player" id="'.$m[7]['player'].'" style="cursor: pointer"> '.$m[7]['player'].' :</b> '.$m[7]['message'].'<br>
				['.date('H:i:s', $m[8]['time']).'] <b class="player" id="'.$m[8]['player'].'" style="cursor: pointer"> '.$m[8]['player'].' :</b> '.$m[8]['message'].'<br>
				['.date('H:i:s', $m[9]['time']).'] <b class="player" id="'.$m[9]['player'].'" style="cursor: pointer"> '.$m[9]['player'].' :</b> '.$m[9]['message'].'<br>
				['.date('H:i:s', $m[10]['time']).'] <b class="player" id="'.$m[10]['player'].'" style="cursor: pointer"> '.$m[10]['player'].' :</b> '.$m[10]['message'].'<br>
				['.date('H:i:s', $m[11]['time']).'] <b class="player" id="'.$m[11]['player'].'" style="cursor: pointer"> '.$m[11]['player'].' :</b> '.$m[11]['message'].'<br>
				['.date('H:i:s', $m[12]['time']).'] <b class="player" id="'.$m[12]['player'].'" style="cursor: pointer"> '.$m[12]['player'].' :</b> '.$m[12]['message'].'<br>
				['.date('H:i:s', $m[13]['time']).'] <b class="player" id="'.$m[13]['player'].'" style="cursor: pointer"> '.$m[13]['player'].' :</b> '.$m[13]['message'].'<br>
				['.date('H:i:s', $m[14]['time']).'] <b class="player" id="'.$m[14]['player'].'" style="cursor: pointer"> '.$m[14]['player'].' :</b> '.$m[14]['message'].'<br>
				['.date('H:i:s', $m[15]['time']).'] <b class="player" id="'.$m[15]['player'].'" style="cursor: pointer"> '.$m[15]['player'].' :</b> '.$m[15]['message'].'<br>
				['.date('H:i:s', $m[16]['time']).'] <b class="player" id="'.$m[16]['player'].'" style="cursor: pointer"> '.$m[16]['player'].' :</b> '.$m[16]['message'].'<br>
				['.date('H:i:s', $m[17]['time']).'] <b class="player" id="'.$m[17]['player'].'" style="cursor: pointer"> '.$m[17]['player'].' :</b> '.$m[17]['message'].'<br>
				['.date('H:i:s', $m[18]['time']).'] <b class="player" id="'.$m[18]['player'].'" style="cursor: pointer"> '.$m[18]['player'].' :</b> '.$m[18]['message'].'<br>
				['.date('H:i:s', $m[19]['time']).'] <b class="player" id="'.$m[19]['player'].'" style="cursor: pointer"> '.$m[19]['player'].' :</b> '.$m[19]['message'].'<br>';
				echo json_encode($result);
				exit();
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_send_message(){
		if($this->Auth->user('role') > 0){
			if($this->request->is('ajax')){
				$informations = $this->Informations->find('first');
	    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
				$message = str_replace('/', '', $this->request->data['message']);
				if(!empty($message) && $api->call('server.run_command', ['say ['.$this->Auth->user('username').'] '.$message])){
				// if(!empty($message) && $this->request->is('post') && $api->call('chat.with_name', [$message, $this->Auth->user('username')])){
					exit();
				}
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_send_command(){
		if($this->Auth->user('role') > 0){
			if($this->request->is('ajax')){
				$informations = $this->Informations->find('first');
	    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
				$command = str_replace('/', '', $this->request->data['command']);
				if(!empty($command) && $api->call('server.run_command', [$command])){
					exit();
				}
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit_donator($id = null){
        if($this->Auth->user('role') > 0){
            $this->donationLadder->id = $id;
            if($this->donationLadder->exists()){
                $this->set('data', $this->donationLadder->find('first', ['conditions' => ['donationLadder.id' => $id]]));
                if($this->request->is('post')){
                    $this->donationLadder->id = $id;
                    $this->donationLadder->saveField('tokens', $this->request->data['Pages']['tokens_ladder']);
                    $this->donationLadder->saveField('updated', $this->request->data['Pages']['updated']);
                    $this->Session->setFlash('Modification réussie !', 'success');
                    return $this->redirect($this->referer());
                }
            }
            else{
                $this->Session->setFlash('Cet membre n\'existe pas !', 'error');
                return $this->redirect($this->referer());
            }
        }
    }

	public function admin_delete_donator($id = null){
		if($this->Auth->user('role') > 0){
			$this->donationLadder->id = $id;
			if($this->donationLadder->exists()){
				$this->donationLadder->delete($id);
				$this->Session->setFlash('Ce donateur a été retiré du classement !', 'success');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_donators', 'admin' => true]);
			}
			else{
				$this->Session->setFlash('Ce dontateur n\'existe pas !', 'error');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_donators', 'admin' => true]);
			}
		}
		else{
			throw new NotFoundException();			
		}
	}

	public function admin_list_donator(){
		if($this->Auth->user('role') > 0){
			$this->set('data', $this->donationLadder->find('all', ['order' => ['donationLadder.tokens' => 'DESC']]));
		}
		else{
			throw new NotFoundException();			
		}
	}

	public function admin_stats(){
		if($this->Auth->user('role') > 0){
			$today = date('Y-m-j').' 00:00:00';
			$hier = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$thisWeek = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			// ACHATS
			// Depuis toujours
			$this->set('achatsDepuisToujours', $this->shopHistory->find('count'));
			$this->set('starpassDepuisToujours', $this->starpassHistory->find('count'));
			$this->set('paypalDepuisToujours', $this->paypalHistory->find('count'));
			// Les 7 derniers jours
			$this->set('achatsCetteSemaine', $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $thisWeek]]));
			$this->set('starpassCetteSemaine', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $thisWeek]]));
			$this->set('paypalCetteSemaine', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $thisWeek]]));
			// Ajd
			$this->set('achatsAujourdhui', $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $today]]));
			$this->set('starpassAujourdhui', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $today]]));
			$this->set('paypalAujourdhui', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $today]]));
			// Hier
			$this->set('achatsHier', $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $hier, 'shopHistory.created <' => $today]]));
			$this->set('starpassHier', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $hier, 'starpassHistory.created <' => $today]]));
			$this->set('paypalHier', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $hier, 'paypalHistory.created <' => $today]]));

			// GLOBALES
			// Depuis toujours
			$this->set('utilisateursDepuisToujours', $this->User->find('count'));
			$this->set('ticketsDepuisToujours', $this->Support->find('count'));
			$this->set('reponsesDepuisToujours', $this->supportComments->find('count'));
			// Les 7 derniers jours
			$this->set('utilisateursCetteSemaine', $this->User->find('count', ['conditions' => ['User.created >' => $thisWeek]]));
			$this->set('ticketsCetteSemaine', $this->Support->find('count', ['conditions' => ['Support.created >' => $thisWeek]]));
			$this->set('reponsesCetteSemaine', $this->supportComments->find('count', ['conditions' => ['supportComments.created >' => $thisWeek]]));
			// Ajd
			$this->set('utilisateursAujourdhui', $this->User->find('count', ['conditions' => ['User.created >' => $today]]));
			$this->set('ticketsAujourdhui', $this->Support->find('count', ['conditions' => ['Support.created >' => $today]]));
			$this->set('reponsesAujourdhui', $this->supportComments->find('count', ['conditions' => ['supportComments.created >' => $today]]));
			// Hier
			$this->set('utilisateursHier', $this->User->find('count', ['conditions' => ['User.created >' => $hier, 'User.created <' => $today]]));
			$this->set('ticketsHier', $this->Support->find('count', ['conditions' => ['Support.created >' => $hier, 'Support.created <' => $today]]));
			$this->set('reponsesHier', $this->supportComments->find('count', ['conditions' => ['supportComments.created >' => $hier, 'supportComments.created <' => $today]]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function add_ticket(){
		if($this->Auth->user()){
			if($this->request->is('post')){
				if(!empty($this->request->data['Pages']['message'])){
					$this->Support->create;
					$this->Support->saveField('user_id', $this->Auth->user('id'));
					$this->Support->saveField('username', $this->Auth->user('username'));
					$this->Support->saveField('priority', $this->request->data['Pages']['priority']);
					$this->Support->saveField('message', $this->request->data['Pages']['message']);
					$this->Support->saveField('resolved', 0);
					$this->Session->setFlash('Votre message a été envoyé au support, merci !', 'success');
					return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
				}
				else{
					$this->Session->setFlash('Vous devez écrire un message', 'error');
					return $this->redirect(['controller' => 'pages', 'action' => 'add_ticket']);
				}
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}

	public function list_tickets(){
		if($this->Auth->user()){
			$this->set('data', $this->Support->find('all', ['conditions' => ['Support.username' => $this->Auth->user('username')], 'order' => ['Support.created DESC']]));
			$this->set('nbTickets', $this->Support->find('count', ['conditions' => ['Support.username' => $this->Auth->user('username')]]));
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}

	public function view_ticket($id = null){
		if($this->Auth->user()){
			$ticket = $this->Support->find('first', ['conditions' => ['Support.id' => $id]]);
			$ticketOwner = $ticket['Support']['username'];
			if($ticketOwner == $this->Auth->user('username') OR $this->Auth->user('role') > 0){
				if($this->Support->findById($id)){
					$this->set('data', $this->Support->find('first', ['conditions' => ['Support.id' => $id]]));
					$this->set('comments', $this->supportComments->find('all', ['conditions' => ['supportComments.ticket_id' => $id], 'order' => ['supportComments.created DESC']]));
					$this->set('nbComments', $this->supportComments->find('count', ['conditions' => ['supportComments.ticket_id' => $id], 'order' => ['supportComments.created DESC']]));
				}
				else{
					throw new NotFoundException();
				}
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function close_ticket($id = null){
		if($this->Auth->user('role') > 0){
			if($this->Support->find('first', ['conditions' => ['Support.id' => $id]])){
				$this->Support->id = $id;
				$this->Support->saveField('resolved', 1);
				$this->Session->setFlash('Ticket clôturé', 'success');
				return $this->redirect($this->referer());
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function close_my_ticket($id = null){
		if($this->Auth->user()){
			if($this->Support->find('first', ['conditions' => ['Support.id' => $id]])){
				$this->Support->id = $id;
				$this->Support->saveField('resolved', 1);
				$this->Session->setFlash('Votre ticket a bien été fermé', 'success');
				return $this->redirect($this->referer());
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function open_ticket($id = null){
		if($this->Auth->user('role') > 0){
			if($this->Support->find('first', ['conditions' => ['Support.id' => $id]])){
				$this->Support->id = $id;
				$this->Support->saveField('resolved', 0);
				$this->Session->setFlash('Ticket ouvert', 'success');
				return $this->redirect($this->referer());
			}
			else{
				throw new NotFoundException();
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'list_tickets']);
		}
	}

	public function answer_ticket($id = null){
		if($this->Auth->user()){
			if($this->request->is('post')){
				if(!empty($this->request->data['Pages']['message'])){
					$ticket = $this->Support->find('first', ['conditions' => ['Support.id' => $this->request->data['Pages']['id']]]);
					$ticketOwner = $this->User->find('first', ['conditions' => ['User.username' => $ticket['Support']['username']]]);
					$ticketOwnerEmail = $ticketOwner['User']['email'];
					$ticketOwnerAllowEmail = $ticketOwner['User']['allow_email'];
					if($ticketOwner['User']['username'] == $this->Auth->user('username') OR $this->Auth->user('role') > 0){
						if($ticket['Support']['resolved'] == 0){
							// Si l'utilisateur accepte de recevoir des emails
							if($ticketOwnerAllowEmail == 1){
								$informations = $this->Informations->find('first');
			                    $name_server = $informations['Informations']['name_server'];
			                    $name_server = strtolower(preg_replace('/\s/', '', $name_server));
			                    $Email = new CakeEmail();
			                    $Email->from(array('support@'.$name_server.'.com' => $name_server));
			                    $Email->to($ticketOwnerEmail);
			                    $Email->subject('['.$informations['Informations']['name_server'].'] Support, nouvelle réponse à votre ticket #'.$ticket['Support']['id'].'');
			                    $Email->send('Retrouvez cette nouvelle réponse ici : http://'.$_SERVER['HTTP_HOST'].$this->webroot.'tickets/'.$ticket['Support']['id']);
							}
							$this->supportComments->create;
							$this->supportComments->saveField('ticket_id', $this->request->data['Pages']['id']);
							$this->supportComments->saveField('username', $this->Auth->user('username'));
							$this->supportComments->saveField('message', $this->request->data['Pages']['message']);
							$this->Session->setFlash('Réponse ajoutée !', 'success');
							return $this->redirect($this->referer());
						}
						else{
							$this->Session->setFlash('Ce ticket est fermé...', 'error');
							return $this->redirect($this->referer());
						}
					}
					else{
						$this->Session->setFlash('Action impossible !', 'error');
						return $this->redirect($this->referer());
					}
				}
				else{
					$this->Session->setFlash('Vous devez écrire un message', 'error');
					return $this->redirect($this->referer());
				}
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'pages', 'action' => 'add_ticket']);
		}
	}

	public function admin_manage_tickets(){
		if($this->Auth->user('role') > 0){
			$this->set('data', $this->Support->find('all', ['conditions' => ['Support.resolved' => 0], 'order' => ['Support.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function delete_support_comment($id = null){
		if($this->Auth->user('role') > 0){
			$this->supportComments->delete($id);
			$this->Session->setFlash('Réponse supprimée', 'success');
			return $this->redirect($this->referer());
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_shop_history(){
		if($this->Auth->user('role') > 0){
			$this->set('data', $this->shopHistory->find('all', ['order' => ['shopHistory.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_starpass_history(){
		if($this->Auth->user('role') > 0){
			$this->set('data', $this->starpassHistory->find('all', ['order' => ['starpassHistory.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_paypal_history(){
		if($this->Auth->user('role') > 0){
			$this->set('data', $this->paypalHistory->find('all', ['order' => ['paypalHistory.created DESC']]));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_add_member(){
		if($this->Auth->user('role') > 0){
			if($this->request->is('post')){
				$this->Team->saveField('username', $this->request->data['Pages']['username']);
				$this->Team->saveField('rank', $this->request->data['Pages']['rank']);
				$this->Team->saveField('facebook_url', $this->request->data['Pages']['facebook_url']);
				$this->Team->saveField('twitter_url', $this->request->data['Pages']['twitter_url']);
				$this->Session->setFlash('Membre ajouté à l\'équipe !', 'success');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_list_member(){
		if($this->Auth->user('role') > 0){
			$this->set('data', $this->Team->find('all', array('order' => array('Team.rank' => 'ASC'))));
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_delete_member($id = null){
		if($this->Auth->user('role') > 0){
			if($this->Team->findById($id)){
				$this->Team->delete($id);
				$this->Session->setFlash('Membre retiré de l\'équipe !', 'success');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
			}
			else{
				$this->Session->setFlash('Ce membre n\'existe pas !', 'error');
				return $this->redirect(['controller' => 'pages', 'action' => 'list_member', 'admin' => true]);
			}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_edit_member($id = null){
        if($this->Auth->user('role') > 0){
            $this->Team->id = $id;
            if($this->Team->exists()){
                $this->set('data', $this->Team->find('first', ['conditions' => ['Team.id' => $id]]));
                if($this->request->is('post')){
                    $this->Team->id = $id;
                    $this->Team->saveField('username', $this->request->data['Pages']['username']);
					$this->Team->saveField('rank', $this->request->data['Pages']['rank']);
					$this->Team->saveField('facebook_url', $this->request->data['Pages']['facebook_url']);
					$this->Team->saveField('twitter_url', $this->request->data['Pages']['twitter_url']);
                    $this->Session->setFlash('Membre modifié !', 'success');
                    return $this->redirect($this->referer());
                }
            }
            else{
                $this->Session->setFlash('Cet membre n\'existe pas !', 'error');
                return $this->redirect($this->referer());
            }
        }
    }

	public function team(){
		$this->set('data', $this->Team->find('all', ['order' => ['Team.rank ASC']]));
		$this->set('count', $this->Team->find('count'));
	}

	public function contact(){
		if($this->Auth->user()){
			$ayah = new AYAH();
            $this->set('ayah', $ayah);
			if($this->request->is('post')){
                if(array_key_exists('captcha', $this->request->data)){
                    $score = $ayah->scoreResult();
                    if($score){
						$informations = $this->Informations->find('first');
						$contact_email = $informations['Informations']['contact_email'];
						$name_server = $informations['Informations']['name_server'];
						$username = $this->Auth->user('username');
						$email = $this->Auth->user('email');
						$subject = $this->request->data['Pages']['subject'];
						$message = $this->request->data['Pages']['message'];
						if(!empty($subject) && !empty($message)){
							$name_server = strtolower(preg_replace('/\s/', '', $name_server));
							$Email = new CakeEmail();
		                    $Email->from(array('admin@'.$name_server.'.com' => $name_server));
		                    $Email->to($contact_email);
		                    $Email->subject($subject);
		                    $Email->send($username.' ('.$email.') a envoyé : '.$message);
							$this->Session->setFlash('Votre message a été envoyé, merci !', 'success');
						}
						else{
							$this->Session->setFlash('Tous les champs sont obligatoires', 'error');
						}
					}
					else{
						$this->Session->setFlash('Erreur 1001', 'error');
					}
				}
			}
		}
		else{
			$this->Session->setFlash('Vous devez être connecté pour accéder à cette page', 'error');
			return $this->redirect(['controller' => 'users', 'action' => 'login', 'admin' => false]);
		}
	}

	public function rules(){
		
	}

	public function admin_memory_chart(){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
			$totalMemory = round($api->call('server.performance.memory.total')['0']['success']);
			$usedMemory = round($api->call('server.performance.memory.used')['0']['success']);
			$pieData = array(
	            array('Mémoire disponible', $totalMemory),
	            array('Mémoire utilisé', $usedMemory)
	        );
	        $chartName = 'memory_chart';
	        $pieChart = $this->Highcharts->create($chartName, 'pie');
	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'memory_chart',
	            'chartWidth' => 650,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 0,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Utilisation de la mémoire vive du serveur (en MB)',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => TRUE,
	            'tooltipBackgroundColorLinearGradient' => array(0, 0, 0, 50),
	            'tooltipBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
	            'creditsEnabled' => FALSE
	            )
	        );
	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('En megabytes')->addData($pieData);
	        $pieChart->addSeries($series);
	        
	        $this->set(compact('chartName'));
		}
	    else{
	    	throw new NotFoundException();
	    }
	}

	public function admin_donator_chart(){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
			$site_money = ucfirst($informations['Informations']['site_money']);
			$donatorsTokens = $this->donationLadder->find('all', ['limit' => 5, 'order' => ['donationLadder.tokens' => 'DESC']]);
			$donatorsUsername = $this->donationLadder->find('list', ['fields' => ['donationLadder.id'], 'limit' => 5]);
			$countDonators = $this->donationLadder->find('count');
			$chartName = 'donator_chart';
	        $mychart = $this->Highcharts->create($chartName, 'column');

	        if($countDonators > 5){
	        	$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
		        $dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
		        $dt[2] = $donatorsTokens[2]['donationLadder']['tokens'];
		        $dt[3] = $donatorsTokens[3]['donationLadder']['tokens'];
		        $dt[4] = $donatorsTokens[4]['donationLadder']['tokens'];
		        settype($dt[0], 'int');
				settype($dt[1], 'int');
				settype($dt[2], 'int');
				settype($dt[3], 'int');
				settype($dt[4], 'int');
	        }
	        else{
		        switch($countDonators){
		        	case 1:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
		        		settype($dt[0], 'int');
		        		break;

		        	case 2:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
		        		$dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
		        		settype($dt[0], 'int');
						settype($dt[1], 'int');
		        		break;

		        	case 3:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
				        $dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
				        $dt[2] = $donatorsTokens[2]['donationLadder']['tokens'];
				        settype($dt[0], 'int');
						settype($dt[1], 'int');
						settype($dt[2], 'int');
		        		break;

		        	case 4:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
				        $dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
				        $dt[2] = $donatorsTokens[2]['donationLadder']['tokens'];
				        $dt[3] = $donatorsTokens[3]['donationLadder']['tokens'];
				        settype($dt[0], 'int');
						settype($dt[1], 'int');
						settype($dt[2], 'int');
						settype($dt[3], 'int');
		        		break;

		        	case 5:
		        		$dt[0] = $donatorsTokens[0]['donationLadder']['tokens'];
				        $dt[1] = $donatorsTokens[1]['donationLadder']['tokens'];
				        $dt[2] = $donatorsTokens[2]['donationLadder']['tokens'];
				        $dt[3] = $donatorsTokens[3]['donationLadder']['tokens'];
				        $dt[4] = $donatorsTokens[4]['donationLadder']['tokens'];
				        settype($dt[0], 'int');
						settype($dt[1], 'int');
						settype($dt[2], 'int');
						settype($dt[3], 'int');
						settype($dt[4], 'int');
		        		break;

		        	default:
		        		$dt[0] = 0;
		        		break;
		        }
		    }

		    if($countDonators > 5){
	        	$du[0] = $donatorsTokens[0]['User']['username'];
		        $du[1] = $donatorsTokens[1]['User']['username'];
		        $du[2] = $donatorsTokens[2]['User']['username'];
		        $du[3] = $donatorsTokens[3]['User']['username'];
		        $du[4] = $donatorsTokens[4]['User']['username'];
	        }
	        else{
		        switch($countDonators){
		        	case 1:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
		        		break;

		        	case 2:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
		        		$du[1] = $donatorsTokens[1]['User']['username'];

		        	case 3:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
				        $du[1] = $donatorsTokens[1]['User']['username'];
				        $du[2] = $donatorsTokens[2]['User']['username'];
		        		break;

		        	case 4:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
				        $du[1] = $donatorsTokens[1]['User']['username'];
				        $du[2] = $donatorsTokens[2]['User']['username'];
				        $du[3] = $donatorsTokens[3]['User']['username'];
		        		break;

		        	case 5:
		        		$du[0] = $donatorsTokens[0]['User']['username'];
				        $du[1] = $donatorsTokens[1]['User']['username'];
				        $du[2] = $donatorsTokens[2]['User']['username'];
				        $du[3] = $donatorsTokens[3]['User']['username'];
				        $du[4] = $donatorsTokens[4]['User']['username'];
		        		break;

		        	default:
		        		$du[0] = '';
		        		break;
		        }
		    }
		    
			$chartData = $dt;

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'donator_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des meilleurs donateurs',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => $du,
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();

	        $series->addName($site_money.' achetés')->addData($chartData);

	        $mychart->addSeries($series);
	        
	        $this->set(compact('chartName'));
	    }
	    else{
	    	throw new NotFoundException();
	    }
	}

	public function admin_shop_chart(){
		if($this->Auth->user('role') > 0){
			$chartName = 'shop_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsUn, 'shopHistory.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsDeux, 'shopHistory.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsTrois, 'shopHistory.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsQuatre, 'shopHistory.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsCinq, 'shopHistory.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsSix, 'shopHistory.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsSept, 'shopHistory.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsHuit, 'shopHistory.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsNeuf, 'shopHistory.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->shopHistory->find('count', ['conditions' => ['shopHistory.created >' => $countTodayMoinsDix, 'shopHistory.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'shop_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des achats boutiques',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Achats boutique')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_user_chart(){
		if($this->Auth->user('role') > 0){
			$chartName = 'user_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->User->find('count', ['conditions' => ['User.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsUn, 'User.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsDeux, 'User.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsTrois, 'User.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsQuatre, 'User.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsCinq, 'User.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsSix, 'User.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsSept, 'User.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsHuit, 'User.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsNeuf, 'User.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->User->find('count', ['conditions' => ['User.created >' => $countTodayMoinsDix, 'User.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'user_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des utilisateurs inscrits',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, '#FFFFFF'), array(1, '#FFFFFF')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Utilisateurs inscrits')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_paypal_chart(){
		if($this->Auth->user('role') > 0){
			$chartName = 'paypal_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsUn, 'paypalHistory.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsDeux, 'paypalHistory.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsTrois, 'paypalHistory.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsQuatre, 'paypalHistory.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsCinq, 'paypalHistory.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsSix, 'paypalHistory.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsSept, 'paypalHistory.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsHuit, 'paypalHistory.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsNeuf, 'paypalHistory.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.created >' => $countTodayMoinsDix, 'paypalHistory.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'paypal_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des achats PayPal',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Achats Paypal')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_starpass_chart(){
		if($this->Auth->user('role') > 0){
			$chartName = 'starpass_chart';
	        $mychart = $this->Highcharts->create($chartName, 'areaspline');

	        $today = 'Ajd';
			$todayMoinsUn = date('j/m', strtotime('-1 day'));
			$todayMoinsDeux = date('j/m', strtotime('-2 day'));
			$todayMoinsTrois = date('j/m', strtotime('-3 day'));
			$todayMoinsQuatre = date('j/m', strtotime('-4 day'));
			$todayMoinsCinq = date('j/m', strtotime('-5 day'));
			$todayMoinsSix = date('j/m', strtotime('-6 day'));
			$todayMoinsSept = date('j/m', strtotime('-7 day'));
			$todayMoinsHuit = date('j/m', strtotime('-8 day'));
			$todayMoinsNeuf = date('j/m', strtotime('-9 day'));
			$todayMoinsDix = date('j/m', strtotime('-10 day'));

			$countToday = date('Y-m-j').' 00:00:00';
			$countTodayMoinsUn = date('Y-m-j', strtotime('-1 day')).' 00:00:00';
			$countTodayMoinsDeux = date('Y-m-j', strtotime('-2 day')).' 00:00:00';
			$countTodayMoinsTrois = date('Y-m-j', strtotime('-3 day')).' 00:00:00';
			$countTodayMoinsQuatre = date('Y-m-j', strtotime('-4 day')).' 00:00:00';
			$countTodayMoinsCinq = date('Y-m-j', strtotime('-5 day')).' 00:00:00';
			$countTodayMoinsSix = date('Y-m-j', strtotime('-6 day')).' 00:00:00';
			$countTodayMoinsSept = date('Y-m-j', strtotime('-7 day')).' 00:00:00';
			$countTodayMoinsHuit = date('Y-m-j', strtotime('-8 day')).' 00:00:00';
			$countTodayMoinsNeuf = date('Y-m-j', strtotime('-9 day')).' 00:00:00';
			$countTodayMoinsDix = date('Y-m-j', strtotime('-10 day')).' 00:00:00';

			$achatsToday = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countToday]]);
			$achatsTodayMoinsUn = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsUn, 'starpassHistory.created <' => $countToday]]);
			$achatsTodayMoinsDeux = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsDeux, 'starpassHistory.created <' => $countTodayMoinsUn]]);
			$achatsTodayMoinsTrois = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsTrois, 'starpassHistory.created <' => $countTodayMoinsDeux]]);
			$achatsTodayMoinsQuatre = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsQuatre, 'starpassHistory.created <' => $countTodayMoinsTrois]]);
			$achatsTodayMoinsCinq = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsCinq, 'starpassHistory.created <' => $countTodayMoinsQuatre]]);
			$achatsTodayMoinsSix = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsSix, 'starpassHistory.created <' => $countTodayMoinsCinq]]);
			$achatsTodayMoinsSept = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsSept, 'starpassHistory.created <' => $countTodayMoinsSix]]);
			$achatsTodayMoinsHuit = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsHuit, 'starpassHistory.created <' => $countTodayMoinsSept]]);
			$achatsTodayMoinsNeuf = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsNeuf, 'starpassHistory.created <' => $countTodayMoinsHuit]]);
			$achatsTodayMoinsDix = $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.created >' => $countTodayMoinsDix, 'starpassHistory.created <' => $countTodayMoinsNeuf]]);

			$chartData = [$achatsTodayMoinsDix, $achatsTodayMoinsNeuf, $achatsTodayMoinsHuit, $achatsTodayMoinsSept, $achatsTodayMoinsSix, $achatsTodayMoinsCinq, $achatsTodayMoinsQuatre, $achatsTodayMoinsTrois, $achatsTodayMoinsDeux, $achatsTodayMoinsUn, $achatsToday];

	        $this->Highcharts->setChartParams($chartName, array(
	            'renderTo' => 'starpass_chart',
	            'chartWidth' => 1000,
	            'chartHeight' => 600,
	            'chartMarginTop' => 60,
	            'chartMarginLeft' => 90,
	            'chartMarginRight' => 30,
	            'chartMarginBottom' => 110,
	            'chartSpacingRight' => 10,
	            'chartSpacingBottom' => 15,
	            'chartSpacingLeft' => 0,
	            'chartAlignTicks' => FALSE,
	            'chartBackgroundColorLinearGradient' => array(255, 255, 255, 255),
	            'chartBackgroundColorStops' => array(array(0, 'rgb(255, 255, 255)'), array(1, 'rgb(255, 255, 255)')),
	            'title' => 'Graphique des achats Starpass',
	            'titleAlign' => 'center',
	            'titleFloating' => TRUE,
	            'titleStyleFont' => '18px Metrophobic, Arial, sans-serif',
	            'titleStyleColor' => '#606060',
	            'titleX' => 20,
	            'titleY' => 20,
	            'legendEnabled' => TRUE,
	            'legendLayout' => 'horizontal',
	            'legendAlign' => 'center',
	            'legendVerticalAlign ' => 'bottom',
	            'legendItemStyle' => array('color' => '#222'),
	            'legendBackgroundColorLinearGradient' => array(0, 0, 0, 25),
	            'legendBackgroundColorStops' => array(array(0, 'rgb(217, 217, 217)'), array(1, 'rgb(255, 255, 255)')),
	            'tooltipEnabled' => FALSE,
	            'xAxisLabelsEnabled' => TRUE,
	            'xAxisLabelsAlign' => 'right',
	            'xAxisLabelsStep' => 1,
	            'xAxislabelsX' => 5,
	            'xAxisLabelsY' => 20,
	            'xAxisCategories' => array($todayMoinsDix, $todayMoinsNeuf, $todayMoinsHuit, $todayMoinsSept, $todayMoinsSix, $todayMoinsCinq, $todayMoinsQuatre, $todayMoinsTrois, $todayMoinsDeux, $todayMoinsUn, $today),
	            'yAxisTitleText' => FALSE,
	            'enableAutoStep' => FALSE,
	            'creditsEnabled' => FALSE
	            )
	        );

	        $series = $this->Highcharts->addChartSeries();
	        $series->addName('Achats Starpass')->addData($chartData);
	        $mychart->addSeries($series);
	        $this->set(compact('chartName'));
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function display(){
		$path = func_get_args();

		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
}
