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
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
class Style extends Rule
{
	/**
	 * The property name, e.a. <strong>color</strong> or <strong>border</strong>.
	 *
	 * @var string
	 */
	protected $property;

	/**
	 * The style value, e.a. <strong>#fff</strong> or <strong>1px solid black</strong>.
	 * @var string
	 */
	protected $value;

	public function __construct($property = '', $value = '')
	{
		parent::__construct();
		$this->property = $property;
		$this->value    = $value;
	}

	/**
	 * Set the property name.
	 *
	 * @param string $property
	 */
	public function setProperty($property)
	{
		$this->property = $property;
	}

	/**
	 * @return string
	 */
	public function getProperty()
	{
		return $this->property;
	}

	/**
	 * @param string $value
	 */
	public function setValue($value)
	{
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getValue()
	{
		return $this->value;
	}

	public function toCss($indent = '')
	{
		return sprintf('%s%s: %s;', $indent, $this->property, $this->value);
	}

	public function toLessCss($indent = '')
	{
		return $this->toCss($indent);
	}
}