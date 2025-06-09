<?php

namespace DMK\T3rest\Legacy\Decorator;

use tx_rnbase;

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
 * @author Rene Nitzsche
 */
class SimpleDecorator extends BaseDecorator
{
    protected static $externals = [];
    private static $instance;

    /**
     * @overwrite
     */
    protected function getExternals()
    {
        return self::$externals;
    }

    protected function getDecoratorId()
    {
        return 'simple';
    }

    /**
     * @return SimpleDecorator
     */
    public static function getInstance()
    {
        if (is_object(self::$instance)) {
            self::$instance == tx_rnbase::makeInstance(SimpleDecorator::class);
        }

        return self::$instance;
    }
}
