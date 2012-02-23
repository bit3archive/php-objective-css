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
 * An Set based on a native array.
 *
 * @copyright  InfinitySoft 2010,2011
 * @author     Tristan Lins <tristan.lins@infinitysoft.de>
 * @package    ObjectiveLessCss
 * @license    LGPL
 * @filesource
 */
abstract class ArraySet implements \ArrayAccess, \IteratorAggregate
{
	protected $array;

	public function __construct(array $array = array())
	{
		$this->array = $array;
	}

	public function add($item)
	{
		if ($this->contains($item)) {
			return false;
		}

		$this->array[] = $item;
		return true;
	}

	public function addAll(ArraySet $set)
	{
		$addedAll = true;
		foreach ($set as $item) {
			if (!$this->add($item)) {
				$addedAll = false;
			}
		}
		return $addedAll;
	}

	public function remove($item)
	{
		$index = $this->indexOf($item);
		if ($index !== false) {
			$this->offsetUnset($index);
			return true;
		}
		return false;
	}

	public function contains($item)
	{
		return $this->indexOf($item) !== false;
	}

	public function indexOf($item)
	{
		foreach ($this->array as $k=>$v)
		{
			if ($item == $v) {
				return $k;
			}
		}
		return false;
	}

	public function toArray()
	{
		return $this->array;
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Whether a offset exists
	 * @link http://php.net/manual/en/arrayaccess.offsetexists.php
	 *
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 *
	 * @return boolean Returns true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 */
	public function offsetExists($offset)
	{
		return isset($this->array[$offset]);
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Offset to retrieve
	 * @link http://php.net/manual/en/arrayaccess.offsetget.php
	 *
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 *
	 * @return mixed Can return all value types.
	 */
	public function offsetGet($offset)
	{
		return $this->array[$offset];
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Offset to set
	 * @link http://php.net/manual/en/arrayaccess.offsetset.php
	 *
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 *
	 * @return void
	 */
	public function offsetSet($offset, $value)
	{
		$this->array[$offset] = $value;
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Offset to unset
	 * @link http://php.net/manual/en/arrayaccess.offsetunset.php
	 *
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 *
	 * @return void
	 */
	public function offsetUnset($offset)
	{
		unset($this->array[$offset]);
		$this->array = array_values($this->array);
	}

	/**
	 * (PHP 5 &gt;= 5.1.0)<br/>
	 * Retrieve an external iterator
	 * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
	 * @return Traversable An instance of an object implementing Iterator or
	 * Traversable
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->array);
	}
}
