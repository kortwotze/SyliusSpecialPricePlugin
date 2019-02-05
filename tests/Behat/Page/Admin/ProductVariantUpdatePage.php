<?php
declare(strict_types=1);

namespace Tests\Brille24\SyliusSpecialPricePlugin\Behat\Page\Admin;


use Sylius\Behat\Page\Admin\ProductVariant\UpdatePage;
use Sylius\Component\Core\Model\ChannelInterface;

class ProductVariantUpdatePage extends UpdatePage
{
    /**
     * @param ChannelInterface $channel
     *
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function addSpecialPriceForChannel(ChannelInterface $channel): void
    {
        $this->getDocument()->find('css', sprintf('.menu .item[data-tab="%s"]', $channel->getCode()))->click();

        $collection = $this->getDocument()->find('css', sprintf('#sylius_product_variant_channelSpecialPricings_%s', $channel->getCode()));

        $collection->clickLink('Add');
    }

    /**
     * @param ChannelInterface $channel
     *
     * @throws \Behat\Mink\Exception\ElementNotFoundException
     */
    public function removeSpecialPriceForChannel(ChannelInterface $channel): void
    {
        $this->getDocument()->find('css', sprintf('.menu .item[data-tab="%s"]', $channel->getCode()))->click();

        $collection = $this->getDocument()->find('css', sprintf('#sylius_product_variant_channelSpecialPricings_%s', $channel->getCode()));

        $collection->clickLink('Delete');
    }

    /**
     * @param int $price
     * @param ChannelInterface $channel
     */
    public function setPrice(int $price, ChannelInterface $channel): void
    {
        $this->getDocument()->find('css', sprintf('.menu .item[data-tab="%s"]', $channel->getCode()))->click();

        $collection = $this->getDocument()->find('css', sprintf('#sylius_product_variant_channelSpecialPricings_%s', $channel->getCode()));
        $priceFields = $collection->findAll('css', 'input[id$="_price"]');
        $field = end($priceFields);

        $field->setValue($price);
    }

    /**
     * @param \DateTime $dateTime
     * @param ChannelInterface $channel
     */
    public function setStartDate(\DateTime $dateTime, ChannelInterface $channel): void
    {
        $this->getDocument()->find('css', sprintf('.menu .item[data-tab="%s"]', $channel->getCode()))->click();

        $collection = $this->getDocument()->find('css', sprintf('#sylius_product_variant_channelSpecialPricings_%s', $channel->getCode()));
        $items = $collection->findAll('css', '[data-form-collection="item"]');
        $item = end($items);

        $item->fillField('Starts at', $dateTime->format('d/m/Y'));
    }

    /**
     * @param \DateTime $dateTime
     * @param ChannelInterface $channel
     */
    public function setEndDate(\DateTime $dateTime, ChannelInterface $channel): void
    {
        $this->getDocument()->find('css', sprintf('.menu .item[data-tab="%s"]', $channel->getCode()))->click();

        $collection = $this->getDocument()->find('css', sprintf('#sylius_product_variant_channelSpecialPricings_%s', $channel->getCode()));
        $items = $collection->findAll('css', '[data-form-collection="item"]');
        $item = end($items);

        $item->fillField('Ends at', $dateTime->format('d/m/Y'));
    }
}
