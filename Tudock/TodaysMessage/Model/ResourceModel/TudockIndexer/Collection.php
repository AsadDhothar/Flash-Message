<?php

namespace Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'tudock_indexer_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Tudock\TodaysMessage\Model\TudockIndexer::class,
            \Tudock\TodaysMessage\Model\ResourceModel\TudockIndexer::class
        );
    }
}

