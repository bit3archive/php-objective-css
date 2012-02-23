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
 * The objective less css parser.
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
class Import extends Rule
{
	protected $uri;

	public function setUri($uri)
	{
		$this->uri = $uri;
	}

	public function getUri()
	{
		return $this->uri;
	}

	public function toCss($indent = '')
	{
		return sprintf('%s@import "%s";', $indent, $this->uri);
	}

	public function toLessCss($indent = '')
	{
		return $this->toCss($indent);
	}
}
