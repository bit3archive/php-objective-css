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
 * A style definition block.
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
class Styles extends Block
{
	/**
	 * The selectors for this block.
	 *
	 * @var SelectorSet
	 */
	protected $selectors;

	public function __construct(SelectorSet $selectors = null, RuleSet $rules = null)
	{
		parent::__construct();
		$this->selectors = new SelectorSet();
		if ($selectors) {
			foreach ($selectors as $selector) {
				$this->addSelector($selector);
			}
		}
		if ($rules) {
			foreach ($rules as $rule) {
				$this->addRule($rule);
			}
		}
	}

	public function getSelectors()
	{
		return $this->selectors;
	}

	public function addSelector(Selector $selector)
	{
		if ($this->selectors->add($selector)) {
			$selector->setParent($this);
		}
	}

	public function removeSelector(Selector $selector)
	{
		if ($this->selectors->remove($selector)) {
			$selector->setParent(null);
		}
	}

	public function toCss($indent = '')
	{
		$styles = new RuleSet();
		$styleblocks = new RuleSet();
		$others = new RuleSet();

		foreach ($this->rules as $rule) {
			if ($rule instanceof Style) {
				$styles->add($rule);
			} else if ($rule instanceof Styles) {
				$styleblocks->add($rule);
			} else {
				$others->add($rule);
			}
		}

		$buffer = '';
		/** @var Selector $selector */
		foreach ($this->selectors as $selector) {
			if ($buffer) {
				$buffer .= ",\n";
			}
			$buffer .= $selector->toCss($indent);
		}
		$buffer .= " {\n";
		foreach ($others as $rule) {
			$buffer .= $rule->toCss($indent . "\t") . "\n";
		}

		/** @var Style $style */
		foreach ($styles as $style) {
			$buffer .= $style->toCss($indent . "\t") . "\n";
		}
		$buffer .= $indent . "}\n";

		foreach ($styleblocks as $block) {
			$buffer .= $block->toCss($indent) . "\n";
		}
		return $buffer;
	}

	public function toLessCss($indent = '')
	{

		$buffer = '';
		/** @var Selector $selector */
		foreach ($this->selectors as $selector) {
			if ($buffer) {
				$buffer .= ",\n";
			}
			$buffer .= $selector->toLessCss($indent);
		}
		$buffer .= " {\n";
		/** @var Rule $rule */
		foreach ($this->rules as $rule) {
			$buffer .= $rule->toLessCss($indent . "\t") . "\n";
		}
		$buffer .= $indent . "}\n";
		return $buffer;
	}
}
