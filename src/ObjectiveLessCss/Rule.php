<?php

/**
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 */

namespace ObjectiveLessCss;

/**
 * A css rule is a rule, this can be an @-rule or a block.
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
abstract class Rule
{
	/**
	 * The block, this rule is defined in.
	 *
	 * @var \ObjectiveLessCss\Block
	 */
	protected $parent;

	public function __construct()
	{
		$this->parent = null;
	}

	/**
	 * Set the parent block.
	 *
	 * @param \ObjectiveLessCss\Block $parent
	 */
	public function setParent(\ObjectiveLessCss\Block $parent)
	{
		if ($this->parent != $parent) {
			$oldParent = $this->parent;
			$this->parent = null; // do not remove or endless recursion will happen!
			if ($oldParent) {
				$oldParent->removeRule($this);
			}
			$this->parent = $parent;
		}
	}

	/**
	 * Get the parent block.
	 *
	 * @return \ObjectiveLessCss\Block
	 */
	public function getParent()
	{
		return $this->parent;
	}

	public abstract function toCss($indent = '');

	public abstract function toLessCss($indent = '');
}
