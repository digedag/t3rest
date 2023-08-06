<?php

namespace DMK\T3rest\Legacy\Search;

use DMK\T3rest\Legacy\Model\GenericModel;
use Sys25\RnBase\Database\Query\Join;
use Sys25\RnBase\Utility\Misc;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Rene Nitzsche
 *  Contact: rene@system25.de
 *  All rights reserved
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 ***************************************************************/

/**
 * REST provider for tt_news.
 *
 * @author Rene Nitzsche
 */
class NewsSearch extends \Sys25\RnBase\Search\SearchBase
{
    protected function getTableMappings()
    {
        $tableMapping['NEWS'] = 'tx_news_domain_model_news';
        $tableMapping['RELATEDNEWSMM'] = 'tx_news_domain_model_news_related_mm';
        $tableMapping['RELATEDNEWS'] = 'tx_news_domain_model_news';
        $tableMapping['NEWSCATMM'] = 'sys_category_record_mm';

        // Hook to append other tables
        Misc::callHook(
            't3rest',
            'search_news_getTableMapping_hook',
            ['tableMapping' => &$tableMapping],
            $this
        );

        return $tableMapping;
    }

    protected function useAlias()
    {
        return true;
    }

    protected function getBaseTableAlias()
    {
        return 'NEWS';
    }

    protected function getBaseTable()
    {
        return 'tx_news_domain_model_news';
    }

    public function getWrapperClass()
    {
        return GenericModel::class;
    }

    protected function getJoins($tableAliases)
    {
        $join = [];

        if (isset($tableAliases['NEWSCATMM'])) {
            $join[] = new Join('NEWS', 'sys_category_record_mm', 'NEWS.uid = NEWSCATMM.uid_foreign AND NEWSCATMM.tablenames=\'tx_news_domain_model_news\' AND NEWSCATMM.fieldname=\'categories\'', 'NEWSCATMM');
//            $join .= ' JOIN tt_news_cat_mm AS NEWSCATMM ON NEWS.uid = NEWSCATMM.uid_local';
        }
        // TODO: Check visibility of related news.
        // if (isset($tableAliases['RELATEDNEWSMM']) || (isset($tableAliases['RELATEDNEWS']))) {
        //     $join .= ' LEFT JOIN tt_news_related_mm AS RELATEDNEWSMM ON (RELATEDNEWSMM.uid_foreign = NEWS.uid AND RELATEDNEWSMM.tablenames="tt_news")';
        // }
        // if (isset($tableAliases['RELATEDNEWS'])) {
        //     $join .= ' JOIN tt_news AS RELATEDNEWS ON RELATEDNEWS.uid = RELATEDNEWSMM.uid_local';
        // }

        // Hook to append other tables
        Misc::callHook(
            't3rest',
            'search_news_getJoins_hook',
            ['join' => &$join, 'tableAliases' => $tableAliases],
            $this
        );

        return $join;
    }
}
