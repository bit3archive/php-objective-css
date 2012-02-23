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
class Parser
{
	public function __construct()
	{

	}

	/**
	 * Parse the css code.
	 *
	 * @param string $css
	 */
	public function parse($css)
	{

	}

	/**
	 * Parse the css file.
	 *
	 * @param string $file
	 */
	public function parseFile($file)
	{
		return $this->parse(file_get_contents($file));
	}

	/**
	 * Parse the css stream.
	 *
	 * @param resource $stream
	 */
	public function parseStream($stream)
	{
		return $this->parse(stream_get_contents($stream));
	}
}
