<?php
declare(strict_types=1);

namespace Merlin\ReservationGrid\Controller\Adminhtml\Reservation;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Merlin\ReservationGrid\Model\ReservationFactory;
use Magento\Framework\Exception\LocalizedException;

class Delete extends Action
{
    public const ADMIN_RESOURCE = 'Merlin_ReservationGrid::reservation';

    private ReservationFactory $reservationFactory;

    public function __construct(
        Context            $context,
        ReservationFactory $reservationFactory
    ) {
        parent::__construct($context);
        $this->reservationFactory = $reservationFactory;
    }

    public function execute(): Redirect
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = (int)$this->getRequest()->getParam('reservation_id', 0);

        if ($id > 0) {
            try {
                $reservation = $this->reservationFactory->create()->load($id);
                if (!$reservation->getId()) {
                    throw new LocalizedException(__('Reservation with ID %1 not found.', $id));
                }
                $reservation->delete();
                $this->messageManager->addSuccessMessage(__('Reservation deleted.'));
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Throwable $e) {
                $this->messageManager->addExceptionMessage($e, __('An error occurred while deleting reservation.'));
            }
        } else {
            $this->messageManager->addErrorMessage(__('No reservation ID specified.'));
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
