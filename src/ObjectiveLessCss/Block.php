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
 * A css block, is a special css rule like @media or style definitions.
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
abstract class Block extends Rule
{
	/**
	 * The rules in this stylesheet.
	 *
	 * @var RuleSet
	 */
	protected $rules;

	public function __construct()
	{
		parent::__construct();
		$this->rules = new RuleSet();
	}

	/**
	 * Get the children.
	 *
	 * @return array
	 */
	public function getRules()
	{
		return (array) $this->rules;
	}

	/**
	 * Add a child rule.
	 *
	 * @param Rule $child
	 */
	public function addRule(Rule $child)
	{
		if ($this->rules->add($child)) {
			$child->setParent($this);
		}
	}

	/**
	 * Remove a child rule.
	 *
	 * @param Rule $child
	 */
	public function removeRule(Rule $child)
	{
		if ($this->rules->remove($child)) {
			$child->setParent(null);
		}
	}
}
