<?
/**
 * Todo - a Joomla example extension built with Nooku Framework.
 *
 * @package     Todo
 * @copyright   Copyright (C) 2011 - 2014 Timble CVBA. (http://www.timble.net)
 * @license     GNU GPLv3 <http://www.gnu.org/licenses/gpl.html>
 * @link        https://github.com/joomlatools/joomlatools-todo for the canonical source repository
 */

defined('KOOWA') or die; ?>


<?= helper('behavior.ui'); ?>


<!-- Overview -->
<div class="k-overview">

    <!-- Form -->
    <form id="k-offcanvas-container" action="" method="get" class="k-content-wrapper -koowa-grid">

        <!-- Sidebar -->
        <div id="k-sidebar" class="k-sidebar">

            <!-- Navigation -->
            <div class="k-sidebar__navigation">
                <ktml:toolbar type="menubar">
            </div>

            <!-- Filters -->
            <div class="k-sidebar__item">
                <div class="k-sidebar__header">
                    <?= translate('Quick filters:'); ?>
                </div>
                <div class="k-sidebar__content">
                    <ul class="k-list">
                        <li class="<?= is_null(parameters()->created_by) && parameters()->sort != 'sort' && parameters()->direction != 'desc' ? 'active' : ''; ?>">
                            <a href="<?= route('created_by=&sort=&direction=') ?>">
                                <span class="k-icon-list"></span>
                                <?= translate('All tasks'); ?>
                            </a>
                        </li>
                        <li class="<?= parameters()->created_by ? 'active' : ''; ?>">
                            <a href="<?= route('created_by='.object('user')->getId().'&sort=&direction=') ?>">
                                <span class="k-icon-person"></span>
                                <?= translate('My tasks'); ?>
                            </a>
                        </li>
                        <li class="<?= parameters()->sort == 'last_modified_on' && parameters()->direction == 'desc' ? 'active' : ''; ?>">
                            <a href="<?= route('sort=last_modified_on&direction=desc&created_by=') ?>">
                                <span class="k-icon-clock"></span>
                                <?= translate('Recently edited'); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div><!-- .k-sidebar -->

        <!-- Content -->
        <div class="k-content">

            <!-- Toolbar -->
            <div class="k-toolbar">
                <div class="koowa-toolbar">
                    <ktml:toolbar type="actionbar" icon="task icon-stack">
                </div>
            </div><!-- .k-toolbar -->

            <!-- Component -->
            <div class="k-component">

                <!-- Scopebar -->
                <?= import('default_scopebar.html'); ?>

                <!-- Table -->
                <div class="k-table-container">
                    <div class="k-table">
                        <table class="table--fixed footable">
                            <thead>
                                <tr>
                                    <th width="1">
                                        <?= helper('grid.checkall')?>
                                    </th>
                                    <th data-toggle="true">
                                        <?= helper('grid.sort', array('column' => 'title', 'title' => 'Title')); ?>
                                    </th>
                                    <th width="5%" data-hide="phone,tablet">
                                        <?= helper('grid.sort', array('column' => 'enabled', 'title' => 'Status')); ?>
                                    </th>
                                    <th width="5%" data-hide="phone,tablet">
                                        <?= helper('grid.sort', array('column' => 'created_by', 'title' => 'Owner')); ?>
                                    </th>
                                    <th width="5%" data-hide="phone,tablet">
                                        <?= helper('grid.sort', array('column' => 'last_modified_on', 'title' => 'Last modified')); ?>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <? foreach ($tasks as $task): ?>
                                <tr>
                                    <td>
                                        <?= helper('grid.checkbox', array('entity' => $task)) ?>
                                    </td>
                                    <td>
                                        <a href="<?= route('view=task&id='.$task->id); ?>">
                                            <?= escape($task->title); ?></a>
                                    </td>
                                    <td class="k-nowrap">
                                        <?= helper('grid.publish', array('entity' => $task, 'clickable' => true)) ?>
                                    </td>
                                    <td class="k-nowrap">
                                        <?= escape($task->getAuthor()->getName()); ?>
                                    </td>
                                    <td class="k-nowrap">
                                        <?= helper('date.format', array('date' => $task->last_modified_on)); ?>
                                    </td>
                                </tr>
                            <? endforeach; ?>
                            <? if (!count($tasks)) : ?>
                                <tr>
                                    <td colspan="9">
                                        <?= translate('No tasks found.') ?>
                                    </td>
                                </tr>
                            <? endif; ?>
                            </tbody>
                        </table>

                    </div><!-- .k-table -->

                    <? if (count($tasks)): ?>
                    <div class="k-table-pagination">
                        <?= helper('paginator.pagination') ?>
                    </div><!-- .k-table-pagination -->
                    <? endif; ?>

                </div><!-- .k-table-container -->

            </div><!-- .k-component -->

        </div><!-- k-content -->

    </form><!-- .k-content-wrapper -->

</div><!-- .k-overview -->