<?php

namespace Tudock\TodaysMessage\Model\ResourceModel;

class TudockIndexer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('tudock_todaysmessage_tudock_indexer', 'tudock_indexer_id');
    }
}

