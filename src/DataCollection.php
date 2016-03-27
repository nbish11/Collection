<?php

/**
 * Object wrapper for PHP arrays.
 *
 * PHP version 5
 *
 * Copyright (C) 2013  Nathan Bishop
 *
 * LICENSE: This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package    NULL
 * @author     Nathan Bishop <nbish11@hotmail.com>
 * @version    0.0.1
 * @copyright  2013 Nathan Bishop
 * @license    GPLv2
 * @link       https://github.com/nbish11/Collection
 */

class DataCollection implements Collection
{
    /**
     * Holds all the items/values in the collection.
     *
     * @var array $collection
     */
    private $collection;

    /**
     * Constructor
     *
     * @param array $data
     *
     * @return \DataCollection
     */
    public function __construct(array $data = array())
    {
        $this->collection = $data;
    }

    /**
     * @see \Collection::add()
     */
    public function add($value)
    {
        $this->collection[] = $value;

        return $this;
    }

    /**
     * @see \Collection::set()
     */
    public function set($key, $value)
    {
        $this->collection[$key] = $value;

        return $this;
    }

    /**
     * @see \Collection::get()
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->collection)) {
            return $this->collection[$key];
        }

        return $default;
    }

    /**
     * @see \Collection::exists()
     */
    public function exists($key)
    {
        return array_key_exists($key, $this->collection);
    }

    /**
     * @see \Collection::remove()
     */
    public function remove($key)
    {
        if (array_key_exists($key, $this->collection)) {
            unset($this->collection[$key]);
        }

        return $this;
    }

    /**
     * @see \Collection::all()
     */
    public function all()
    {
        return $this->collection;
    }

    /**
     * @see \Collection::merge()
     */
    public function merge(array $data)
    {
        $this->collection = array_replace_recursive($this->collection, $data);

        return $this;
    }

    /**
     * @see \Collection::replace()
     */
    public function replace(array $data)
    {
        $this->collection = $data;

        return $this;
    }

    /**
     * @see \Collection::clear()
     */
    public function clear()
    {
        $this->collection = array();

        return $this;
    }

    /**
     * @see \Collection::index()
     */
    public function index($value)
    {
        return array_search($value, $this->collection, true);
    }

    /**
     * @see \Collection::keys()
     */
    public function keys()
    {
        return array_keys($this->collection);
    }

    /**
     * @see \Collection::values()
     */
    public function values()
    {
        return array_values($this->collection);
    }

    /**
     * Maps a user defined function to each item within the collection.
     *
     * @param Closure $callback
     *
     * @return \DataCollection
     */
    public function map(Closure $callback, $userdata = null)
    {
        array_walk_recursive($this->collection, $callback, $userdata);

        return $this;
    }

    /**
     * @see \Collection::isEmpty()
     */
    public function isEmpty()
    {
        return empty($this->collection);
    }

    /**
     * @see \Collection::hasKey()
     */
    public function hasKey($value)
    {
        return is_int(array_search($value, $this->collection, true)) ? false : true;
    }

    /**
     * Dynamically retrieves an item from the collection.
     *
     * @see \DataCollection::get()
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Dynamically adds an item with the specified key to the collection.
     *
     * @see \DataCollection::set()
     */
    public function __set($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Dynamically checks if an item exists within the collection.
     *
     * @see \DataCollection::exists()
     *
     * @return void
     */
    public function __isset($key)
    {
        return $this->exists($key);
    }

    /**
     * Dynamically removes an item from the collection.
     *
     * @see \DataCollection::remove()
     *
     * @return void
     */
    public function __unset($key)
    {
        $this->remove($key);
    }

    /**
     * Creates a new iterator.
     *
     * @see \ArrayObject::getIterator()
     */
    public function getIterator()
    {
        return new ArrayIterator($this->collection);
    }

    /**
     * Arbitrarily fetches an item using array syntax.
     *
     * @see \DataCollection::get()
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * Arbitrarily adds an item to the collection using array syntax.
     *
     * @see \DataCollection::set()
     *
     * @return void
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * Arbitrarily checks if the item exists within the collection using array syntax.
     *
     * @see \DataCollection::exists()
     */
    public function offsetExists($key)
    {
        return $this->exists($key);
    }

    /**
     * Arbitrarily removes an item from the collection using array syntax.
     *
     * @see \DataCollection::remove()
     *
     * @return void
     */
    public function offsetUnset($key)
    {
        $this->remove($key);
    }

    /**
     * The number of items in the collection.
     *
     * @see \Countable::count()
     */
    public function count()
    {
        return count($this->collection);
    }
}
