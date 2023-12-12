<?php

/**
 * MvcCore
 *
 * This source file is subject to the BSD 3 License
 * For the full copyright and license information, please view
 * the LICENSE.md file that are distributed with this source code.
 *
 * @copyright	Copyright (c) 2016 Tom Flidr (https://github.com/mvccore)
 * @license		https://mvccore.github.io/docs/mvccore/5.0.0/LICENSE.md
 */

namespace MvcCore\Ext\Debugs\Tracys;

/**
 * Responsibility - dump user instance if user is authenticated.
 */
class AuthPanel implements \Tracy\IBarPanel {

	/**
	 * MvcCore Extension - Debug - Tracy - Auth - version:
	 * Comparison by PHP function version_compare();
	 * @see http://php.net/manual/en/function.version-compare.php
	 */
	const VERSION = '5.2.0';

	/**
	 * Prepared view data, only once,
	 * to render debug tab and debug panel content.
	 * @var \stdClass|NULL
	 */
	protected $view = NULL;

	/**
	 * Debug code for this panel, printed at panel bottom.
	 * @var string
	 */
	private $_debugCode = '';


	/**
	 * Return unique panel id.
	 * @return string
	 */
	public function getId() {
		return 'auth-panel';
	}

	/**
	 * Render tab (panel header).
	 * Set up view data if necessary.
	 * @return string
	 */
	public function getTab() {
		$view = & $this->getViewData();
		$titleText = $view->authenticated ? 'Authenticated' : 'Not&nbsp;authenticated';
		$pathColor = $view->authenticated ? '#61A519' : '#ababab';
		return <<<SVG
<span title="{$titleText}">
	<svg viewBox="0 -50 2048 2048">
		<path fill="{$pathColor}" 
			d="m1615 1803.5c-122 17-246 7-369 8-255 1-510 3-765-1-136-2-266-111-273-250-11-192 11-290.5 
			115-457.5 62-100 192-191 303-147 110 44 201 130 321 149 160 25 317-39 446-130 82-58 200-9 
			268 51 157 173 186.8 275.49 184 484.49-1.9692 147.11-108.91 271.41-230 293zm-144-1226.5c0 
			239-208 447-447 447s-447-208-447-447 208-447 447-447c240 1 446 207 447 447z" />
	</svg>
</span>
SVG;
	}

	/**
	 * Render panel (panel content).
	 * Set up view data if necessary.
	 * @return string
	 */
	public function getPanel() {
		$view = & $this->getViewData();
		return implode('', [
			'<h1 style="word-wrap:normal;">' . ($view->authenticated ? 'Authenticated' : 'Not&nbsp;authenticated') . '</h1>',
			($view->authenticated 
				? \Tracy\Dumper::toHtml($view->user, [
					\Tracy\Dumper::COLLAPSE	=> FALSE,
					//\Tracy\Dumper::LIVE		=> TRUE,
				])
				: ('<p>' . ($view->identity !== null ? 'identity: ' . \Tracy\Dumper::toHtml($view->identity, [
					\Tracy\Dumper::COLLAPSE	=> FALSE,
					//\Tracy\Dumper::LIVE		=> TRUE,
				]) : 'no&nbsp;identity') . '</p>')),
			$this->_debugCode
		]);
	}

	/**
	 * Set up view data, if data are completed,
	 * return them directly.
	 * - complete basic \MvcCore core objects to complere other view data
	 * - complete user and authorized boolean
	 * - set result data into static field
	 * @return object
	 */
	public function & getViewData () {
		if ($this->view !== NULL) return $this->view;
		$auth = \MvcCore\Ext\Auths\Basic::GetInstance();
		$userClass = $auth->GetUserClass();
		$identitySession = $userClass::GetSessionIdentity();
		$identity = $identitySession instanceof \MvcCore\ISession
			? $identitySession->{\MvcCore\Ext\Auths\Basics\IUser::SESSION_USERNAME_KEY}
			: NULL;
		$user = $auth->GetUser();
		$authenticated = $user instanceof \MvcCore\Ext\Auths\Basics\IUser;
		$this->view = (object) [
			'identity'		=> $identity,
			'user'			=> $user,
			'authenticated'	=> $authenticated,
		];
		return $this->view;
	}

	
	/**
	 * Print any variable at panel bottom.
	 * @param  mixed $var
	 * @return void
	 */
	private function _debug ($var) {
		$this->_debugCode .= \Tracy\Dumper::toHtml($var, [
			\Tracy\Dumper::LIVE		=> TRUE,
			//\Tracy\Dumper::DEPTH	=> 5,
		]);
	}
}
