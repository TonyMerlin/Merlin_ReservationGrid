<?php
namespace Merlin\ReservationGrid\Model;

use Magento\Framework\Model\AbstractModel;

class Reservation extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Merlin\ReservationGrid\Model\ResourceModel\Reservation::class);
    }
}
