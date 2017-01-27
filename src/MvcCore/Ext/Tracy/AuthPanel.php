<?php

/**
 * MvcCore
 *
 * This source file is subject to the BSD 3 License
 * For the full copyright and license information, please view
 * the LICENSE.md file that are distributed with this source code.
 *
 * @copyright	Copyright (c) 2016 Tom Flídr (https://github.com/mvccore/mvccore)
 * @license		https://mvccore.github.io/docs/mvccore/4.0.0/LICENCE.md
 */

namespace MvcCore\Ext\Debug\Tracy;

class AuthPanel implements \Tracy\IBarPanel {
	/**
	 * MvcCore Extension - Debug - Tracy Panel - Auth - version:
	 * Comparation by PHP function version_compare();
	 * @see http://php.net/manual/en/function.version-compare.php
	 */
	const VERSION = '4.0.0';
	/**
	 * Debug panel id
	 * @var string
	 */
	public static $Id = 'auth-panel';
	/**
	 * Prepared view data, only once,
	 * to render debug tab and debug panel content.
	 * @var \stdClass
	 */
	protected static $viewData = NULL;
	/**
	 * Return unique panel id.
	 * @return string
	 */
	public function getId() {
		return self::$Id;
	}
	/**
	 * Render tab (panel header).
	 * Set up view data if necessary.
	 * @return string
	 */
	public function getTab() {
		$view = self::setUpViewData();
		return '<span title="' . ($view->authorized ? 'Authorized' : 'Not authorized') . '">'
			.'<svg viewBox="0 -50 2048 2048">'
				.'<path fill="' . ($view->authorized ? '#61A519' : '#ababab') . '" '
					.'d="m1615 1803.5c-122 17-246 7-369 8-255 1-510 3-765-1-136-2-266-111-273-250-11-192 11-290.5 '
					.'115-457.5 62-100 192-191 303-147 110 44 201 130 321 149 160 25 317-39 446-130 82-58 200-9 '
					.'268 51 157 173 186.8 275.49 184 484.49-1.9692 147.11-108.91 271.41-230 293zm-144-1226.5c0 '
					.'239-208 447-447 447s-447-208-447-447 208-447 447-447c240 1 446 207 447 447z" />'
			.'</svg>'
		.'</span>';
	}
	/**
	 * Render panel (panel content).
	 * Set up view data if necessary.
	 * @return string
	 */
	public function getPanel() {
		$view = self::setUpViewData();
		return '<h1>' . ($view->authorized ? 'Authorized' : 'Not authorized') . '</h1>'
			. ($view->authorized ? \Tracy\Dumper::toHtml($view->user, array(
				\Tracy\Dumper::LIVE => TRUE,
			)) : '<p>no identity</p>');
	}
	/**
	 * Set up view data, if data are completed,
	 * return them directly.
	 * - complete basic \MvcCore core objects to complere other view data
	 * - complete user and authorized boolean
	 * - set result data into static field
	 * @return object
	 */
	public static function setUpViewData () {
		if (static::$viewData) return static::$viewData;

		$user = \MvcCore\Ext\Auth::GetInstance()->GetUser();
		$authorized = $user instanceof \MvcCore\Ext\Auth\User;

		static::$viewData = (object) array(
			'user'		=> $user,
			'authorized'=> $authorized,
		);

		return static::$viewData;
	}
}