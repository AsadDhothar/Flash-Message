<?php

namespace Tudock\TodaysMessage\Model\Data;

use Tudock\TodaysMessage\Api\Data\TudockIndexerInterface;

class TudockIndexer extends \Magento\Framework\Api\AbstractExtensibleObject implements TudockIndexerInterface
{

    /**
     * Get tudock_indexer_id
     * @return string|null
     */
    public function getTudockIndexerId()
    {
        return $this->_get(self::TUDOCK_INDEXER_ID);
    }

    /**
     * Set tudock_indexer_id
     * @param string $tudockIndexerId
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setTudockIndexerId($tudockIndexerId)
    {
        return $this->setData(self::TUDOCK_INDEXER_ID, $tudockIndexerId);
    }

    /**
     * Get category
     * @return string|null
     */
    public function getCategory()
    {
        return $this->_get(self::CATEGORY);
    }

    /**
     * Set category
     * @param string $category
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setCategory($category)
    {
        return $this->setData(self::CATEGORY, $category);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Tudock\TodaysMessage\Api\Data\TudockIndexerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tudock\TodaysMessage\Api\Data\TudockIndexerExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    /**
     * Get product
     * @return string|null
     */
    public function getProduct()
    {
        return $this->_get(self::PRODUCT);
    }

    /**
     * Set product
     * @param string $product
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setProduct($product)
    {
        return $this->setData(self::PRODUCT, $product);
    }

    /**
     * Get message
     * @return string|null
     */
    public function getMessage()
    {
        return $this->_get(self::MESSAGE);
    }

    /**
     * Set message
     * @param string $message
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setMessage($message)
    {
        return $this->setData(self::MESSAGE, $message);
    }
}

