<?php
declare(strict_types=1);

namespace Merlin\ReservationGrid\Controller\Adminhtml\Reservation;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    public const ADMIN_RESOURCE = 'Merlin_ReservationGrid::reservation';

    private PageFactory $resultPageFactory;

    public function __construct(
        Context     $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Render the grid page
     */
    public function execute()
    {
        $page = $this->resultPageFactory->create();
        $page->setActiveMenu(self::ADMIN_RESOURCE);
        $page->getConfig()->getTitle()->prepend(__('Inventory Reservations'));
        return $page;
    }
}

