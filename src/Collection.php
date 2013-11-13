<?php

/**
 * An interface defined for custom collections.
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

interface Collection extends IteratorAggregate, ArrayAccess, Countable
{
    /**
     * Adds an item to the collection without a specified key.
     * 
     * @param mixed $value 
     * 
     * @return \Collection
     */
    public function add($value);
    
    /**
     * Adds an item to the collection with a specified key.
     * 
     * @param string $key 
     * @param mixed  $value 
     * 
     * @return \Collection
     */
    public function set($key, $value);
    
    /**
     * Retrieves an item from the collection using the specified key.
     * 
     * @param string $key 
     * @param mixed  $default  If item was not found, return a default value instead.
     * 
     * @return mixed
     */
    public function get($key, $default);
    
    /**
     * Checks if an item exists in the collection.
     * 
     * @param string $key 
     * 
     * @return boolean
     */
    public function exists($key);
    
    /**
     * Remove an item from the collection.
     * 
     * @param string $key 
     * 
     * @return \Collection
     */
    public function remove($key);
    
    /**
     * Return the collection as an array.
     * 
     * 
     * @return array
     */
    public function all();
    
    /**
     * Merges an array in with the collection (replaces items with matching keys).
     * 
     * @param array $data 
     * 
     * @return \Collection
     */
    public function merge(array $data);
    
    /**
     * Replace the collection with an array (or collection).
     * 
     * @param array $data 
     * 
     * @return \Collection
     */
    public function replace(array $data);
    
    /**
     * Clears the entire collection.
     * 
     * 
     * @return \Collection
     */
    public function clear();
    
    /**
     * Returns the key/index of an item within the collection.
     * 
     * @param mixed $value 
     * 
     * @return string
     */
    public function index($value);
    
    /**
     * Returns all the keys in the collection.
     * 
     * @param boolean $strict  Use the strict comparison operator (===).
     * 
     * @return array
     */
    public function keys($strict);
    
    /**
     * Return all items within the collection.
     * 
     * 
     * @return array
     */
    public function values();
    
    /**
     * Whether or not the collection is empty.
     * 
     * 
     * @return boolean
     */
    public function isEmpty();
    
    /**
     * Whether or not the item has a named key.
     * 
     * @param mixed $value 
     * 
     * @return boolean
     */
    public function hasKey($value);
}
