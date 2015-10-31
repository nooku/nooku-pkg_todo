<?php
/**
 * Nooku Platform - http://www.nooku.org/platform
 *
 * @copyright	Copyright (C) 2011 - 2014 Johan Janssens and Timble CVBA. (http://www.timble.net)
 * @license		GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link		https://github.com/nooku/nooku-platform for the canonical source repository
 */

/**
 * Tags Model
 *
 * @author  Johan Janssens <http://github.com/johanjanssens>
 * @package Nooku\Component\Tags
 */
 class ComTodoModelTags extends KModelDatabase
 {
		public function __construct(KObjectConfig $config)
		{
				parent::__construct($config);

				// Set the state
				$this->getState()
		         ->insert('row', 'int')
		         ->insert('table', 'string', $this->getIdentifier()->package);
		}

		protected function _buildQueryColumns(KDatabaseQueryInterface $query)
		{
		      parent::_buildQueryColumns($query);

		      $query->columns(array(
		          'count' => 'COUNT( relations.tags_tag_id )'
		      ));
		}

		protected function _buildQueryGroup(KDatabaseQueryInterface $query)
		{
		      $query->group('tbl.tags_tag_id');
		}

		protected function _buildQueryJoins(KDatabaseQueryInterface $query)
		{
		      parent::_buildQueryJoins($query);

		      $query->join(array('relations' => 'todo_tags_relations'), 'relations.tags_tag_id = tbl.tags_tag_id');
		}

		protected function _buildQueryWhere(KDatabaseQueryInterface $query)
		{
		      $state = $this->getState();

		      if($this->getState()->row) {
		          $query->where('relations.row IN :row')->bind(array('row' => (array) $this->getState()->row));
		      }

		      if($this->getState()->table) {
		          $query->where('tbl.table = :table')->bind(array('table' => $this->getState()->table));
		      }

		      parent::_buildQueryWhere($query);
		}
}