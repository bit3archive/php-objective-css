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
 * A stylesheet.
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
class Stylesheet extends Block
{
	/**
	 * The rules in this stylesheet.
	 *
	 * @var RuleSet
	 */
	protected $rules;

	public function __construct()
	{
		$this->rules = new RuleSet();
	}

	public function toCss($indent = '')
	{
		$buffer = '';

		foreach ($this->rules as $rule) {
			$buffer .= $rule->toCss($indent) . "\n";
		}

		return $buffer;
	}

	public function toLessCss($indent = '')
	{
		$buffer = '';

		foreach ($this->rules as $rule) {
			$buffer .= $rule->toLessCss($indent) . "\n";
		}

		return $buffer;
	}
}
