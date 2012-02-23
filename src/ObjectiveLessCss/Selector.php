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
 * A single selector.
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
class Selector
{
	/**
	 * @var Styles
	 */
	protected $parent;

	/**
	 * @var string
	 */
	protected $selector;

	public function __construct($selector = '', Styles $parent = null)
	{
		$this->setSelector($selector);
		$this->setParent($parent);
	}

	/**
	 * @param \ObjectiveLessCss\Styles $parent
	 */
	public function setParent($parent)
	{
		if ($this->parent != $parent) {
			$oldParent = $this->parent;
			$this->parent = null; // do not remove or endless recursion will happen!
			if ($oldParent) {
				$oldParent->removeSelector($this);
			}
			$this->parent = $parent;
			$this->parent->addSelector($this);
		}
	}

	/**
	 * @return \ObjectiveLessCss\Styles
	 */
	public function getParent()
	{
		return $this->parent;
	}

	/**
	 * @param string $selector
	 */
	public function setSelector($selector)
	{
		$this->selector = trim($selector);
	}

	/**
	 * @return string
	 */
	public function getSelector()
	{
		return $this->selector;
	}

	/**
	 * @return SelectorSet
	 */
	public function expand()
	{
		$set = new SelectorSet();
		if ($this->parent && $this->parent->getParent() instanceof Styles) {
			/** @var Styles $pparent */
			$pparent = $this->parent->getParent();
			$parentset = $pparent->getSelectors()->expand();
			/** @var Selector $parentselector */
			foreach ($parentset as $parentselector) {
				$set->add(new Selector($parentselector->getSelector() . ' ' . $this->getSelector()));
			}
		} else {
			$set->add($this);
		}
		return $set;
	}

	public function toCss($indent = '')
	{
		$buffer = '';
		$set = $this->expand();
		foreach ($set as $selector) {
			if ($buffer) {
				$buffer .= ",\n";
			}
			$buffer .= $indent . $selector->getSelector();
		}
		return $buffer;
	}

	public function toLessCss($indent = '')
	{
		return $indent . $this->selector;
	}
}
