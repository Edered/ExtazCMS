<?php
class PlayersController extends AppController{

	public $uses = ['Informations', 'User', 'shopHistory', 'starpassHistory', 'paypalHistory'];

	public function admin_index(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_console(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}
	public function admin_pbanip(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}
	public function admin_banplayer(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}
	public function admin_gradeall(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}
	public function admin_gserveur(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}
	public function admin_offline(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}
	public function admin_serveur(){
		if($this->Auth->user('role') > 0){

		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_whois($username){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
	    	$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
			if($api->call('players.name', [$username])[0]['result'] == 'success'){
				if($this->User->find('first', ['conditions' => ['User.username' => $username]])){
					$player = $this->User->find('first', ['conditions' => ['User.username' => $username]]);
					$playerId = $player['User']['id'];
					$this->set('player', $this->User->find('first', ['conditions' => ['User.username' => $username]]));
					$this->set('achatsBoutique', $this->shopHistory->find('count', ['conditions' => ['shopHistory.username' => $username]]));
					$this->set('achatsStarpass', $this->starpassHistory->find('count', ['conditions' => ['starpassHistory.username' => $username]]));
					$this->set('achatsPaypal', $this->paypalHistory->find('count', ['conditions' => ['paypalHistory.custom' => $playerId]]));
				}
				else{
					$this->Session->setFlash('Ce joueur n\'est pas inscrit sur le site !', 'error');
					return $this->redirect(['controller' => 'players', 'action' => 'index', 'admin' => true]);
				}
			}
			else{
				$this->Session->setFlash('Ce joueur n\'existe pas ou n\'est pas connecté', 'error');
				return $this->redirect(['controller' => 'players', 'action' => 'index', 'admin' => true]);
			}
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_kick($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('players.name.kick', [$username, 'Vous avez été kické'])){
	    		$this->Session->setFlash($username.' a été kické du serveur !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_clear($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['clear '.$username])){
	    		$this->Session->setFlash('L\'inventaire de '.$username.' a été supprimé !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_ban($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['ban '.$username.' Vous avez été banni'])){
	    		$this->Session->setFlash($username.' a été banni du serveur !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_banip($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['banip '.$username])){
	    		$this->Session->setFlash($username.' a été ban IP du serveur !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_op($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('players.name.op', [$username])){
	    		$this->Session->setFlash($username.' a été OP ! !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_deop($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('players.name.deop', [$username])){
	    		$this->Session->setFlash($username.' a été DE-OP ! !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
	    }
		else{
			throw new NotFoundException();
		}
	}

	public function admin_gmon($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['gm 1 '.$username])){
	    		$this->Session->setFlash('Le joueur '.$username.' : GM ON !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_gmoff($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['gm 0 '.$username])){
	    		$this->Session->setFlash('Le joueur '.$username.' : GM OFF !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_unban($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('players.name.pardon', [$username])){
	    		$this->Session->setFlash($username.' a été débanni du serveur !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_unbanip($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('players.pardon_ip', [$username])){
	    		$this->Session->setFlash($username.' a été débanni du serveur !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_peaceful($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set difficulty 0 '.$username])){
	    		$this->Session->setFlash($username.' mis en Peaceful !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_easy($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set difficulty 1 '.$username])){
	    		$this->Session->setFlash($username.' mis en easy !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_normal($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set difficulty 2 '.$username])){
	    		$this->Session->setFlash($username.' mis en normal !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_hard($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set difficulty 3 '.$username])){
	    		$this->Session->setFlash($username.' mis en Hard !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_pvpon($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set pvp true '.$username])){
	    		$this->Session->setFlash($username.' : PVP ON !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_pvpoff($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set pvp false '.$username])){
	    		$this->Session->setFlash($username.' : PVP OFF !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_foudre($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['lightning '.$username])){
	    		$this->Session->setFlash($username.' : Foudroyer !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_pluieoff($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set weather sun '.$username])){
	    		$this->Session->setFlash($username.' : Pluie OFF !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}

	public function admin_pluieon($username = null){
		if($this->Auth->user('role') > 0){
			$informations = $this->Informations->find('first');
    		$api = new JSONAPI($informations['Informations']['jsonapi_ip'], $informations['Informations']['jsonapi_port'], $informations['Informations']['jsonapi_username'], $informations['Informations']['jsonapi_password'], $informations['Informations']['jsonapi_salt']);
    		if($api->call('server.run_command', ['mvm set weather rain '.$username])){
	    		$this->Session->setFlash($username.' : Pluie ON !', 'success');
	    		return $this->redirect($this->referer());
	    	}
	    	else{
	    		$this->Session->setFlash('Erreur', 'error');
	    		return $this->redirect($this->referer());
	    	}
		}
		else{
			throw new NotFoundException();
		}
	}
}