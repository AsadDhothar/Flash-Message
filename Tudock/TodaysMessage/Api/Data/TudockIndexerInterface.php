<?php

namespace Tudock\TodaysMessage\Api\Data;

interface TudockIndexerInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const TUDOCK_INDEXER_ID = 'tudock_indexer_id';
    const CATEGORY = 'category';
    const PRODUCT = 'product';
    const MESSAGE = 'message';

    /**
     * Get tudock_indexer_id
     * @return string|null
     */
    public function getTudockIndexerId();

    /**
     * Set tudock_indexer_id
     * @param string $tudockIndexerId
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setTudockIndexerId($tudockIndexerId);

    /**
     * Get category
     * @return string|null
     */
    public function getCategory();

    /**
     * Set category
     * @param string $category
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setCategory($category);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Tudock\TodaysMessage\Api\Data\TudockIndexerExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Tudock\TodaysMessage\Api\Data\TudockIndexerExtensionInterface $extensionAttributes
    );

    /**
     * Get product
     * @return string|null
     */
    public function getProduct();

    /**
     * Set product
     * @param string $product
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setProduct($product);

    /**
     * Get message
     * @return string|null
     */
    public function getMessage();

    /**
     * Set message
     * @param string $message
     * @return \Tudock\TodaysMessage\Api\Data\TudockIndexerInterface
     */
    public function setMessage($message);
}

