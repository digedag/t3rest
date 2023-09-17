<?php

namespace DMK\T3rest\Legacy\Decorator;

use DMK\T3rest\Legacy\Utility\FALUtil;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012-2023 Rene Nitzsche
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
 * Sammelt zusätzliche Daten.
 *
 * @author Rene Nitzsche
 */
class NewsDecorator extends BaseDecorator
{
    protected static $externals = ['dampictures', 'categories'];

    protected function addDampictures($item, $configurations, $confId)
    {
        $pics = FALUtil::getFalPictures($item->getUid(), 'tx_news_domain_model_news', 'fal_media', $configurations, $confId);
        $item->setProperty('dampictures', $pics);
    }

    protected function addCategories($item)
    {
        $from = ['sys_category As NEWSCAT JOIN sys_category_record_mm AS NEWSCATMM ON NEWSCATMM.uid_local = NEWSCAT.UID',
                'sys_category', 'NEWSCAT', ];
        $options['where'] = 'NEWSCATMM.uid_foreign = '.$item->getUid();
        $item->setProperty(
            'categories',
            \Sys25\RnBase\Database\Connection::getInstance()->doSelect('uid,title,\'\' as image', $from, $options)
        );
    }

    /**
     * @overwrite
     */
    protected function getExternals()
    {
        return self::$externals;
    }

    protected function getDecoratorId()
    {
        return 'news';
    }

    protected function handleItemBefore($item, $configurations, $confId)
    {
    }

    protected function handleItemAfter($item, $configurations, $confId)
    {
    }
}
