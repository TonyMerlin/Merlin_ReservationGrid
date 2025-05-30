<?php
namespace Merlin\ReservationGrid\Model\ResourceModel\Reservation;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Merlin\ReservationGrid\Model\Reservation::class,
            \Merlin\ReservationGrid\Model\ResourceModel\Reservation::class
        );
    }
}
